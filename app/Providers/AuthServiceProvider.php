<?php

namespace App\Providers;

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

        //管理者以上(auth = 1) に許可
        Gate::define('admin', function ($user) {
            return ($user->auth == 1);
        });

        //オーナー以上(auth = 1~4)に許可
        Gate::define('owner-higher', function ($user) {
            return ($user->auth >= 1 && $user->auth <= 4);
        });

        //オーナーのみ(auth = 4)に許可
        Gate::define('owner', function ($user) {
            return ($user->auth == 4);
        });

        //従業員以上(auth = 1~7)に許可
        Gate::define('staff-higher', function ($user) {
            return ($user->auth >= 1 && $user->auth <= 7);
        });

        //従業員のみ(auth = 7)に許可
        Gate::define('staff', function ($user) {
            return ($user->auth == 7);
        });

        //税理士以上(auth = 1~10)に許可
        Gate::define('accountant-higher', function ($user) {
            return ($user->auth >= 1 && $user->auth <= 10);
        });

        //税理士のみ(auth = 10)に許可
        Gate::define('accountant', function ($user) {
            return ($user->auth == 10);
        });

    }
}
