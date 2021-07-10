<?php

namespace Paliari\Brasil\DateTime;

class DateMesBr extends DateTimeBr
{
    protected function init()
    {
        $this->setDay(1);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format('m/Y');
    }
}
