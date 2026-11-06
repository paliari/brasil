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
        $str = mb_convert_encoding($str, 'ISO-8859-1', 'UTF-8');

        return strtr($str, mb_convert_encoding('áéíóúãõâêÁÉÍÓÚÃÕÂÊ', 'ISO-8859-1', 'UTF-8'), 'aeiouazaeAEIOUAZAE');
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
