<?php

namespace App\Http\Resources;

use App\Http\Resources\Profile\ProfileInProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'profiles'  => ProfileInProjectResource::collection($this->profiles),
            'users'  => UserResource::collection($this->whenLoaded('users'))
        ];
    }
}
