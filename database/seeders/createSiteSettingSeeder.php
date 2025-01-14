<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class createSiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        $site = [
            "site_name" => "Szaman Tech",
            "site_email" => "info@szamantech.com",
            "site_phone" => "880 961 333 2020",
            "site_address" => "93, Kazi Nazrul Islam Avenue, (5th Floor) , Kawran Bazar, Dhaka-1215",
            "logo" => "frontend/assets/img/logo.png"
        ];
        $fullPath = public_path($site['logo']);
        if (!file_exists($fullPath)) {
            throw new \Exception("File not found: " . $fullPath);
        }

        $imgResize = Image::make($fullPath)->resize(1921, 581)->stream();
        $imageName = basename($fullPath);
        Storage::disk('public')->put('logo/' . $imageName, $imgResize);
        SiteSetting::create([
            'site_name' => $site['site_name'],
            'logo' =>  $imageName,
        ]);
    }
}
