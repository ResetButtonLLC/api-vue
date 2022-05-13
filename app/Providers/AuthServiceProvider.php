<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
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

        //null используется потому, что - If the before closure returns a non-null result that result will be considered the result of the authorization check.
        Gate::before(function ($user, $ability) {
            return  $user->isAdmin() ? true : null;
        });

        Gate::define('user.management', function (User $user, Project $project) {
            return $user->isAdmin();
        });

        Gate::define('project.access', function (User $user, Project $project) {
            return $project->users()->where('user_id', $user->id)->exists();
        });

        Gate::define('profile.access', function (User $user, Profile $profile) {
            return $profile->project->users()->where('user_id', $user->id)->exists();
        });

    }
}
