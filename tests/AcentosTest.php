<?php

use Paliari\Brasil\Acentos;
use PHPUnit\Framework\Attributes\DataProvider;

class AcentosTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param string $str
     * @param string $expected
     */
    #[DataProvider('removeProvider')]
    public function testRemove($str, $expected)
    {
        $this->assertEquals($expected, Acentos::remove($str));
    }

    public static function removeProvider()
    {
        return [
            ['áãá', 'aaa'],
            ['ÁÃÁ', 'AAA'],
            ['ç', 'c'],
            ['Ç', 'C'],
            ['cação', 'cacao'],
            ['CAÇÃO', 'CACAO'],
            ['çáéíóú', 'caeiou'],
            ['ÇÁÉÍÓÚ', 'CAEIOU'],
            ['ãõ', 'ao'],
            ['ÃÕ', 'AO'],
            ['âêîôû', 'aeiou'],
            ['ÂÊÎÔÛ', 'AEIOU'],
            ['àèìòù ÀÈÌÒÙ', 'aeiou AEIOU'],
            ['ñÑüÜýÝÿ', 'nNuUyYy'],
            ['São Paulo, Ação', 'Sao Paulo, Acao'],
            ['Éder Müller-Ñúñez', 'Eder Muller-Nunez'],
            ['texto sem acento 123!', 'texto sem acento 123!'],
            ['€ 10,00', '? 10,00'],
        ];
    }
}
