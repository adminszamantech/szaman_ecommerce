<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $categories = [
        'Mobile Phone',
        'Desktop PC',
        'Laptop'
    ];

    public function run(): void
    {
        foreach ($this->categories as $category){
            Category::create([
                'name' => $category,
            ]);
        }

    }
}
