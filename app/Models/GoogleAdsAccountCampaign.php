<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleAdsAccountCampaign extends Model
{
    use HasFactory;

    protected $table = 'google_ads_account_campaigns';

    protected $fillable = [];

    public $timestamps = false;

}
