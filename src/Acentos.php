<?php

namespace Paliari\Brasil;

class Acentos
{

    public static function remove($value)
    {
        $a     = [
            "'[ÂÀÁÄÃ]'"                        => "A",
            "'[âãàáä]'"                        => "a",
            "'[ÊÈÉË]'"                         => "E",
            "'[êèéë]'"                         => "e",
            "'[ÎÍÌÏ]'"                         => "I",
            "'[îíìï]'"                         => "i",
            "'[ÔÕÒÓÖ]'"                        => "O",
            "'[ôõòóö]'"                        => "o",
            "'[ÛÙÚÜ]'"                         => "U",
            "'[ûúùü]'"                         => "u",
            "'Ñ'"                              => "N",
            "'ñ'"                              => "n",
            "'[ýÿ]'"                           => "y",
            "'[Ý]'"                            => "Y",
            "'ç'"                              => "c",
            "'Ç'"                              => "C",
            "'[´~`^¨\']'"                      => " ",
            "'[^[:alnum:][:punct:][:space:]]'" => ' ',
        ];
        $value = static::convertTxt($value);

        return preg_replace(array_keys($a), array_values($a), $value);
    }

    public static function convertTxt($txt)
    {
        if (static::is_utf8($txt)) {
            $txt = utf8_decode($txt);
        }

        return $txt;
    }

    public static function is_utf8($string)
    {
        return preg_match('%^(?:
                  [\x09\x0A\x0D\x20-\x7E]			# ASCII
                | [\xC2-\xDF][\x80-\xBF]			# non-overlong 2-byte
                |  \xE0[\xA0-\xBF][\x80-\xBF]		# excluding overlongs
                | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
                |  \xED[\x80-\x9F][\x80-\xBF]		# excluding surrogates
                |  \xF0[\x90-\xBF][\x80-\xBF]{2}	# planes 1-3
                | [\xF1-\xF3][\x80-\xBF]{3}		 	# planes 4-15
                |  \xF4[\x80-\x8F][\x80-\xBF]{2}	# plane 16
            )*$%xs',
            $string);
    }

    public static function ucwords($str)
    {
        return ucwords(mb_strtolower($str, 'UTF-8'));
    }

}
