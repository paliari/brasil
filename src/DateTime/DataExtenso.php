<?php

namespace Paliari\Brasil\DateTime;

use Paliari\Brasil\Semana,
    Paliari\Brasil\Mes,
    DateTime,
    DomainException;

class DataExtenso
{
    const SEMANA_DIA_MES_ANO      = 1;
    const DIA_MES_ANO             = 2;
    const SEMANA_DIA_MES_ANO_HORA = 3;
    const DIA_MES_ANO_HORA        = 4;

    /**
     * Formato do retorno:
     *  1: semana, dia de mes de ano,
     *  2: para dia de mes de ano
     *  3: para semana, dia de mes de ano as hora:minuto:segundos
     *  4: dia de mes de ano as hora:minuto:segundos
     *
     * @param  int          $tp
     * @param  DateTime|int $date
     *
     * @return string
     * @throws DomainException
     */
    public static function formatar($tp = 1, $date = null)
    {
        if (null == $date) {
            $date = time();
        } elseif ($date instanceof DateTime) {
            $date = $date->getTimestamp();
        }
        $sem = Semana::$NOMESF[date("N", $date)];
        $mes = Mes::$NOMES[date("m", $date)];
        $ret = array(
            1 => $sem . ", " . date("d", $date) . " de " . $mes . " de " . date("Y", $date),
            2 => date("d", $date) . " de " . $mes . " de " . date("Y", $date),
            3 => $sem . ", " . date("d", $date) . " de " . $mes . " de " . date("Y", $date) . " as " . date("H:i:s", $date),
            4 => date("d", $date) . " de " . $mes . " de " . date("Y", $date) . " as " . date("H:i:s", $date),
        );
        if (@$ret[$tp]) {
            return $ret[$tp];
        } else {
            throw new DomainException("Tipo $tp inválido!\nUtilize os tipos disponíveis nas constantes da classe");
        }
    }
}
