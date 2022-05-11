<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use App\Policies\ProjectPolicy;
use App\Models\User;
use App\Models\Project;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return  $user->isAdmin() ? true : null;
        });

        Gate::define('project.access', function (User $user, Project $project) {
            return $user->load('projects')->projects->contains($project->id);
        });

        Gate::define('profile.access', function (User $user, Profile $profile) {
            $projects = $user->load('projects.profiles')->projects->toArray();
            $userOwnProject = false;
            foreach ($projects as $project) {
                foreach ($project["profiles"] as $profileProject) {
                    if ($profileProject["id"] == $profile->id) {
                        $userOwnProject = true;
                    }
                }
            }
            return $userOwnProject;
        });

    }
}
