<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'adwords_id',
        'db',
        'name',
        'feed_url',
        'feed_file',
        'feed_type',
        'template',
        'settings',
        'autoupdates'
    ];

    protected $casts = [
        'template' => 'array',
        'settings' => 'array',
        'autoupdates' => 'array',
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function isFileFeed()
    {
        return $this->feed_type == 'file';
    }

    public function isUrlFeed()
    {
        return $this->feed_type == 'url';
    }
}
