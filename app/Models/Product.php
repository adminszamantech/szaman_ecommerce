<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id')->select('name', 'id');
    }

    public function sub_category(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id')->select('name', 'id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->select('name', 'id');
    }

    public function gallery(){
        return $this->hasMany(Gallery::class, 'product_id', 'id')->select('product_id', 'image', 'id');
    }
    public function variation(){
        return $this->hasMany(ProductVariant::class, 'product_id', 'id')->select('product_id', 'variant_name', 'variant_value');
    }





}
