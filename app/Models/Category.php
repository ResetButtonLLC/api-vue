<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'profile';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'is_active',
        'is_exist',
        'campaign_id'
    ];

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'category_id', 'id');
    }
}
