<?php

namespace App\Http\Resources;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Client $client */
        $client = $this->resource;
        return [
            'id'        => $client->id,
            'name'      => $client->name,
            'profiles'  => ProfileResource::collection($client->profiles)
        ];
    }
}
