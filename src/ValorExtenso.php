<?php

namespace Paliari\Brasil;

/**
 * Class ValorExtenso
 * @package Paliari\Brasil
 */
class ValorExtenso
{
    /**
     * Função responsável por retornar um valor numérico escrito por extenso.
     * @param int $valor
     * @param bool $maiusculas
     * @param string $moeda
     * @param string $sexo
     * @return mixed|string
     */
    public static function valorExtenso($valor = 0, $maiusculas = false, $moeda = "R", $sexo = "M")
    {
        if ("R" === $moeda) {
            $decSing = "centavo";
            $decPlural = "centavos";
            $intSing = "real";
            $intPlural = "reais";
        } else {
            $decSing = "centésimo";
            $decPlural = "centésimos";
            $intSing = "";
            $intPlural = "";
        }
        $singular = [
            $decSing,
            $intSing,
            "mil",
            "milhão",
            "bilhão",
            "trilhão",
            "quatrilhão",
        ];
        $plural = [
            $decPlural,
            $intPlural,
            "mil",
            "milhões",
            "bilhões",
            "trilhões",
            "quatrilhões",
        ];
        $c = [
            "",
            "cem",
            "duzentos",
            "trezentos",
            "quatrocentos",
            "quinhentos",
            "seiscentos",
            "setecentos",
            "oitocentos",
            "novecentos",
        ];
        $d = [
            "",
            "dez",
            "vinte",
            "trinta",
            "quarenta",
            "cinquenta",
            "sessenta",
            "setenta",
            "oitenta",
            "noventa"];
        $d10 = [
            "dez",
            "onze",
            "doze",
            "treze",
            "quatorze",
            "quinze",
            "dezesseis",
            "dezesete",
            "dezoito",
            "dezenove",
        ];
        if ("M" === $sexo) {
            $u = [
                "",
                "um",
                "dois",
                "três",
                "quatro",
                "cinco",
                "seis",
                "sete",
                "oito",
                "nove",
            ];
        } else {
            $u = [
                "",
                "uma",
                "duas",
                "três",
                "quatro",
                "cinco",
                "seis",
                "sete",
                "oito",
                "nove",
            ];
        }
        $z = 0;
        $rt = "";
        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for ($i = 0; $i < count($inteiro); $i++) {
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++) {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }
        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = (0 < $valor) ? ((1 == $valor[1]) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ("000" == $valor) {
                $z++;
            } elseif ($z > 0) {
                $z--;
            }
            if ((1 == $t) && (0 < $z) && (0 < $inteiro[0])) $r .= ((1 < $z) ? " de " : "") . $plural[$t];
            if ($r) $rt = $rt . (((0 < $i) && ($i <= $fim) && (0 < $inteiro[0]) && (1 > $z)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
        }
        $rt = trim($rt);
        $rt = preg_replace('[  ]', ' ', $rt);
        if (!$maiusculas) {
            return ($rt ? $rt : "zero");
        } elseif ($rt) {
            $rt = preg_replace('[ E ]', ' e ', ucwords($rt));
        }

        return (($rt) ? ($rt) : "Zero");
    }
}
