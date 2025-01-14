<?php

namespace Database\Seeders;

use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class createSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $sliders = [
        ['title' => 'First Slide Title', 'image' => 'backend/assets/img/default/slider.jpg'],
        ['title' => 'Second Slide Title', 'image' => 'backend/assets/img/default/slider.jpg'],
        ['title' => 'Third Slide Title', 'image' => 'backend/assets/img/default/slider.jpg'],
    ];


    public function run(): void
    {
        foreach ($this->sliders as $slider) {
            $fullPath = public_path($slider['image']);
            if (!file_exists($fullPath)) {
                throw new \Exception("File not found: " . $fullPath);
            }

            $imgResize = Image::make($fullPath)->resize(1921, 581)->stream();
            $imageName = basename($fullPath);
            Storage::disk('public')->put('slider/' . $imageName, $imgResize);
            Slider::create([
                'title' => $slider['title'],
                'image' =>  $imageName,
                'status' => 1,
            ]);
        }
    }
}
