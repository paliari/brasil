<?php

namespace Paliari\Brasil;

/**
 * @see     https://github.com/BrazilianFriendsOfSymfony/BFOSBrasilBundle/blob/master/Validator/Constraints/CpfcnpjValidator.php
 * Class CNPJ
 * @package Paliari\Brasil
 */
class CNPJ
{
    /**
     * Retorna apenas os caracteres alfanuméricos do CNPJ, em maiúsculas, limitado a 14
     *
     * @param string $cnpj
     *
     * @return string
     */
    public static function digitos($cnpj)
    {
        return substr(strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string)$cnpj)), 0, 14);
    }

    /**
     * Retorna o cnpj formatado como: 92.122.313/0001-30 ou 12.ABC.345/01DE-35
     *
     * @param string $cnpj
     *
     * @return string
     */
    public static function formatar($cnpj)
    {
        $cnpj = static::digitos($cnpj);
        if (!static::dvNumerico($cnpj)) {
            return "";
        }
        $partes[] = substr($cnpj, 0, 2);
        $partes[] = substr($cnpj, 2, 3);
        $partes[] = substr($cnpj, 5, 3);
        $filiais = substr($cnpj, 8, 4);
        $verificador = substr($cnpj, 12);

        return implode(".", $partes) . '/' . $filiais . '-' . $verificador;
    }

    /**
     * Retorna os dígitos verificadores (2 últimos dígitos)
     *
     * @param string $cnpj
     *
     * @return string
     */
    public static function verificador($cnpj)
    {
        $cnpj = static::formatar($cnpj);

        return substr($cnpj, -2);
    }

    /**
     * Verifica se o CNPJ está no formato: XX.XXX.XXX/XXXX-99
     *
     * @param string $cnpj
     *
     * @return bool
     */
    public static function validarFormato($cnpj)
    {
        $regex = '!^[A-Z0-9]{2}\.[A-Z0-9]{3}\.[A-Z0-9]{3}/[A-Z0-9]{4}-\d{2}$!';

        return preg_match($regex, strtoupper((string)$cnpj)) === 1;
    }

    /**
     * Verifica se o dígito verificador está correto e se o CNPJ é válido.
     *
     * @param string $cnpj
     *
     * @return bool
     */
    public static function validar($cnpj)
    {
        $cnpj = static::digitos($cnpj);
        if (!static::dvNumerico($cnpj)) {
            return false;
        }
        if (preg_match('/^([A-Z0-9])\1{13}$/', $cnpj)) {
            return false;
        }
        $d1 = static::calcularDv(substr($cnpj, 0, 12), 5);
        $d2 = static::calcularDv(substr($cnpj, 0, 13), 6);

        return (int)$cnpj[12] === $d1 && (int)$cnpj[13] === $d2;
    }

    /**
     * Função auxiliar para converter caractere (número ou letra) em valor numérico.
     * '0'-'9' => 0-9, 'A'-'Z' => 17-42
     *
     * @param string $char
     *
     * @return int
     */
    public static function converteCaractere($char)
    {
        return ord($char) - 48;
    }

    /**
     * Função responsável por gerar um CNPJ válido.
     *
     * @param bool $alfanumerico
     *
     * @return string
     */
    public static function gerar($alfanumerico = false)
    {
        if ($alfanumerico) {
            $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $base = '';
            for ($i = 0; $i < 12; $i++) {
                $base .= $caracteres[random_int(0, 35)];
            }
        } else {
            $base = '';
            for ($i = 0; $i < 8; $i++) {
                $base .= random_int(0, 9);
            }
            $base .= '0001';
        }
        $base .= static::calcularDv($base, 5);
        $base .= static::calcularDv($base, 6);

        return static::formatar($base);
    }

    /**
     * Verifica se o CNPJ tem 14 caracteres e os 2 dígitos verificadores são numéricos
     *
     * @param string $cnpj
     *
     * @return bool
     */
    protected static function dvNumerico($cnpj)
    {
        return strlen($cnpj) === 14 && ctype_digit(substr($cnpj, 12));
    }

    /**
     * Calcula um dígito verificador (módulo 11) com pesos decrescentes de $pesoInicial até 2, reiniciando em 9
     *
     * @param string $base
     * @param int $pesoInicial
     *
     * @return int
     */
    protected static function calcularDv($base, $pesoInicial)
    {
        $soma = 0;
        $peso = $pesoInicial;
        for ($i = 0, $len = strlen($base); $i < $len; $i++) {
            $soma += static::converteCaractere($base[$i]) * $peso;
            $peso = ($peso == 2) ? 9 : $peso - 1;
        }
        $resto = $soma % 11;

        return ($resto < 2) ? 0 : 11 - $resto;
    }
}
