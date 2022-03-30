<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $connection = 'profile';

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'data'
    ];
}
