<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAttributeSeeder extends Seeder
{

    public function run(): void
    {

            Attribute::create([
                'name' => 'Size',
                'attributes' => 'S,M,X,XL,XS'
            ]);
    }
}
