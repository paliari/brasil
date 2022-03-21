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
     * Retorna apenas os dígitos do CNPJ
     *
     * @param $cnpj
     *
     * @return string
     */
    public static function digitos($cnpj)
    {
        return substr(preg_replace('![^\d]!', '', $cnpj), 0, 14);
    }

    /**
     * Retorna o cnpj formatado como: 92.122.313/0001-30
     *
     * @param $cnpj
     *
     * @return string
     */
    public static function formatar($cnpj)
    {
        $cnpj = static::digitos($cnpj);
        if (strlen($cnpj) != 14) {
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
     * @param $cnpj
     *
     * @return string
     */
    public static function verificador($cnpj)
    {
        $cnpj = static::formatar($cnpj);

        return substr($cnpj, -2);
    }

    /**
     * Verifica se o CNPJ está no formato: 00.000.000/0000-00
     *
     * @param $cnpj
     *
     * @return bool
     */
    public static function validarFormato($cnpj)
    {
        return preg_match('!\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}!', $cnpj) === 1;
    }

    /**
     * Verifica se o dígito verificador está correto e se o CNPJ é válido.
     *
     * @param $cnpj
     *
     * @return bool
     */
    public static function validar($cnpj)
    {
        $cnpj = static::digitos($cnpj);
        if (strlen($cnpj) <> 14) {
            return false;
        }
        $regex = "/^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/";
        if (preg_match($regex, $cnpj)) {
            return false;
        }
        // Primeiro dígito
        $multiplicadores = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i <= 11; $i++) {
            $soma += $multiplicadores[$i] * $cnpj[$i];
        }
        $d1 = 11 - ($soma % 11);
        if ($d1 >= 10) {
            $d1 = 0;
        }
        // Segundo dígito
        $multiplicadores = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i <= 12; $i++) {
            $soma += $multiplicadores[$i] * $cnpj[$i];
        }
        $d2 = 11 - ($soma % 11);
        if ($d2 >= 10) {
            $d2 = 0;
        }

        return $d1 == $cnpj[12] && $d2 == $cnpj[13];
    }

    /**
     * Função responsável por gerar um CNPJ válido.
     * @return string
     */
    public static function gerar()
    {
        $cnpj = [];
        for ($i = 0; $i < 8; $i++) {
            $cnpj[$i] = rand(0, 9);
        }
        $cnpj[8] = 0;
        $cnpj[9] = 0;
        $cnpj[10] = 0;
        $cnpj[11] = 1;
        // Primeiro dígito
        $multiplicadores = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i <= 11; $i++) {
            $soma += $multiplicadores[$i] * $cnpj[$i];
        }
        $d1 = 11 - ($soma % 11);
        if ($d1 >= 10) {
            $d1 = 0;
        }
        $cnpj[12] = $d1;
        // Segundo dígito
        $multiplicadores = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $soma = 0;
        for ($i = 0; $i <= 12; $i++) {
            $soma += $multiplicadores[$i] * $cnpj[$i];
        }
        $d2 = 11 - ($soma % 11);
        if ($d2 >= 10) {
            $d2 = 0;
        }
        $cnpj[13] = $d2;

        return static::formatar(implode("", $cnpj));
    }
}
