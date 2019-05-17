<?php

use Paliari\Brasil\Mascaras;

class MascarasTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Testa o retorno do CNPJ no formato 00.000.000/0000-00
     * Caso o CNPJ informado tenha menos de 14 dígitos retorna vazio,
     * caso maior retorna os 14 primeiro dígitos formatados
     */
    public function testCNPJ()
    {
        $this->assertEquals("92.122.313/0001-30", Mascaras::formataCNPJ("9212-2313000130"));
        $this->assertEquals("92.122.313/0001-53", Mascaras::formataCNPJ("92122313teste0001530"));
        $this->assertEquals("", Mascaras::formataCNPJ("921223130"));
    }

    /**
     * Testa o retorno do CPF no formato 123.456.789-01
     * Caso o CPF tenha menos de 11 dígitos retorna vazio,
     * caso maior retorna os 11 primeiro dígitos formatados
     */
    public function testCPF()
    {
        $this->assertEquals("123.456.789-01", Mascaras::formataCPF("123456.789-01"));
        $this->assertEquals("", Mascaras::formataCPF("12345789-01"));
        $this->assertEquals("", Mascaras::formataCPF("12345701"));
        $this->assertEquals("142.345.367-83", Mascaras::formataCPF("1423.4536.7839-901"));
        $this->assertEquals("", Mascaras::formataCPF("14A.536.839-91"));
        $this->assertEquals(14, strlen(Mascaras::formataCPF("142.453.739-90")));
    }

    /**
     * Testa o retorno do CPF/CNPJ
     */
    public function testCPFCNPJ()
    {
        $this->assertEquals("92.122.313/0001-30", Mascaras::formataCPFCNPJ("9212-2313000130"));
        $this->assertEquals("92.122.313/0001-53", Mascaras::formataCPFCNPJ("92122313teste0001530"));
        $this->assertEquals("", Mascaras::formataCPFCNPJ("921223130"));
    }

    /**
     * Testa o retorno do COSIF
     */
    public function testCOSIF()
    {
        $this->assertEquals("2.3.5.43.52-9", Mascaras::formataCOSIF("23543529"));
        $this->assertEquals(13, strlen(Mascaras::formataCOSIF("23547629")));
        $this->assertTrue(Mascaras::formataCOSIF("23547629") ? true : false);
        $this->assertFalse(Mascaras::formataCOSIF("23543113123529"));
    }

    /**
     * Testa o retorno do CMC
     */
    public function testCMC()
    {
        $this->assertEquals("23543529", Mascaras::formataCMC("23543529"));
        $this->assertEquals(6, strlen(Mascaras::formataCMC("229")));
        $this->assertEquals('000029', Mascaras::formataCMC("29"));
        $this->assertEquals('000000', Mascaras::formataCMC(""));
        $this->assertEquals('2424242442', Mascaras::formataCMC("2424242442"));
    }

    /**
     * Testa o retorno do CEP
     */
    public function testCEP()
    {
        $this->assertEquals("87.020-160", Mascaras::formataCEP("87020160"));
        $this->assertEquals(false, strlen(Mascaras::formataCEP("86730-000")));
        $this->assertFalse(Mascaras::formataCEP("87.020160"));
        $this->assertFalse(Mascaras::formataCEP("23543113123529"));
    }

    /**
     * Testa o retorno do CodLS
     */
    public function testCodLS()
    {
        $this->assertEquals("8s.fs", Mascaras::formataCodLS("8sfs7020"));
        $this->assertEquals("20.01", Mascaras::formataCodLS("2001"));
        $this->assertEquals("20.1", Mascaras::formataCodLS("201"));
        $this->assertEquals("20.", Mascaras::formataCodLS("20"));
        $this->assertEquals("", Mascaras::formataCodLS(""));
        $this->assertEquals("12.54", Mascaras::formataCodLS("1254234234"));
    }

    /**
     * Testa o retorno do CodLS
     */
    public function testFone()
    {
        $this->assertEquals("0800 242-4243", Mascaras::formataFone("08002424243"));
        $this->assertEquals("(44) 9999-9999", Mascaras::formataFone("4499999999"));
        $this->assertEquals("(44) 99999-9999", Mascaras::formataFone("44999999999"));
        $this->assertEquals("() 99-9999", Mascaras::formataFone("999999"));
        $this->assertEquals("(67) 8999-9999", Mascaras::formataFone("123456789999999"));
        $this->assertEquals("", Mascaras::formataFone(""));
    }

    /**
     * Testa o retorno do CodVal
     */
    public function testCodVal()
    {
        $this->assertEquals("080-024-242", Mascaras::formataCodVal("0800242424242343"));
        $this->assertEquals("243-43-", Mascaras::formataCodVal("24343"));
        $this->assertEquals("--", Mascaras::formataCodVal(""));
        $this->assertEquals("456-243-987", Mascaras::formataCodVal("456243987"));
    }

    /**
     * Testa o retorno do formato da moeda
     */
    public function testMoeda()
    {
        $this->assertEquals("2.424.242.423,43", Mascaras::formataMoeda("2424242423.43"));
        $this->assertEquals("242.424.242.343,00", Mascaras::formataMoeda("242424242343"));
        $this->assertEquals('2.424.242.423,43', Mascaras::formataMoeda(2424242423.43));
        $this->assertEquals("242.424.242.343,00", Mascaras::formataMoeda(242424242343));
        $this->assertEquals('', Mascaras::formataMoeda(''));
        $this->assertEquals('1,00', Mascaras::formataMoeda('1'));
        $this->assertEquals('', Mascaras::formataMoeda(''));
    }

    /**
     * Testa o retorno do formato de um número
     */
    public function testNumero()
    {
        $this->assertEquals("2.424.242.423,43", Mascaras::formataNumero("2424242423.43"));
        $this->assertEquals("242.424.242.343,00", Mascaras::formataNumero("242424242343"));
        $this->assertEquals('2.424.242.423,43', Mascaras::formataNumero(2424242423.43));
        $this->assertEquals("242.424.242.343,00", Mascaras::formataNumero(242424242343));
        $this->assertEquals('', Mascaras::formataNumero(''));
        $this->assertEquals('1,00', Mascaras::formataNumero('1'));
        $this->assertEquals('', Mascaras::formataNumero(''));
    }
}
