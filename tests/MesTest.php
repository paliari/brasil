<?php

use Paliari\Brasil\Mes;

class MesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Testa se o array tem realmente 12 posições;
     */
    public function testCountSiglas()
    {
        $this->assertCount(12, Mes::$SIGLAS);
    }

    /**
     * Testa se o array tem realmente 12 posições;
     */
    public function testCountNomes()
    {
        $this->assertCount(12, Mes::$NOMES);
    }

    /**
     * Testa se as siglas correspondem com as iniciais dos nomes
     */
    public function testNomeSigla()
    {
        foreach (Mes::$NOMES as $k => $v) {
            $this->assertEquals(Mes::$SIGLAS[$k], substr($v, 0, 3));
        }
    }

    /**
     * Verifica se os meses estão em ordem crescente
     */
    public function testOrdemCrescente()
    {
        $ordenado = Mes::$SIGLAS;
        ksort($ordenado);
        $this->assertSame($ordenado, Mes::$SIGLAS);

        $ordenado = Mes::$NOMES;
        ksort($ordenado);
        $this->assertSame($ordenado, Mes::$NOMES);
    }
}
