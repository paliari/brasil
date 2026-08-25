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
     * @param string $cnpj
     *
     * @return string
     */
    public static function digitos($cnpj)
    {
        // 1. Remove qualquer caractere que não seja letra ou número e força maiúsculas
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', (string)$cnpj));
    }

    /**
     * Retorna o cnpj formatado como: 92.122.313/0001-30
     *
     * @param string $cnpj
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
     * Verifica se o CNPJ está no formato: 00.000.000/0000-00
     *
     * @param string $cnpj
     *
     * @return bool
     */
    public static function validarFormato($cnpj)
    {
        return preg_match('!\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}!', (string)$cnpj) === 1;
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
        // Remove caracteres não alfanuméricos (pontos, barras, traços)
        $cnpj = strtoupper(preg_replace('/[^A-Z0-9]/', '', $cnpj));

        // Verifica se tem 14 caracteres
        if (strlen($cnpj) !== 14) {
            return false;
        }
        // 3. Impede sequências idênticas conhecidas (ex: "00000000000000", "11111111111111", etc.)
        if (preg_match('/^([A-Z0-9])\1{13}$/', $cnpj)) {
            return false;
        }

        // Valida 1º dígito verificador
        $soma = 0;
        $peso = 5;
        for ($i = 0; $i < 12; $i++) {
            $valor = static::converteCaractere($cnpj[$i]);
            $soma += $valor * $peso;
            $peso = ($peso == 2) ? 9 : $peso - 1;
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        if ((int)$cnpj[12] !== $digito1) {
            return false;
        }

        // Valida 2º dígito verificador
        $soma = 0;
        $peso = 6;
        for ($i = 0; $i < 13; $i++) {
            $valor = static::converteCaractere($cnpj[$i]);
            $soma += $valor * $peso;
            $peso = ($peso == 2) ? 9 : $peso - 1;
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        return (int)$cnpj[13] === $digito2;
    }

    /**
     * Função auxiliar para converter caractere (número ou letra) em valor numérico
     *
     * @param string $char
     * @return int
     */
    public static function converteCaractere($char)
    {
        $code = ord($char);
        // Se for número ('0'-'9' -> ASCII 48-57), subtrai 48
        // Se for letra ('A'-'Z' -> ASCII 65-90), subtrai 48 também (A = 65 - 48 = 17)
        return $code - 48;
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
