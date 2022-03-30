<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $connection = 'profile';

    public $timestamps = false;

    protected $fillable = [
        'google_id',
        'group_id',
        'headlines',
        'descriptions',
        'urls',
        'is_active',
        'is_exist'
    ];
}
