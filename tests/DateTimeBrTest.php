<?php

use Paliari\Brasil\DateTime\DateTimeBr;

class DateTimeBrTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @group slow
     * Testa um intervalo de 15 anos se todos dias estão sendo gerados corretamente pelo DateBr
     */
    public function testContructData()
    {
        $stop = date('Y', time()) + 5;
        $ano  = date('Y', time()) - 10;
        $mes  = 1;
        $dia  = 0;

        while ($ano <= $stop) {
            $timestamp = mktime(0, 0, 0, $mes, $dia + 1, $ano);
            $dia       = date('d', $timestamp);
            $mes       = date('m', $timestamp);
            $ano       = date('Y', $timestamp);
            $date_br   = new DateTimeBr("$dia/$mes/$ano");
            $this->assertEquals($timestamp, $date_br->timestamp);
        }
    }

    /**
     * @group slow
     * Testa um intervalo de 15 anos se todos dias estão sendo gerados corretamente pelo DateBr
     */
    public function testContructDataUniversal()
    {
        $stop = date('Y', time()) + 5;
        $ano  = date('Y', time()) - 10;
        $mes  = 1;
        $dia  = 0;

        while ($ano <= $stop) {
            $timestamp = mktime(0, 0, 0, $mes, $dia + 1, $ano);
            $dia       = date('d', $timestamp);
            $mes       = date('m', $timestamp);
            $ano       = date('Y', $timestamp);
            $date_br   = new DateTimeBr("$ano-$mes-$dia");
            $this->assertEquals($timestamp, $date_br->timestamp);
        }
    }

    /**
     * @group slow
     * Confere se todos os segundos de um dia estão gerando o timestamp da maneira correta.
     */
    public function testContructDateBr()
    {
        $ano = date('Y', time());
        $mes = date('m', time());;
        $dia = date('d', time());;
        $hora = 0;
        $min  = 0;
        $sec  = 0;
        $stop = $dia + 1;

        while ($dia < $stop) {
            $timestamp = mktime($hora, $min, $sec + 1, $mes, $dia, $ano);
            $dia       = date('d', $timestamp);
            $mes       = date('m', $timestamp);
            $ano       = date('Y', $timestamp);
            $hora      = date('H', $timestamp);
            $min       = date('i', $timestamp);
            $sec       = date('s', $timestamp);
            $date_br   = new DateTimeBr("$dia/$mes/$ano $hora:$min:$sec");
            $this->assertEquals($timestamp, $date_br->timestamp);
        }
    }

    /**
     * @group slow
     * Testa o construtor do DateBr passando timestemp por 30 dias
     */
    public function testContructTimestamp()
    {
        $Y = date('Y', time());
        $m = date('m', time());;
        $d   = 0;
        $H   = 0;
        $i   = 0;
        $s   = 0;
        $stp = $d + 30;

        while ($d < $stp) {
            $tmstp = mktime($H, $i, $s, $m, $d + 1, $Y);
            $d     = date('d', $tmstp);
            $m     = date('m', $tmstp);
            $Y     = date('Y', $tmstp);
            $H     = date('H', $tmstp);
            $i     = date('i', $tmstp);
            $s     = date('s', $tmstp);

            $dateBr = new DateTimeBr((int)$tmstp);
            $this->assertEquals($tmstp, $dateBr->timestamp);
            $dateBr = new DateTimeBr((string)$tmstp);
            $this->assertEquals($tmstp, $dateBr->timestamp);
        }
    }

    /**
     * Verifica se a difereca de dias entre as duas datas retornadas pela funcao esta correta
     */
    public function testIntervalDays()
    {
        $date = new DateTimeBr('2013-10-01');
        $date1 = new DateTimeBr('2013-09-01');
        $date2 = new DateTimeBr('2013-11-01');
        $this->assertEquals(30, $date->intervalDays(new DateTimeBr('2013-10-31')));
        $this->assertEquals(-7, $date1->intervalDays(new DateTimeBr('2013-08-25')));
        $this->assertEquals(30,  $date2->intervalDays(new DateTimeBr('2013-12-1')));
    }

    /**
     * Verifica o retorno de compareDate.
     */
    public function testCompareDate()
    {
        $date = new DateTimeBr('2013-10-01');
        $this->assertEquals(1, $date->compareDate(new DateTimeBr('2013-09-25')));
        $this->assertEquals(0, $date->compareDate(new DateTimeBr('2013-10-01')));
        $this->assertEquals(-1, $date->compareDate(new DateTimeBr('2013-10-25')));
    }

    /**
     * Verifica se o create date está funcionando normalmente
     */
    public function testCreateDate()
    {
        $this->assertEquals(Date('d/m/Y H:i:s', time()), DateTimeBr::createDate('now'));
        $this->assertEquals('2013-11-07 00:00:00', DateTimeBr::createDate('2013-11-07')->toDateTimeString());
    }

    /**
     * Verifica se a funcao retorna null ou nao de acordo com o parametro passado
     */
    public function testNull()
    {
        $this->assertNull(DateTimeBr::createDate());
        $this->assertNotNull(DateTimeBr::createDate('now'));
    }

    /**
     * Verifica se parametro errado gera excecao
     */
    public function testException()
    {
        $this->expectException(DomainException::class);
        DateTimeBr::createDate('nogsgsw');
    }

    public function testExtenso()
    {
        $date = new DateTimeBr('2013-11-08 22:15:03');
        $this->assertEquals('sexta-feira, 08 de novembro de 2013', $date->dataExtenso(1));
        $this->assertEquals('08 de novembro de 2013', $date->dataExtenso(2));
        $this->assertEquals('sexta-feira, 08 de novembro de 2013 as 22:15:03', $date->dataExtenso(3));
        $this->assertEquals('08 de novembro de 2013 as 22:15:03', $date->dataExtenso(4));
    }
}
