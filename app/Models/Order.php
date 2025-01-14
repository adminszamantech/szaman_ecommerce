<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order_detail(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id')->select(['id', 'order_id', 'product_name', 'qty', 'variation', 'price', 'subtotal', 'image']);
    }

    public function shipping_address(){
        return $this->belongsTo(ShippingAddress::class, 'id', 'order_id')->select(['id', 'order_id', 'user_id', 'address_line_one', 'post_office', 'thana', 'postal_code', 'district', 'phone']);
    }



    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->order_number = IdGenerator::generate(['table' => 'orders', 'field' => 'order_number', 'length' => 8, 'prefix' => 'WC']);
        });
    }

}
