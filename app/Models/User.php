<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_USER = 1;
    const ROLE_TEAMLEAD = 3;
    const ROLE_ADMIN = 8;
    const ROLE_ROOT = 9;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'role'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return ($this->role == self::ROLE_ADMIN || $this->role == self::ROLE_ROOT);
    }
}
