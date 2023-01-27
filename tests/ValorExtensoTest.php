<?php

use Paliari\Brasil\ValorExtenso;

/**
 * Class ValorExtensoTest
 */
class ValorExtensoTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Realiza testes para a função ValorExtenso
     */
    public function testValorExtenso()
    {
        $this->assertEquals('cinco reais e trinta centavos', ValorExtenso::valorExtenso(5.3));
        $this->assertEquals('Cinco Reais e Trinta Centavos', ValorExtenso::valorExtenso(5.3, true));
        $this->assertEquals('cinco e trinta centésimos', ValorExtenso::valorExtenso(5.3, false, 'N'));
        $this->assertEquals('Cinco e Trinta Centésimos', ValorExtenso::valorExtenso(5.3, true, 'N'));
        $this->assertEquals('Duas e Trinta Centésimos', ValorExtenso::valorExtenso(2.3, true, 'N', 'F'));
        $this->assertEquals('sessenta e oito reais e sessenta centavos', ValorExtenso::valorExtenso(68.6));
        $this->assertEquals('noventa e sete reais e setenta centavos', ValorExtenso::valorExtenso(97.7));
        $this->assertEquals('setenta e cinco reais e sessenta centavos', ValorExtenso::valorExtenso(75.6));
        $this->assertEquals('oitenta e um reais', ValorExtenso::valorExtenso(81));
        $this->assertEquals('setenta e um mil, duzentos e trinta e três reais e vinte centavos', ValorExtenso::valorExtenso(71233.2));
        $this->assertEquals('sessenta e nove mil, quinhentos e treze reais e oitenta centavos', ValorExtenso::valorExtenso(69513.8));
        $this->assertEquals('vinte e quatro mil, duzentos e três reais e cinquenta centavos', ValorExtenso::valorExtenso(24203.5));
        $this->assertEquals('setenta e quatro mil e setecentos e trinta e três reais', ValorExtenso::valorExtenso(74733));
        $this->assertEquals('cinquenta e três milhões, oitocentos e sessenta e oito mil, oitocentos e noventa e seis reais e quarenta centavos', ValorExtenso::valorExtenso(53868896.4));
        $this->assertEquals('cinquenta e sete milhões, oitocentos e oitenta e quatro mil e novecentos e dezesseis reais', ValorExtenso::valorExtenso(57884916));
        $this->assertEquals('vinte e nove milhões, trezentos e trinta e quatro mil, cento e trinta e dois reais e cinquenta centavos', ValorExtenso::valorExtenso(29334132.5));
        $this->assertEquals('noventa e seis milhões, quatrocentos e oitenta e três mil, quinhentos e trinta e oito reais e setenta centavos', ValorExtenso::valorExtenso(96483538.7));
        $this->assertEquals('vinte e três bilhões, oitocentos e setenta e seis milhões, novecentos e trinta e seis mil, quatrocentos e oito reais e trinta centavos', ValorExtenso::valorExtenso(23876936408.3));
        $this->assertEquals('três bilhões, setenta e oito milhões, cento e vinte e nove mil, cento e quarenta e três reais e quarenta centavos', ValorExtenso::valorExtenso(3078129143.4));
        $this->assertEquals('vinte e dois bilhões, setecentos e setenta e nove milhões, cento e doze mil, oitocentos e sessenta e oito reais e cinquenta centavos', ValorExtenso::valorExtenso(22779112868.5));
        $this->assertEquals('vinte e quatro bilhões, setecentos e vinte e nove milhões, duzentos e cinquenta e três mil e quinhentos e oitenta e cinco reais', ValorExtenso::valorExtenso(24729253585));
    }

    /**
     * Verifica se ao passar o parâmetro maiúsculo todas as iniciais da string de retorno estão maiúsculas.
     */
    public function testUpper()
    {
        for ($i = 1; $i < 50; $i++) {
            $this->assertTrue(ctype_upper(substr(ValorExtenso::valorExtenso(rand(1, 9999999)/100, true),0,1)));
        }
    }

    /**
     * Verifica se todas as letras da string de retorno estão minúsculas
     */
    public function testLower()
    {
        for ($i = 1; $i < 50; $i++) {
            $this->assertTrue(ctype_lower(substr(ValorExtenso::valorExtenso(rand(1, 9999999)/100),0,1)));
        }
    }

    /**
     * Verifica se todos os retornos contém a palavra real ou reais
     */
    public function testReais()
    {
        for ($i = 1; $i < 50; $i++) {
            $rand = rand(2, 9999999) / 10;
            $result = ValorExtenso::valorExtenso($rand);
            $this->assertTrue(strripos($result, 'real') || strripos($result, 'reais'));
        }
    }

    /**
     * Verifica se todos os números decimais contém centavo ou centavos
     */
    public function testCentavos()
    {
        for ($i = 1; $i < 50; $i++) {
            $rand = rand(2, 9999999) / 100;
            $result = ValorExtenso::valorExtenso($rand);
            $ext = true;
            if (strripos($rand, '.')) {
                if (strripos($result, 'centavo') === false && strripos($result, 'centavos') === false) {
                    $ext = false;
                }
                $this->assertTrue($ext);
            }
        }
    }
}
