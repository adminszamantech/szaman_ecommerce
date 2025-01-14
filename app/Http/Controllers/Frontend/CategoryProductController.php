<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryProductController extends Controller
{

    public function get_category_product(){

        $categories = Category::orderBy('id', 'ASC')->get();

        foreach ($categories as $category) {
            $category->products = $category->product()->take(8)->get();
        }
        return $categories;
    }

}
