<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'profile';

    public $timestamps = false;

    const CURRENCY_UNKNOWN = 0;
    const CURRENCY_UAH = 1;

    protected $fillable = [
        'category_id',
        'vendor_id',
        'is_available',
        'model',
        'description',
        'url',
        'mobile_url',
        'sales_notes',
        'rassrochka',
        'price',
        'currency',
        'is_exist',
        'params'
    ];
}
