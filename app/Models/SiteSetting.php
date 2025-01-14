<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'site_email',
        'site_phone',
        'site_address',
        'logo',
        'favicon',
        'currency',
        'vat',
    ];

}
