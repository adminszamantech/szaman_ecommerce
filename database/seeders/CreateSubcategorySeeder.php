<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $sub_categories = [
        'Iphone 10 Pro',
        'Iphone 10 Pro Max',
        'Redmi 10 Pro'
    ];

    public function run(): void
    {
        foreach ($this->sub_categories as $sub_category){
            Subcategory::create([
                'name' => $sub_category,
                'category_id' => 1,
            ]);
        }
    }
}
