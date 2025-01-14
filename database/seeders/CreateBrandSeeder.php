<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    protected $brands = [
        ['name' => 'ASUS', 'image' => 'backend/assets/img/default/brand.png'],
        ['name' => 'HP', 'image' => 'backend/assets/img/default/brand.png'],
        ['name' => 'JAMUNA', 'image' => 'backend/assets/img/default/brand.png'],
    ];


    public function run(): void
    {
        foreach ($this->brands as $brand){
            $fullPath = public_path($brand['image']);
            if (!file_exists($fullPath)) {
                throw new \Exception("File not found: " . $fullPath);
            }

            $imgResize = Image::make($fullPath)->stream();
            $imageName = basename($fullPath);
            Storage::disk('public')->put('brand/' . $imageName, $imgResize);

            Brand::create([
                'name' => $brand['name'],
                'image' => $imageName,
            ]);
        }
    }
}
