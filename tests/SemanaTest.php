<?php

use Paliari\Brasil\Semana;

class SemanaTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Testa se o array tem realmente 7 posições;
     */
    public function testCountSiglas()
    {
        $this->assertCount(7, Semana::$SIGLAS);
    }

    /**
     * Testa se o array tem realmente 7 posições;
     */
    public function testCountNomes()
    {
        $this->assertCount(7, Semana::$NOMES);
    }

    /**
     * Testa se as siglas correspondem com as iniciais dos nomes
     */
    public function testNomeSigla()
    {
        foreach (Semana::$NOMES as $k => $v) {
            $this->assertEquals(Semana::$SIGLAS[$k], $this->removeAcento(mb_substr($v, 0, 3, "UTF-8")));
        }
    }

    /**
     * @param $str
     * @return string
     * Remove os acentos da string
     */
    protected static function removeAcento($str)
    {
        $str = utf8_decode($str);

        return strtr($str, utf8_decode('áéíóúãõâêÁÉÍÓÚÃÕÂÊ'), 'aeiouazaeAEIOUAZAE');
    }

    /**
     * Verifica se os dias da semana estão em ordem crescente
     */
    public function testOrdemCrescente()
    {
        $ordenado = Semana::$SIGLAS;
        ksort($ordenado);
        $this->assertSame($ordenado, Semana::$SIGLAS);

        $ordenado = Semana::$NOMES;
        ksort($ordenado);
        $this->assertSame($ordenado, Semana::$NOMES);
    }
}
