<?php

namespace Paliari\Brasil\DateTime;

/**
 * Class DateMesBr
 * @package Paliari\Brasil\DateTime
 */
class DateMesBr extends DateTimeBr
{

    protected function init()
    {
        $this->setDay(1)->setHour(0)->setMinute(0)->setSecond(0);
    }

    /**
     * Retona data em string para ser impressa.
     * @return bool|string
     */
    public function __toString()
    {
        return $this->format('m/Y');
    }

}
