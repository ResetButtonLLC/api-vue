<?php

namespace App\Services\Core;

use App\Helpers\DBHelper;
use App\Models\Client;
use App\Models\Profile;

class ProfileService
{
    public function create($clientId, $name)
    {
        $client = Client::findOrFail($clientId);

        return Profile::create([
            'client_id' => $clientId,
            'db' => DBHelper::getName($client->name, $name),
            'name' => $name
        ]);
    }
}
