<?php

namespace Paliari\Brasil;

/**
 * Class BuscaCep
 * @package Paliari\Brasil
 */
class BuscaCep
{
    /**
     *    Função de busca de Endereço pelo CEP
     *    -    Desenvolvido Felipe Olivaes para ajaxbox.com.br
     *    -    Utilizando WebService de CEP da republicavirtual.com.br
     * @param string $cep
     * @return array  $retorno
     */
    public static function getEndereco($cep)
    {
        $cep = urlencode($cep);
        $resultado = @file_get_contents("http://republicavirtual.com.br/web_cep.php?cep=$cep&formato=json");
        if (!$resultado) {
            $resultado = '{"resultado":"0","resultado_txt":"erro ao buscar cep"}';
        }
        $ret = json_decode($resultado, true);

        return $ret;
    }
}
