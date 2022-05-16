<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'role'  => $this->role,
            'name'   => $this->name,
            'email'  => $this->email,
            'avatar' => $this->avatar,
            'projects' => ProjectResource::collection($this->whenLoaded('projects'))
        ];
    }
}
