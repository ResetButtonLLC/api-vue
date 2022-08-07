<?php

namespace App\Http\Resources;

use App\Models\GoogleAdsAccountCampaign;
use Illuminate\Http\Resources\Json\JsonResource;

class GoogleAdsAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            [
                'campaigns' =>  GoogleAdsAccountCampaignResource::collection($this->campaigns)
            ]
        );
    }
}
