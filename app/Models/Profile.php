<?php

namespace App\Models;

use App\Casts\Bid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'google_ads_account_id',
        'activity',
        'bid'

    ];

    protected $casts = [
        'bid' => Bid::class,
        'template' => 'array',
        'settings' => 'array',
        'autoupdates' => 'array',
    ];

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function googleAdsAccount()
    {
        return $this->hasOne(GoogleAdsAccount::class, 'id', 'google_ads_account_id');
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
