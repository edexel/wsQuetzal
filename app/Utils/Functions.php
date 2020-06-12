<?php

namespace App\Utils;

/** Encripta y desEncripta una cadena
 *  Created by: Edewaldo nuñez
 */
class Functions
{
    public static function GenerateNewCode($strength = 8)
    {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $input_length = strlen($chars);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
}

