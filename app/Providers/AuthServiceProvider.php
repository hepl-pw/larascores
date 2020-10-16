<?php

namespace App\Providers;

use App\Models\Match;
use App\Models\Team;
use App\Policies\MatchPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        Match::class => MatchPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-match', function ($user) {
            return $user->isTeamManager || $user->isAdmin;
        });

        Gate::define('add-team', function ($user) {
            return $user->isAdmin;
        });
    }
}
