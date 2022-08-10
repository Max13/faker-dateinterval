<?php

namespace FakerDateInterval\Tests;

use DateInterval;
use Faker\Generator as Faker;
use FakerDateInterval\ServiceProvider;
use Orchestra\Testbench\TestCase;

class TimeIntervalTest extends TestCase
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

    public function testTimeIntervalDefaultsToSimpleAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->timeInterval();

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertEquals(1, $this->countFilledParts($interval));
    }

    public function testTimeIntervalSimpleAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->timeInterval();

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertEquals(1, $this->countFilledParts($interval));
    }

    public function testTimeIntervalSimpleAsIso8601()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->timeInterval(false, true);

        $this->assertIsString($interval);
        $this->assertMatchesRegularExpression('/PT\d+[HMS]/', $interval);
    }

    public function testTimeIntervalComplexAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->timeInterval(true, false);

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertGreaterThan(1, $this->countFilledParts($interval));
    }

    public function testTimeIntervalComplexAsIso8601()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->timeInterval(true, true);

        $this->assertIsString($interval);
        $this->assertMatchesRegularExpression('/PT(\d+[HMS]){2,}/', $interval);
    }
}
