<?php
namespace Config;

class Randomizer
{
    static function randomNumber(int $qty)
    {
        $numbers = array_merge(range(0, 9));
        $values = "";
        for ($i = 0; $i < $qty; $i++) {
            $values .= $numbers[random_int(0, count($numbers) - 1)];
        }
        return $values;
    }
    static function randomChars(int $qty)
    {
        $alphanumericArray = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));

        $values = "";
        for ($i = 0; $i < $qty; $i++) {
            $values .= $alphanumericArray[random_int(0, count($alphanumericArray) - 1)];
        }
        return $values;
    }
}