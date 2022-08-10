<?php

namespace FakerDateInterval;

use Faker\Generator as Faker;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
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
        if (class_exists(Faker::class)) {
            $faker = $this->app->make(Faker::class);
            $faker->addProvider(new FakerProvider($faker));
        }
    }
}
