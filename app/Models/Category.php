<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function sub_category(){
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    public function product(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


}
