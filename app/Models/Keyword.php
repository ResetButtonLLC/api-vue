<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    protected $connection = 'profile';

    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'google_id',
        'keyword',
        'is_active',
        'is_exist'
    ];
}
