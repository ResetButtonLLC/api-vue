<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $connection = 'profile';

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'is_active',
        'is_exist'
    ];
}
