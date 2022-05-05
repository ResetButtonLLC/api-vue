<?php

namespace App\Services\Core;

use App\Models\Project;

class ProjectService
{
    public function create($userId, $name)
    {
        return Project::create(['user_id' => $userId, 'name' => $name]);
    }
}
