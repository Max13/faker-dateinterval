# DateInterval FakerPHP provider

This is a `DateInterval` [FakerPHP](https://fakerphp.github.io) Provider. It can generate a `DateInterval` with only a *date* interval, only a *time* interval or both. It can return a `DateInterval` or a duration in the [ISO8601](https://en.wikipedia.org/wiki/ISO_8601#Durations) format.

## Installation

You can use composer: `composer require max13/faker-dateinterval`

## Usage

Using the examples above:

```php
$faker = new Faker\Generator;
// Add this provider to Faker
$faker->addProvider(new FakerDateInterval\FakerProvider($faker));

// Generate a date, time or date and time interval
$date = $faker->dateInterval(/* $complex = */false, /* $asIso8601 = */ false);
$time = $faker->timeInterval(/* $complex = */false, /* $asIso8601 = */ false);
$datetime = $faker->dateTimeInterval(/* $complex = */false, /* $asIso8601 = */ false);
// return DateInterval objects

// You can generate a complex interval with more than 1 part generated
$date = $faker->dateInterval(/* $complex = */true, /* $asIso8601 = */ false);

// You can also retrieve the interval as an ISO8601 duration string
$date = $faker->dateInterval(/* $complex = */true, /* $asIso8601 = */ true);
// returns a string like: P1M3D for 1 month and 3 days
```

## Bonus

A `Laravel` service provider is included and will autoload the `FakerProvider` to faker, if `Laravel`'s service provider discovery is enabled (default).

## Need help?

Open an issue.

Now have fun.
