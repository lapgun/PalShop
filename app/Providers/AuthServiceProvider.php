<?php

namespace App\Providers;

use App\Http\Constants\common;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define(Common::ROLES['SUPER'], function ($user) {
            return $user->role_type === Common::ROLES['SUPER'];
        });
        Gate::define(Common::ROLES['GUEST'], function ($user) {
            return $user->role_type === Common::ROLES['GUEST'];
        });
    }
}
