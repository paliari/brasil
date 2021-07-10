<?php

namespace Paliari\Brasil\DateTime;

class DateMesBr extends DateTimeBr
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format('m/Y');
    }
}
