<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'phone',
        'address_line_one',
        'post_office',
        'thana',
        'postal_code',
        'district'
    ];
}
