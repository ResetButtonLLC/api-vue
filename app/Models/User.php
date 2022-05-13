<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLES = [self::ROLE_ADMIN,self::ROLE_USER];

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

    public function isAdmin() : bool
    {
        return ($this->role == self::ROLE_ADMIN);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }



}
