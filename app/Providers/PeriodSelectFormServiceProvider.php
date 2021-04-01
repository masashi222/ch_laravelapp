<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PeriodSelectFormServiceProvider extends ServiceProvider
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
        View::composer(
            'owner.shift_period_select','App\Http\Composers\PeriodSelectFormComposer'
        );
        View::composer(
            'owner.attendance_period_select','App\Http\Composers\PeriodSelectFormComposer'
        );
        View::composer(
            'owner.payroll_period_select','App\Http\Composers\PeriodSelectFormComposer'
            );
    }
}
