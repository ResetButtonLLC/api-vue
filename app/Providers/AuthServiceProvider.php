<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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

        Gate::define('profile.access', function (User $user, Project $project) {
            return $user->load('projects')->projects->contains($project->id);
        });

    }
}
