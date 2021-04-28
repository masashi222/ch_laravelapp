<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class FormServiceProvider extends ServiceProvider
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
        View::composer('shift.period_select', 'App\Http\Composers\FormComposer');
        View::composer('attendance.period_select', 'App\Http\Composers\FormComposer');
        View::composer('attendance.change', 'App\Http\Composers\FormComposer');
        View::composer('attendance.register', 'App\Http\Composers\FormComposer');
        View::composer('attendance.payroll_period_select', 'App\Http\Composers\FormComposer');
    }
}
