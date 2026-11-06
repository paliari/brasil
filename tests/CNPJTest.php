<?php

use Paliari\Brasil\CNPJ;

class CNPJTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Teste que retorna somente os caracteres alfanuméricos do cnpj, em maiúsculas e limitado a 14.
     */
    public function testDigitos()
    {
        $digitos = CNPJ::digitos("92.122.313/0001-30");
        $this->assertEquals("92122313000130", $digitos);
        $digitos = CNPJ::digitos("92.12s2.313/0e001-30");
        $this->assertEquals("9212S23130E001", $digitos);
        $digitos = CNPJ::digitos("jb.54c.jhk/0001-01");
        $this->assertEquals("JB54CJHK000101", $digitos);
    }

    /**
     * Testa o retorno do CNPJ no formato XX.XXX.XXX/XXXX-99
     * Caso o CNPJ informado tenha menos de 14 caracteres ou DV não numérico retorna vazio,
     * caso maior retorna os 14 primeiros caracteres formatados
     */
    public function testFormatar()
    {
        $cnpjFormatado = CNPJ::formatar("9212-2313000130");
        $this->assertEquals("92.122.313/0001-30", $cnpjFormatado);

        $cnpjFormatado = CNPJ::formatar("12ABC34501DE35");
        $this->assertEquals("12.ABC.345/01DE-35", $cnpjFormatado);

        $cnpjFormatado = CNPJ::formatar("92122313teste0001530");
        $this->assertEquals("", $cnpjFormatado);

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
        $this->assertTrue(CNPJ::validarFormato("12.ABC.345/01DE-35"));
        $this->assertFalse(CNPJ::validarFormato("12.ABC.345/01DE-3A"));
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

    /**
     * Verifica a validação do CNPJ alfanumérico.
     */
    public function testValidacaoAlfanumerico()
    {
        $this->assertTrue(CNPJ::validar("JB.54C.JHK/0001-01"));
        $this->assertTrue(CNPJ::validar("6T.YW9.R14/0001-92"));
        $this->assertTrue(CNPJ::validar("12.ABC.345/01DE-35"));
        $this->assertTrue(CNPJ::validar("12abc34501de35"));
        $this->assertFalse(CNPJ::validar("12.ABC.345/01DE-36"));
        $this->assertTrue(CNPJ::validar("43.783.188/0001-02"));
        $this->assertFalse(CNPJ::validar("43.783.188/0001-A2"));
        for ($i = 0; $i < 100; $i++) {
            $this->assertTrue(CNPJ::validar(CNPJ::gerar(true)));
        }
    }
}
