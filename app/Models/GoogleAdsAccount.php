<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleAdsAccount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campaigns()
    {
        return $this->hasMany(GoogleAdsAccountCampaign::class, 'google_ads_account_id', 'id');
    }
}
