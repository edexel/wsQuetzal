<?php

namespace App\Utils;



/** Encripta y desEncripta una cadena
 *  Created by: Edewaldo nuñez
 */
class Encript
{

    public static function CodeString($data)
    {

        // Store the cipher method
        $ciphering = "AES-128-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';

        // Store the encryption key
        $encryption_key = "Quetzal";

        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($data, $ciphering,
            $encryption_key, $options, $encryption_iv);
        return $encryption; //FJmbcm1+Tcqnd/S6rQ==
    }

    public static function DecodeString($data)
    {
        // Store the cipher method
        $ciphering = "AES-128-CTR";
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '1234567891011121';

        // Store the decryption key
        $decryption_key = "Quetzal";

        // Use openssl_decrypt() function to decrypt the data
        $decryption = openssl_decrypt($data, $ciphering,
            $decryption_key, $options, $decryption_iv);
        return $decryption;
    }
}
