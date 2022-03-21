<?php

namespace Paliari\Brasil;

use Paliari\Brasil\CNPJ;
use Paliari\Brasil\CPF;

class Mascaras
{
    /**
     * Retorna o CNPJ no formato 00.000.000/0000-00
     *
     * @param $cnpj
     *
     * @return string
     */
    public static function formataCNPJ($cnpj)
    {
        return CNPJ::formatar($cnpj);
    }

    /**
     * Retorna o CPF no formato 000.000.000-00
     *
     * @param $cpf
     *
     * @return string
     */
    public static function formataCPF($cpf)
    {
        return CPF::formatar($cpf);
    }

    /**
     * Retorna CPF ou CNPJ formatado
     *
     * @param string $str
     *
     * @return string
     */
    public static function formataCPFCNPJ($str)
    {
        $str = preg_replace('![^\d]!', '', (string)$str);
        if (11 == strlen($str) || 14 > strlen($str)) {
            $str = CPF::formatar($str);
        } elseif (14 <= strlen($str)) {
            $str = CNPJ::formatar($str);
        }

        return $str;
    }

    /**
     * Retorna COSIF em seu formato correto
     *
     * @param  string $cosif (8 caracteres)
     *
     * @return bool|string
     */
    public static function formataCOSIF($cosif)
    {
        if (8 == strlen($cosif)) {
            $ret = substr($cosif, 0, 1) . '.' . substr($cosif, 1, 1) . '.' . substr($cosif, 2, 1)
                . '.' . substr($cosif, 3, 2) . '.' . substr($cosif, 5, 2) . '-' . substr($cosif, 7, 1);
        } else {
            $ret = false;
        }

        return $ret;
    }

    /**
     * Retorna CMC no formato correto
     *
     * @param $cmc
     *
     * @return string
     */
    public static function formataCMC($cmc)
    {
        $ret = str_pad($cmc, 6, '0', STR_PAD_LEFT);

        return $ret;
    }

    /**
     * Retorna o cep no formato correto
     *
     * @param  string $cep
     *
     * @return bool|string
     */
    public static function formataCEP($cep)
    {
        if (8 == strlen($cep)) {
            $ret = substr($cep, 0, 2) . '.' . substr($cep, 2, 3) . '-' . substr($cep, 5, 3);
        } else {
            $ret = false;
        }

        return $ret;
    }

    /**
     * Retorna CodLS no formato correto
     *
     * @param $val
     *
     * @return string
     */
    public static function formataCodLS($val)
    {
        if ($val) {
            $val = substr($val, 0, 2) . '.' . substr($val, 2, 2);
        }

        return $val;
    }

    /**
     * Retorna o telefone no formato correto
     *
     * @param string $str
     *
     * @return string
     */
    public static function formataFone($str)
    {
        $str = preg_replace("/[^0-9]/", '', (string)$str);
        if (!$str) {
            return '';
        }
        if ('0800' == substr($str, 0, 4)) {
            $srt = substr($str, -11, -7) . ' ' . substr($str, -7, -4) . '-' . substr($str, -4);
        } elseif (11 == strlen($str)) {
            $srt = '(' . substr($str, -11, -9) . ') ' . substr($str, -9, -4) . '-' . substr($str, -4);
        } else {
            $srt = '(' . substr($str, -10, -8) . ') ' . substr($str, -8, -4) . '-' . substr($str, -4);
        }

        return $srt;
    }

    /**
     * Máscara para formatar CodVal
     *
     * @param $str
     *
     * @return string
     */
    public static function formataCodVal($str)
    {
        $srt = substr($str, 0, 3) . '-' . substr($str, 3, 3) . '-' . substr($str, 6, 3);

        return $srt;
    }

    /**
     * Retorna valor no formato 000.000,00
     *
     * @param  double $value
     * @param  bool   $clean
     *
     * @return string
     */
    public static function formataMoeda($value, $clean = true)
    {
        $value = (double)$value;

        return ($value || !$clean) ? number_format($value, 2, ',', '.') : '';
    }

    /**
     * Retorna valor com seu formato e a quantidade de casas decimais desejadas
     *
     * @param  double $value
     * @param  int    $decimal (Quantidade de casas decimais a serem retornadas)
     *
     * @return string
     */
    public static function formataNumero($value, $decimal = 2)
    {
        return $value ? number_format($value, $decimal, ',', '.') : '';
    }
}
