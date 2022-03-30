<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function profiles()
    {
        return $this->hasMany(Profile::class, 'client_id', 'id');
    }
}
