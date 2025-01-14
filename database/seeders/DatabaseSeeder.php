<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        $this->call([
            CreateAdminSeeder::class,
            CreateUserSeeder::class,
            CreateCategorySeeder::class,
            CreateSubcategorySeeder::class,
            CreateBrandSeeder::class,
            CreateSliderSeeder::class,
            CreateAttributeSeeder::class,
            createProductSeeder::class,
            createSiteSettingSeeder::class,
        ]);
    }
}
