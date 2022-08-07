<?php

namespace App\Http\Resources\Profile;

use App\Models\Profile;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileInProjectResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Profile $profile */
        $profile = $this->resource;
        return [
            'id'            => $profile->id,
            'name'          => $profile->name,
            'project_id'     => $profile->project_id,
            'activity' => $profile->activity
        ];
    }
}
