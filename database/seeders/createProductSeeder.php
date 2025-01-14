<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class createProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */





    public function run(): void
    {

        $products = [
            [
                'title' => 'Product Title One',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title One'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Two',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Two'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Three',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Three'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Four',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Four'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Five',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Five'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Six',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Six'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Seven',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Seven'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Eight',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Eight'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Nine',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Nine'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
            [
                'title' => 'Product Title Ten',
                'description' => 'Experience unparalleled sound quality with our Premium Wireless Headphones. Designed for comfort and style, these headphones offer noise cancellation, long battery life, and seamless Bluetooth connectivity.',
                'short_description' => 'Enjoy crystal-clear audio with our Premium Wireless Headphones. With noise cancellation, long battery life, and comfortable design, they’re perfect for music lovers and professionals on the go.',
                'category_id' => rand(1, 3),
                'subcategory_id' => rand(1, 3),
                'brand_id' => rand(1, 3),
                'unit_price' => random_int(500, 2000),
                'quantity' => random_int(50, 70),
                'feature_product' => true,
                'slug' => Str::slug('Product Title Ten'),
                'is_publish' => true,
                'is_active' => true,
                'best_selling' => true,
                'hot_deal' => true,
                'feature_image' => 'backend/assets/img/default/product.jpg',
            ],
        ];

        foreach ($products as $product) {
            $fullPath = public_path($product['feature_image']);
            if (!file_exists($fullPath)) {
                throw new \Exception("File not found: " . $fullPath);
            }

            $imgResize = Image::make($fullPath)->resize('300', '300')->stream();
            $imageName = basename($fullPath);
            Storage::disk('public')->put('product/' . $imageName, $imgResize);
            Product::create([

                'title' => $product['title'],
                'description' => $product['description'],
                'short_description' => $product['short_description'],
                'category_id' => $product['category_id'],
                'subcategory_id' => $product['subcategory_id'],
                'brand_id' => $product['brand_id'],
                'unit_price' => $product['unit_price'],
                'quantity' => $product['quantity'],
                'feature_product' => $product['feature_product'],
                'slug' => $product['slug'],
                'is_publish' => $product['is_publish'],
                'is_active' => $product['is_active'],
                'best_selling' => $product['best_selling'],
                'hot_deal' => $product['hot_deal'],
                'feature_image' => $imageName,

            ]);
        }
    }
}
