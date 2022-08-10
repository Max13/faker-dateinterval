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
            // Laravel >= 9.24
            if (function_exists('fake')) {
                $faker = fake();
            } else {
                $faker = app()->make(Faker::class);
            }

            $faker->addProvider(new FakerProvider($faker));
        }
    }
}
