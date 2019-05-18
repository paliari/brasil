<?php

use Paliari\Brasil\Acentos;

class AcentosTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param string $str
     * @param string $expected
     *
     * @dataProvider removeProvider
     */
    public function testRemove($str, $expected)
    {
        $this->assertEquals($expected, Acentos::remove($str));
    }

    public function removeProvider()
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
        ];
    }
}
