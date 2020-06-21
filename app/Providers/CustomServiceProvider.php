<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
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
        \App\Models\Profile\User::observe(\App\Observers\Profile\UserObserver::class);
        \App\Models\Profile\Student::observe(\App\Observers\Profile\StudentObserver::class);
        \App\Models\Profile\Teacher::observe(\App\Observers\Profile\TeacherObserver::class);
        \App\Models\Profile\RelativeStudent::observe(\App\Observers\Profile\RelativeStudentObserver::class);
    }
}
