<?php

namespace Paliari\Brasil\DateTime;

class DiaUtil
{
    /**
     * Variável que armazena função que verifica os feriados variáveis que ficam salvos no Banco de Dados
     * @var function
     */
    protected static $feriado_handler;

    /**
     * @var DateTimeBr
     */
    protected static $pascoa;

    /**
     * Array com os feriados nacionais fixos
     * @var array
     */
    protected static $feriados_nacionais = array (
        '0101',
        '0421',
        '0501',
        '0907',
        '1012',
        '1102',
        '1115',
        '1225',
    );

    /**
     * Retorna um DateBr com o dia da páscoa do ano da data informada
     * @param  DateTimeBr           $date
     * @return DateTimeBr
     * @throws \DomainException
     */
    public static function dataPascoa($date)
    {
        $date = static::prepareDate($date);

        $ano = @$date->year;
        if (static::$pascoa) {
            if ($ano == static::$pascoa->getYear()) {
                return static::$pascoa;
            }
        }
        $c = floor($ano / 100);
        $n = $ano - (19 * floor($ano / 19));
        $k = floor(($c - 17) / 25);
        $i = $c - floor($c / 4) - floor(($c - $k) / 3) + (19 * $n) + 15;
        $i = $i - (30 * floor($i / 30));
        $i = $i - (floor($i / 28) * (1 - floor($i / 28)) * floor(29 / ($i + 1)) * floor((21 - $n) / 11));
        $j = $ano + floor($ano / 4) + $i + 2 -$c + floor($c / 4);
        $j = $j - (7 * floor($j / 7));
        $L = $i - $j;
        $mes = 3 + floor(($L + 40) / 44);
        $dia = $L + 28 - (31 * floor($mes / 4));
        static::$pascoa = DateTimeBr::createFromDate($ano, $mes, $dia);

        return static::$pascoa;
    }

    /**
     * Retorna um DateBr com o dia da Paixão de Cristo do ano da data passada.
     * @param  DateTimeBr         $date
     * @return DateBr
     */
    public static function dataPaixaoCristo($date)
    {
       return static::dataPascoa($date)->subDays(2);
    }

    /**
     * Retorna um DateBr com o dia da Quarta-feira de Cinzas do ano da data passada.
     * @param $date
     * @return DateBr
     */
    public static function dataQuartaCinzas($date)
    {
        return static::dataPascoa($date)->subDays(46);
    }

    /**
     * Retorna um DateBr com o dia de Corpus Christi do ano da data passada.
     * @param $date
     * @return DateBr
     */
    public static function dataCorpusChristi($date)
    {
        return static::dataPascoa($date)->addDays(60);
    }

    /**
     * Retorna um DateBr com o dia do Domingo de Ramos do ano da data passada.
     * @param $date
     * @return DataBr
     */
    public static function dataDomingoRamos($date)
    {
        return static::dataPascoa($date)->subDays(7);
    }

    /**
     * Retorna um DateBr com o dia da terça-feira de carnaval do ano da data passada.
     * @param $date
     * @return DateBr
     */
    public static function dataCarnaval($date)
    {
        return static::dataPascoa($date)->subDays(47);
    }

    /**
     * Retorna o póximo dia útil, se a data passsada for útil, retorna ela mesma.
     * @param  DateTimeBr $datref
     * @return DateTimeBr
     */
    public static function proxDiaUtil($datref)
    {
       return static::diaUtil($datref, 1);
    }

    /**
     * Retorna o dia útil anterior, se a data passsada for útil, retorna ela mesma.
     * @param  DateTimeBr $datref
     * @return DateTimeBr
     */
    public static function anteriorDiaUtil($datref)
    {
        return static::diaUtil($datref, -1);
    }

    /**
     * Retorna o dia útil de acordo com a data e o parâmetro passado.
     * Se a data passsada for útil, retorna ela mesma.
     *   1 - Próximo dia útil
     *  -1 - Anterior dia útil
     * @param  DateTimeBr           $datref
     * @param  integer          $param
     * @return DateTimeBr
     * @throws \DomainException
     */
    protected static function diaUtil($datref, $param)
    {
        $datref = static::prepareDate($datref);

        while (static::isWeekend($datref) || static::isFeriado($datref)) {
            $datref->addDays($param);
        }

        return $datref;
    }

    /**
     * Verifica se a data passada é feriado
     * @param  DateTimeBr $datref
     * @return bool
     */
    public static function isFeriado($datref)
    {
        if (static::isPascoa($datref) ||
            static::isPaixao($datref) ||
            static::isFeriadoNacional($datref) ||
            static::isOther($datref)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica se é final de semana
     * @param  DateTimeBr $datref
     * @return bool
     */
    public static function isWeekend($datref)
    {
        return ($datref->dayOfWeek < 1 || $datref->dayOfWeek > 5);
    }

    /**
     * Verifica se a data passada por parâmetro é Páscoa
     * @param  DateTimeBr $datref
     * @return bool
     */
    protected static function isPascoa($datref)
    {
        return $datref == static::dataPascoa($datref);
    }

    /**
     * Verifica se a data passada por parâmetro é Paixão de Cristo
     * @param  DateTimeBr $datref
     * @return bool
     */
    protected static function isPaixao($datref)
    {
        return $datref == static::dataPaixaoCristo($datref);
    }

    /**
     * Verifica se a data é um feriado nacional
     * @param  DateTimeBr $datref
     * @return bool
     */
    protected static function isFeriadoNacional($datref)
    {
       return in_array(str_pad($datref->getMonth(), 2, '0', STR_PAD_LEFT) . str_pad($datref->getDay(), 2, '0', STR_PAD_LEFT), @static::$feriados_nacionais);
    }

    /**
     * Verifica se a data passada é Corpus Christi
     * @param  DateTimeBr $datref
     * @return bool
     */
    protected static function isCorpusChristi($datref)
    {
        return $datref == static::dataCorpusChristi($datref);
    }

    /**
     * Verifica se a data passada é Quarta-feira de Cinzas
     * @param  DateTimeBr $datref
     * @return bool
     */
    protected static function isQuartaCinzas($datref)
    {
        return $datref == static::dataQuartaCinzas($datref);
    }

    /**
     * Verifica se a data passada é carnaval
     * @param  DateTimeBr $datref
     * @return bool
     */
    protected static function isCarnaval($datref)
    {
        return $datref == static::dataCarnaval($datref);
    }

    /**
     * @param $datref
     * @return bool|mixed
     */
    protected static function isOther($datref)
    {
        $return = false;
        if ( is_callable(static::$feriado_handler) ) {
            $return = call_user_func(static::$feriado_handler, $datref);
        }

        return $return;
    }

    /**
     * Seta feriado à variável
     * @param $feriado_handler
     */
    public static function setFeriadoHandler($feriado_handler)
    {
       static::$feriado_handler = $feriado_handler;
    }

    /**
     * @param mixed $date
     *
     * @return \Paliari\DateTime\TDateTime
     * @throws \DomainException
     */
    protected static function prepareDate($date)
    {
        if (!$date instanceof DateTimeBr) {
            $_date = DateTimeBr::createDate($date);
            if (!$_date) {
                throw new \DomainException("Tipo '$date' inváldo. Utilize DateBr.");
            }
            $date = $_date;
        }

        return $date;
    }
}
