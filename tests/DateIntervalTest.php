<?php

namespace FakerDateInterval\Tests;

use DateInterval;
use Faker\Generator as Faker;
use FakerDateInterval\ServiceProvider;
use Orchestra\Testbench\TestCase;

class DateIntervalTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function countFilledParts(DateInterval $interval)
    {
        $count = 0;
        foreach (['y','m','d','h','i','s','f'] as $p) {
            if ($interval->{$p} > 0) {
                ++$count;
            }
        }
        return $count;
    }

    public function testDateIntervalDefaultsToSimpleAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateInterval();

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertEquals(1, $this->countFilledParts($interval));
    }

    public function testDateIntervalSimpleAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateInterval();

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertEquals(1, $this->countFilledParts($interval));
    }

    public function testDateIntervalSimpleAsIso8601()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateInterval(false, true);

        $this->assertIsString($interval);
        $this->assertMatchesRegularExpression('/P\d+[YMD]/', $interval);
    }

    public function testDateIntervalComplexAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateInterval(true, false);

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertGreaterThan(1, $this->countFilledParts($interval));
    }

    public function testDateIntervalComplexAsIso8601()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateInterval(true, true);

        $this->assertIsString($interval);
        $this->assertMatchesRegularExpression('/P(\d+[YMD]){2,}/', $interval);
    }
}
