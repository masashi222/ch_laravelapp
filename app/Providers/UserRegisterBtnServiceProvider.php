<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class UserRegisterBtnServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('owner.user', 'App\Http\Composers\UserRegisterBtnComposer');
        View::composer('admin.owner', 'App\Http\Composers\UserRegisterBtnComposer');
    }
}
