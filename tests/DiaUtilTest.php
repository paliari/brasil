<?php

use Paliari\Brasil\DateTime\DiaUtil;
use Paliari\Brasil\DateTime\DateTimeBr;

class DiaUtilTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Verifica se a data da pascoa de alguns anos estão corretas
     */
    public function testPascoa()
    {
        $this->assertEquals('31/03/2013', DiaUtil::dataPascoa(new DateTimeBr('22/04/2013 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('20/04/2014', DiaUtil::dataPascoa(new DateTimeBr('30/04/2014 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('05/04/2015', DiaUtil::dataPascoa(new DateTimeBr('10/04/2015 00:00:00'))->format('d/m/Y'));
    }

    /**
     * Verifica se a data da pascoa está sempre no domingo
     */
    public function testSemanaPascoa()
    {
        for ($i = 2000; $i < 2100; $i++) {
            $this->assertEquals(0, DiaUtil::dataPascoa(new DateTimeBr("17/04/$i 00:00:00"))->format('w'));
        }
    }

    /**
     * Verifica se a data da Paixão de cristo está correta
     */
    public function testPaixao()
    {
        $this->assertEquals('03/04/2015', DiaUtil::dataPaixaoCristo(new DateTimeBr('10/09/2015 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('25/03/2016', DiaUtil::dataPaixaoCristo(new DateTimeBr('10/06/2016 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('14/04/2017', DiaUtil::dataPaixaoCristo(new DateTimeBr('10/04/2017 00:00:00'))->format('d/m/Y'));
    }

    /**
     * Verifica se a data da PaixaoCristo está sempre na sexta
     */
    public function testSemanaPaixao()
    {
        for ($i = 2000; $i < 2100; $i++) {
            $this->assertEquals(5, DiaUtil::dataPaixaoCristo(new DateTimeBr("10/04/$i 00:00:00"))->format('w'));
        }
    }

    /**
     * Verifica se a Quarta-Feira de Cinzas está correta
     */
    public function testQuartaCinzas()
    {
        $this->assertEquals('18/02/2015', DiaUtil::dataQuartaCinzas(new DateTimeBr('10/04/2015 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('10/02/2016', DiaUtil::dataQuartaCinzas(new DateTimeBr('23/04/2016 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('01/03/2017', DiaUtil::dataQuartaCinzas(new DateTimeBr('19/04/2017 00:00:00'))->format('d/m/Y'));
    }

    /**
     * Verifica se a data da Quarta-Feira de cinzas está sempre na quarta-feira
     */
    public function testSemanaCinzas()
    {
        for ($i = 2000; $i < 2100; $i++) {
            $this->assertEquals(3, DiaUtil::dataQuartaCinzas(new DateTimeBr("10/04/$i 00:00:00"))->format('w'));
        }
    }

    /**
     * Verifica se a Quarta-Feira de Cinzas está correta
     */
    public function testCorpusChristi()
    {
        $this->assertEquals('04/06/2015', DiaUtil::dataCorpusChristi(new DateTimeBr('15/04/2015 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('26/05/2016', DiaUtil::dataCorpusChristi(new DateTimeBr('10/04/2016 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('15/06/2017', DiaUtil::dataCorpusChristi(new DateTimeBr('21/04/2017 00:00:00'))->format('d/m/Y'));
    }

    /**
     * Verifica se a data da Quarta-Feira de cinzas está sempre na quarta-feira
     */
    /*public function testSemanaCorpusChristi()
    {
        for ($i = 2000; $i < 2100; $i++) {
            $this->assertEquals(4, DiaUtil::dataCorpusChristi(new DateTimeBr("10/04/$i 00:00:00"))->dateTimeToString('w'));
        }
    }*/

    /**
     * Verifica se a Quarta-Feira de Cinzas está correta
     */
    public function testCarnaval()
    {
        $this->assertEquals('17/02/2015', DiaUtil::dataCarnaval(new DateTimeBr('25/09/2015 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('09/02/2016', DiaUtil::dataCarnaval(new DateTimeBr('10/04/2016 00:00:00'))->format('d/m/Y'));
        $this->assertEquals('28/02/2017', DiaUtil::dataCarnaval(new DateTimeBr('05/04/2017 00:00:00'))->format('d/m/Y'));
    }

    /**
     * Verifica se a data da Quarta-Feira de cinzas está sempre na quarta-feira
     */
    public function testSemanaCarnaval()
    {
        for ($i = 2000; $i < 2100; $i++) {
            $this->assertEquals(2, DiaUtil::dataCarnaval(new DateTimeBr("10/04/$i 00:00:00"))->format('w'));
        }
    }

    /**
     * Verifica se a data passada é fim de semana
     */
    public function testWeekend()
    {
        $this->assertTrue(DiaUtil::isWeekend(new DateTimeBr('26/10/2013 00:00:00')));
        $this->assertFalse(DiaUtil::isWeekend(new DateTimeBr('25/10/2013 00:00:00')));
    }

    /**
     * Verifica se as datas passadas são feriado
     */
    public function testFeriado()
    {
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('01/01/2013 00:00:00')));
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('21/04/2013 00:00:00')));
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('01/05/2013 00:00:00')));
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('07/09/2013 00:00:00')));
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('12/10/2013 00:00:00')));
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('02/11/2013 00:00:00')));
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('15/11/2013 00:00:00')));
        $this->assertTrue(DiaUtil::isFeriado(new DateTimeBr('25/12/2013 00:00:00')));
    }
}
