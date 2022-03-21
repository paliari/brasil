<?php

namespace Paliari\Brasil;

class UF
{
    /**
     * 27 estados
     * Ordem alfabética pela chave
     * @var array
     */
    public static $SIGLAS = [
        'AC' => 'AC', 'AL' => 'AL', 'AM' => 'AM', 'AP' => 'AP',
        'BA' => 'BA', 'CE' => 'CE', 'DF' => 'DF', 'ES' => 'ES',
        'GO' => 'GO', 'MA' => 'MA', 'MG' => 'MG', 'MS' => 'MS',
        'MT' => 'MT', 'PA' => 'PA', 'PB' => 'PB', 'PE' => 'PE',
        'PI' => 'PI', 'PR' => 'PR', 'RJ' => 'RJ', 'RN' => 'RN',
        'RO' => 'RO', 'RR' => 'RR', 'RS' => 'RS', 'SC' => 'SC',
        'SE' => 'SE', 'SP' => 'SP', 'TO' => 'TO',
    ];

    /**
     * 27 estados
     * Ordem alfabética pela chave
     * @var array
     */
    public static $NOMES = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AM' => 'Amazonas',
        'AP' => 'Amapá',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiais',
        'MA' => 'Maranhão',
        'MG' => 'Minas Gerais',
        'MS' => 'Mato Grosso do Sul',
        'MT' => 'Mato Grosso',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'PR' => 'Paraná',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio grande do Norte',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'RS' => 'Rio Grande do Sul',
        'SC' => 'Santa Catarina',
        'SE' => 'Sergipe',
        'SP' => 'São Paulo',
        'TO' => 'Tocantins',
    ];

    /**
     * Regioes IBGE
     * @var array
     */
    public static $REGIOES = [
        // 3
        "SUL" => [
            "PR" => "Paraná",
            "RS" => "Rio Grande do Sul",
            "SC" => "Santa Catarina",
        ],
        // 4
        "SUDESTE" => [
            "ES" => "Espírito Santo",
            "MG" => "Minas Gerais",
            "RJ" => "Rio de Janeiro",
            "SP" => "São Paulo",
        ],
        // 4
        "CENTRO OESTE" => [
            "DF" => "Distrito Federal",
            "GO" => "Goiais",
            "MS" => "Mato Grosso do Sul",
            "MT" => "Mato Grosso",
        ],
        // 9
        "NORDESTE" => [
            "AL" => "Alagoas",
            "BA" => "Bahia",
            "CE" => "Ceará",
            "MA" => "Maranhão",
            "PB" => "Paraíba",
            "PE" => "Pernambuco",
            "PI" => "Piauí",
            "RN" => "Rio grande do Norte",
            "SE" => "Sergipe",
        ],
        // 7
        "NORTE" => [
            "AC" => "Acre",
            "AM" => "Amazonas",
            "AP" => "Amapá",
            "PA" => "Pará",
            "RO" => "Rondônia",
            "RR" => "Roraima",
            "TO" => "Tocantins",
        ],
    ];
}
