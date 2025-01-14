<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSetting;
use App\Models\Sslcommerze;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class SettingController extends Controller
{
    public function sslcommerz_view()
    {
        $sslcommerz = Sslcommerze::find(1);

        return view('backend.setting.sslcommerz', compact('sslcommerz'));
    }

    public function update_or_insert(Request $request)
    {

        $sslcommerz = Sslcommerze::find(1);

        if ($sslcommerz) {
            $sslcommerz->store_id       = $request->store_id;
            $sslcommerz->store_password = $request->store_password;
            $sslcommerz->is_live        = $request->is_live;
            $sslcommerz->save();
        } else {
            $sslcommerz = new Sslcommerze();
            $sslcommerz->store_id       = $request->store_id;
            $sslcommerz->store_password = $request->store_password;
            $sslcommerz->is_live        = $request->is_live;
            $sslcommerz->save();
        }

        toastr()->success('Info is updated!', 'Success!');
        return redirect()->back();
    }

    public function site_setting(Request $request)
    {
        $site_setting = SiteSetting::first();
        if ($request->isMethod('post')) {

            // Remove existing logo image
            if ($site_setting->logo !== null) {
                $this->imageDestroy('logo/', $site_setting->logo);
            }
            // Remove existing favicon image
            if ($site_setting->favicon !== null) {
                $this->imageDestroy('logo/', $site_setting->favicon);
            }

            // logo image
            if ($request->file('image')) {
                $site_setting->logo =  $this->imageUpload($request->file('image'), "270", "100",'logo');
            }

            // faviocn image
            if ($request->file('favicon')) {
                $site_setting->favicon =  $this->imageUpload($request->file('favicon'), "64", "64",'favicon');
            }

            $site_setting->site_name = $request->site_name;
            $site_setting->site_email = $request->site_email;
            $site_setting->site_phone = $request->site_phone;
            $site_setting->site_address = $request->site_address;
            $site_setting->currency = $request->currency;
            $site_setting->vat = $request->vat;
            $site_setting->save();
            toastr()->success('Site Info Updated Successfully!', 'Success!');
            return redirect()->back();
        }

        return view('backend.setting.site-setting', compact('site_setting'));
    }

    public function imageDestroy($folder, $file)
    {
        if (Storage::disk('public')->exists($folder . $file)) {
            Storage::disk('public')->delete($folder . $file);
        }
    }

    public function imageUpload($file, $width, $height,$type)
    {
        try {
            $favicon = $type . '-' . rand(999999, 100000) . '.' . $file->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('logo')) {
                Storage::disk('public')->makeDirectory('logo');
            }

            $imgResize = Image::make($file)->resize($width, $height)->stream();
            Storage::disk('public')->put('logo/' . $favicon, $imgResize);
            return $favicon;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
