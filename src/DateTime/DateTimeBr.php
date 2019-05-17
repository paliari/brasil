<?php

namespace Paliari\Brasil\DateTime;

use Paliari\DateTime\TDateTime;

class DateTimeBr extends TDateTime
{
    /**
     * Utilizado pelo construtor da classe
     *
     * @param $date
     *
     * @return int
     */
    protected static function strBrToUs($date)
    {
        if (is_string($date)) {
            $expreg = '/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(\d{4})(T| ){0,1}(([0-1][0-9]|[2][0-3]):([0-5][0-9]):([0-5][0-9])){0,1}$/';
            if (preg_match($expreg, $date, $datebit)) {
                @list($tudo, $dia, $mes, $ano, $tz, $time, $hora, $min, $seg) = $datebit;

                return "$ano-$mes-$dia" . ($hora | $min | $seg ? "$hora:$min:$seg" : "");
            }
        }
        return null;
    }

    /**
     * Prepara data para validar.
     * @param mixed $date
     * @return null|string se for uma data valida retorna string no formato universal ou falso caso contrario.
     */
    protected static function prepareDate($date)
    {
        $dateBr = static::strBrToUs($date);
        return $dateBr ?: parent::prepareDate($date) ;
    }

    /**
     * Ao fazer um 'echo' na data, a função permite imprimir como se fosse uma string
     * @return string
     */
    public function __toString()
    {
        $format = ($this->hour || $this->minute || $this->second) ? 'd/m/Y H:i:s' : 'd/m/Y';

        return $this->format($format);
    }

    /**
     * Retorna uma string com a data por extenso.
     *
     * @param int $param
     *
     * @return string
     */
    public function dataExtenso($param = 1)
    {
        return DataExtenso::formatar($param, $this->getTimestamp());
    }
}
