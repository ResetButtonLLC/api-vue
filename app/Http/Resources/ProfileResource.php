<?php

namespace App\Http\Resources;

use App\Models\Profile;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Profile $profile */
        $profile = $this->resource;
        return [
            'id'            => $profile->id,
            'name'          => $profile->name,
            'project_id'     => $profile->project_id,
            'google_id'     => $profile->google_id,
            'feed_url'      => $profile->feed_url ?? '',
            'feed_type'     => $profile->feed_type,
            'template'      => $profile->template ?? [],
            'settings'      => $profile->settings ?? [],
            'replacement'   => $profile->replacement ?? [],
            'autoupdates'   => $profile->autoupdates ?? [],
        ];
    }
}
