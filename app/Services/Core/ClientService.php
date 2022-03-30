<?php

namespace App\Services\Core;

use App\Models\Client;

class ClientService
{
    public function create($userId, $name)
    {
        return Client::create(['user_id' => $userId, 'name' => $name]);
    }
}
