<?php

namespace FakerDateInterval\Tests;

use DateInterval;
use Faker\Generator as Faker;
use FakerDateInterval\ServiceProvider;
use Orchestra\Testbench\TestCase;

class DateTimeIntervalTest extends TestCase
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

    public function testDateTimeIntervalDefaultsToSimpleAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateTimeInterval();

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertEquals(2, $this->countFilledParts($interval));
    }

    public function testDateTimeIntervalSimpleAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateTimeInterval();

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertEquals(2, $this->countFilledParts($interval));
    }

    public function testDateTimeIntervalSimpleAsIso8601()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateTimeInterval(false, true);

        $this->assertIsString($interval);
        $this->assertMatchesRegularExpression('/P\d+[YMD]T\d+[HMS]/', $interval);
    }

    public function testDateTimeIntervalComplexAsDateInterval()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateTimeInterval(true, false);

        $this->assertInstanceOf(DateInterval::class, $interval);
        $this->assertGreaterThan(2, $this->countFilledParts($interval));
    }

    public function testDateTimeIntervalComplexAsIso8601()
    {
        $faker = $this->app[Faker::class];

        $interval = $faker->dateTimeInterval(true, true);

        $this->assertIsString($interval);
        $this->assertMatchesRegularExpression('/P(\d+[YMD]){2,}T(\d+[HMS]){2,}/', $interval);
    }
}
