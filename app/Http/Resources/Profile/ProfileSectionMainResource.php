<?php

namespace App\Http\Resources\Profile;

use App\Http\Resources\GoogleAdsAccountCampaignResource;
use App\Models\Profile;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileSectionMainResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Profile $profile */
        $profile = $this->resource;
        $profile->load('googleAdsAccount.campaigns');
        return [
            'id'            => $profile->id,
            'name'          => $profile->name,
            'project_id'     => $profile->project_id,
            'google_ads_account'     => [
                'id' => $profile->google_ads_account_id,
                'updated_at' => $profile->googleAdsAccount->updated_at,
                'campaigns' => GoogleAdsAccountCampaignResource::collection($profile->googleAdsAccount->campaigns)
            ],
            'activity' => $profile->activity,
            'bid' => $profile->bid
        ];
    }
}
