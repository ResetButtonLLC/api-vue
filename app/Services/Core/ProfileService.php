<?php

namespace App\Services\Core;

use App\Helpers\DBHelper;
use App\Models\Project;
use App\Models\Profile;

class ProfileService
{
    public function create($projectId, $name)
    {
        $project = Project::findOrFail($projectId);

        return Profile::create([
            'project_id' => $projectId,
            'db' => DBHelper::getName($project->name, $name),
            'name' => $name
        ]);
    }
}
