<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\ShippingAddress;
use DB;

class OnlinePaymentController extends Controller
{
    public function index(Request $request)
    {

        $numberWithoutComma = str_replace(",", "", Cart::instance('shopping')->subtotal());
        $floatNumber = floatval($numberWithoutComma);
        $integerNumber = intval($floatNumber);

        $user = User::find(auth()->id());
        $post_data = array();
        $post_data['total_amount'] = $integerNumber + Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = $user->address_line_one;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = $user->district;
        $post_data['cus_state'] = $user->district;
        $post_data['cus_postcode'] = $user->postal_code;
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] =  $user->name;
        $post_data['ship_add1'] = $user->address_line_one;
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] =  $user->district;
        $post_data['ship_state'] =  $user->district;
        $post_data['ship_postcode'] = $user->postal_code;;
        $post_data['ship_phone'] = $user->phone;;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Product";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";



        $existingOrder = DB::table('orders')
            ->where('tnx_id', $post_data['tran_id'])
            ->first();

        // If the order exists, update it
        if ($existingOrder) {
            DB::table('orders')
                ->where('tnx_id', $post_data['tran_id'])
                ->update([
                    'user_id'           => $user->id,
                    'payable_amount'    => $integerNumber + Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price,
                    'shipping_charge'   => Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price,
                    'payment_method'    => 1, //1=Online, 2=Cash On Delivery
                    'payment_date'      => date('Y-m-d'),
                    'order_date'        => date('Y-m-d'),
                    'order_status'      => 0,
                    'payment_status'    => 0,
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);

            $orderId = $existingOrder->id;
        } else {
            // If the order does not exist, insert a new record
            $orderId = DB::table('orders')->insertGetId([
                'user_id'           => $user->id,
                'order_number'      => IdGenerator::generate(['table' => 'orders', 'field' => 'order_number', 'length' => 8, 'prefix' => 'WC']),
                'tnx_id'            => $post_data['tran_id'],
                'payable_amount'    => $integerNumber + Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price,
                'shipping_charge'   => Cart::instance('shipping')->content()->where('id', 'shipping')->first()->price,
                'payment_method'    => 1, //1=Online, 2=Cash On Delivery
                'payment_date'      => date('Y-m-d'),
                'order_date'        => date('Y-m-d'),
                'order_status'      => 0,
                'payment_status'    => 0,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ]);
        }

        //=============== Order Detail ================//
        $carts = Cart::instance('shopping')->content();

        foreach ($carts as $cart) {
            $order_details = new OrderDetail;
            $order_details->order_id = $orderId; // Use the order ID from the insert or update operation
            $order_details->product_name = $cart->name;
            $order_details->qty = $cart->qty;
            $order_details->price = $cart->price;
            $order_details->subtotal = $cart->subtotal;
            $order_details->image = $cart->options->image;
            $order_details->save();
        }
        //=============== Order Detail ================//

        //=============== Shipping Address ===============//
        $shipping_address = new ShippingAddress();
        $shipping_address->user_id = $user->id;
        $shipping_address->order_id = $orderId;
        $shipping_address->phone = $user->phone;
        $shipping_address->address_line_one = $user->address_line_one;
        $shipping_address->post_office = $user->post_office;
        $shipping_address->thana = $user->thana;
        $shipping_address->postal_code = $user->postal_code;
        $shipping_address->district = $user->district;
        $shipping_address->phone = $user->phone;
        $done = $shipping_address->save();
        //=============== Shipping Address ===============//


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        //========== Destroy Cart ==============//
        Cart::instance('shopping')->destroy();
        Cart::instance('shipping')->destroy();
        //========== End Destroy Cart ==============//

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('tnx_id', $tran_id)
            ->select('tnx_id', 'payment_status', 'payable_amount')->first();

        if ($order_details->payment_status == 0) {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('tnx_id', $tran_id)
                    ->update(['payment_status' => 1, 'order_status' => 1]);
                return redirect()->route('frontend.myaccount.page')->with('success','Payment Has Been Completed');
            }
        } else if ($order_details->payment_status == 1) {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return redirect()->route('frontend.home_page')->with('success','Transaction is successfully Completed');
        } else {
            return redirect()->route('frontend.home_page')->with('error','Invalid Transaction!');
        }


    }

    public function fail(Request $request)
    {
        //========== Destroy Cart ==============//
        Cart::instance('shopping')->destroy();
        Cart::instance('shipping')->destroy();
        //========== End Destroy Cart ==============//

        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('tnx_id', $tran_id)
            ->select('tnx_id', 'payment_status')->first();

        if ($order_details->payment_status == 0) {
            $update_product = DB::table('orders')
                ->where('tnx_id', $tran_id)
                ->update(['payment_status' => 0]); // [0=Initiated, 1=Confirmed, 3=Processing, 4=Picked, 5=Shipped, 6=Delivered, 7=Cancelled, 8=Refunded, 9 Returned]
            return redirect()->route('frontend.home_page')->with('error','Transaction is Failed');
        } else if ($order_details->payment_status == 1) {
            return redirect()->route('frontend.home_page')->with('success','Transaction is already success!');
        } else {
            $update_product = DB::table('orders')
                ->where('tnx_id', $tran_id)
                ->update(['payment_status' => 0]);// [0=Initiated, 1=Confirmed, 3=Processing, 4=Picked, 5=Shipped, 6=Delivered, 7=Cancelled, 8=Refunded, 9 Returned]
            return redirect()->route('frontend.home_page')->with('error','Transaction is Invalid!');
        }

    }

    public function cancel(Request $request)
    {
        //========== Destroy Cart ==============//
        Cart::instance('shopping')->destroy();
        Cart::instance('shipping')->destroy();
        //========== End Destroy Cart ==============//

        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('tnx_id', $tran_id)
            ->select('tnx_id', 'payment_status')->first();

        if ($order_details->payment_status == 0) {
            $update_product = DB::table('orders')
                ->where('tnx_id', $tran_id)
                ->update(['payment_status' => 0]);
            return redirect()->route('frontend.home_page')->with('error','Transaction is Cancel');

        } else if ($order_details->payment_status == 1) {
            return redirect()->route('frontend.home_page')->with('success','Transaction is already Successful');
        } else {
            $update_product = DB::table('orders')
                ->where('tnx_id', $tran_id)
                ->update(['payment_status' => 0]);
            return redirect()->route('frontend.home_page')->with('error','Transaction is Invalid');
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('tnx_id', $tran_id)
                ->select('tnx_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('tnx_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
