<?php

use Paliari\Brasil\DateTime\DataExtenso,
    Paliari\Brasil\DateTime\DateTimeBr,
    Paliari\Brasil\DateTime\DateBr;

class DataExtensoTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAno()
    {
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, strtotime('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, strtotime('20131025113001')));
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, strtotime('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAno()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, strtotime('2013-10-25 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, strtotime('20131025113001')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, strtotime('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAnoHora()
    {
        $this->assertEquals('25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, strtotime('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, strtotime('20131025113001')));
        $this->assertEquals('25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, strtotime('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAnoHora()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, strtotime('2013-10-25 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, strtotime('20131025113001')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, strtotime('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAnoDateTimeBr()
    {
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, new DateTimeBr('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, new DateTimeBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAnoDateTimeBr()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, new DateTimeBr('2013-10-25 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, new DateTimeBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAnoHoraDateTimeBr()
    {
        $this->assertEquals('25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, new DateTimeBr('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, new DateTimeBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAnoHoraDateTimeBr()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateTimeBr('2013-10-25 11:30:01')));
        $this->assertEquals('quarta-feira, 23 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateTimeBr('2013-10-23 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateTimeBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAnoDateBr()
    {
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, new DateBr('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, new DateBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAnoDateBr()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, new DateBr('2013-10-25 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, new DateBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAnoHoraDateBr()
    {
        $this->assertEquals('25 de outubro de 2013 as 00:00:00', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, new DateBr('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013 as 00:00:00', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, new DateBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAnoHoraDateBr()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 00:00:00', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateBr('2013-10-25 11:30:01')));
        $this->assertEquals('quarta-feira, 23 de outubro de 2013 as 00:00:00', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateBr('2013-10-23 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 00:00:00', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateBr('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAnoDateTime()
    {
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, new DateTime('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013', DataExtenso::formatar(DataExtenso::DIA_MES_ANO, new DateTime('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAnoDateTime()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, new DateTime('2013-10-25 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO, new DateTime('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testDiaMesAnoHoraDateTime()
    {
        $this->assertEquals('25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, new DateTime('2013-10-25 11:30:01')));
        $this->assertEquals('25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::DIA_MES_ANO_HORA, new DateTime('10/25/2013 11:30:01')));
    }

    /**
     * Verifica se a data rotorna por extenso corretamente.
     */
    public function testSemanaDiaMesAnoHoraDateTime()
    {
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateTime('2013-10-25 11:30:01')));
        $this->assertEquals('quarta-feira, 23 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateTime('2013-10-23 11:30:01')));
        $this->assertEquals('sexta-feira, 25 de outubro de 2013 as 11:30:01', DataExtenso::formatar(DataExtenso::SEMANA_DIA_MES_ANO_HORA, new DateTime('10/25/2013 11:30:01')));
    }
}
