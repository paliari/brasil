<?php

namespace Paliari\Brasil\DateTime;

class DateBr extends DateTimeBr
{
    public function __toString()
    {
        return $this->format('d/m/Y');
    }
}
