<?php

namespace FakerDateInterval;

use DateInterval;
use Faker\Provider\Base;

class FakerProvider extends Base
{
    /**
     * Base interval generator
     *
     * @param  array $periods The interval parts you want to fill.
     * @param  bool  $complex A complex interval is an interval with more than
     *                        one part filled.
     *                        Set to false to generate multiple parts.
     *
     * @return string
     */
    protected function baseInterval(array $periods, $complex)
    {
        $periods = array_fill_keys($periods, 0);
        $parts = array_keys($periods);
        $round = $complex ? self::numberBetween(2, count($periods)) : 1;

        for ($i = 0; $i < $round; ++$i) {
            $p = array_splice(
                $parts,
                self::numberBetween(0, count($parts) - 1),
                1
            )[0];
            $periods[$p] = self::numberBetween(1, 20);
        }

        $isoPeriod = '';
        foreach ($periods as $key => $val) {
            if ($val > 0) {
                $isoPeriod .= $val.$key;
            }
        }

        return $isoPeriod;
    }

    /**
     * Generate a date interval value, as ISO-8601 string or DateInterval.
     *
     * @param  boolean $complex   Defaults to false. A complex interval is an
     *                            interval with more than one part filled.
     * @param  boolean $asIso8601 Set to true to return the ISO-8601 interval
     *                            string. False to
     * @return string|DateInterval
     */
    public function dateInterval($complex = false, $asIso8601 = false)
    {
        $isoPeriod = 'P'.$this->baseInterval(['Y','M','D'], $complex);

        return $asIso8601 ? $isoPeriod : new DateInterval($isoPeriod);
    }

    /**
     * Generate a time interval value, as ISO-8601 string or DateInterval.
     *
     * @param  boolean $complex   Defaults to false. A complex interval is an
     *                            interval with more than one part filled.
     * @param  boolean $asIso8601 Set to true to return the ISO-8601 interval
     *                            string. False to
     * @return string|DateInterval
     */
    public function timeInterval($complex = false, $asIso8601 = false)
    {
        $isoPeriod = 'PT'.$this->baseInterval(['H','M','S'], $complex);

        return $asIso8601 ? $isoPeriod : new DateInterval($isoPeriod);
    }

    /**
     * Generate a datetime interval value, as ISO-8601 string or DateInterval.
     *
     * @param  boolean $complex   Defaults to false. A complex interval is an
     *                            interval with more than one part filled.
     * @param  boolean $asIso8601 Set to true to return the ISO-8601 interval
     *                            string. False to
     * @return string|DateInterval
     */
    public function dateTimeInterval($complex = false, $asIso8601 = false)
    {
        $isoPeriod = $this->dateInterval($complex, true);
        $isoPeriod .= substr($this->timeInterval($complex, true), 1);

        return $asIso8601 ? $isoPeriod : new DateInterval($isoPeriod);
    }
}
