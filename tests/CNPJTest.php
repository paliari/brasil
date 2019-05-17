<?php

use Paliari\Brasil\CNPJ;

class CNPJTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Teste que retorna somente os dígitos od cnpj.
     */
    public function testDigitos()
    {
        $digitos = CNPJ::digitos("92.122.313/0001-30");
        $this->assertEquals("92122313000130", $digitos);
        $digitos = CNPJ::digitos("92.12s2.313/0e001-30");
        $this->assertEquals("92122313000130", $digitos);
    }

    /**
     * Testa o retorno do CNPJ no formato 00.000.000/0000-00
     * Caso o CNPJ informado tenha menos de 14 dígitos retorna vazio,
     * caso maior retorna os 14 primeiro dígitos formatados
     */
    public function testFormatar()
    {
        $cnpjFormatado = CNPJ::formatar("9212-2313000130");
        $this->assertEquals("92.122.313/0001-30", $cnpjFormatado);

        $cnpjFormatado = CNPJ::formatar("92122313teste0001530");
        $this->assertEquals("92.122.313/0001-53", $cnpjFormatado);

        $cnpjFormatado = CNPJ::formatar("921223130");
        $this->assertEquals("", $cnpjFormatado);
    }

    /**
     * Retorna os dígitos verificadores do CNPJ informado.
     */
    public function testDigitosVerificadores()
    {
        $verificadores = CNPJ::verificador("92.122.313/0001-30");
        $this->assertEquals("30", $verificadores);

        $verificadores = CNPJ::verificador("92.122.313/0001-0");
        $this->assertEquals("", $verificadores);

        $verificadores = CNPJ::verificador("92122313000130");
        $this->assertEquals("30", $verificadores);

        $verificadores = CNPJ::verificador("92122313000130444444444");
        $this->assertEquals("30", $verificadores);
    }

    /**
     * Testa se o CNPJ está no formato correto.
     */
    public function testValidarFormato()
    {
        $this->assertTrue(CNPJ::validarFormato("92.122.313/0001-30"));
        $this->assertFalse(CNPJ::validarFormato("92.122.313/001-30"));
    }

    /**
     * Verifica se o CNPJ é válido.
     */
    public function testValidacao()
    {
        $this->assertTrue(CNPJ::validar("92.122.313/0001-30"));
        $this->assertFalse(CNPJ::validar("92.122.313/0001-31"));
        $this->assertTrue(CNPJ::validar("00.000.000/0001-91"));
        for ($i = 0; $i < 10; $i++) {
            $this->assertFalse(CNPJ::validar("$i$i.$i$i$i.$i$i$i/$i$i$i$i-$i$i"));
        }
        for ($i = 0; $i < 100; $i++) {
            $this->assertTrue(CNPJ::validar(CNPJ::gerar()));
        }
    }
}
