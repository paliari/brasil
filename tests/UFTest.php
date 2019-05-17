<?php

use Paliari\Brasil\UF;

class UFTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Testa se o array tem realmente 27 posições;
     */
    public function testCountSiglas()
    {
        $this->assertCount(27, UF::$SIGLAS);
    }

    /**
     * Testa se o array tem realmente 27 estados;
     */
    public function testCountNomes()
    {
        $this->assertCount(27, UF::$NOMES);
    }

    /**
     * Testa se o array tem realmente 5 regioes;
     */
    public function testCountRegioes()
    {
        $this->assertCount(5, UF::$REGIOES);
    }

    /**
     * Testa se todas as regioes contem 27 posições
     */
    public function testCountUfRegioes()
    {
        $i = 0;
        foreach (UF::$REGIOES as $k => $v) {
            $i += count(UF::$REGIOES[$k]);
        }
        $this->assertEquals(27, $i);
    }

    /**
     * Testa se os valores das siglas estão corretos, cada qual com sua chave
     */
    public function testChaveValor()
    {
        foreach (UF::$SIGLAS as $k => $v) {
            $this->assertEquals($k, $v);
        }
    }

    /**
     * Verifica se as siglas estão em ordem alfabética
     */
    public function testOrdemAlfabeticaSigla()
    {
        $ordenado = UF::$SIGLAS;
        ksort($ordenado);
        $this->assertSame($ordenado, UF::$SIGLAS);
    }

    /**
     * Verifica se as chaves dos nomes estão em ordem alfabética
     */
    public function testOrdemAlfabeticaNome()
    {
        $ordenado = UF::$NOMES;
        ksort($ordenado);
        $this->assertSame($ordenado, UF::$NOMES);
    }

    /**
     * Verifica se as chaves estão em ordem alfabética dentro de cada regiao
     */
    public function testOrdemAlfabeticaRegiao()
    {
        foreach (UF::$REGIOES as $k => $v) {
            $ordenado = UF::$REGIOES[$k];
            ksort($ordenado);
            $this->assertSame($ordenado, UF::$REGIOES[$k]);
        }
    }
}
