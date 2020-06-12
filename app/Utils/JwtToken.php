<?php

namespace App\Utils;

// JWT
use Firebase\JWT\JWT;

/** Crea un token basado en JWT con la información necesaria
 *  Created by: Edewaldo nuñez
 */
class JwtToken
{
    public static function create($data)
    {
        $aPayload = [
            'iss' => "lumen-jwt-agro",
            'sub' => $data, // Información del Usuario.
            'iat' => time(), // Hora en que se emite el JWT.
            'exp' => time() + 60 * 60 * 120 * 100, // Tiempo que expira el token.
        ];

        // se puede usar para decodificar el token en un futuro.
        return JWT::encode($aPayload, env('JWT_SECRET'));
    }

    public static function createCodeClient($data)
    {
        $aPayload = [
            'iss' => "lumen-jwt-agro",
            'sub' => $data, // Información del Usuario.
            'iat' => time(), // Hora en que se emite el JWT.
            'exp' => time() + 60*60*120*100 // Tiempo que expira el token.
        ];

        // se puede usar para decodificar el token en un futuro.
        return JWT::encode($aPayload, env('JWT_CLIENT_SECRET'));
    }

     /**
     * Decodifica el token y regresa los datos del usuario
     *
     * @param  string $token Token generado por JwtToken::generar();
     * @return [type]        [description]
     */
    public static function getDataToken($token)
    {
        $tokenDecode = JWT::decode($token, env('JWT_CLIENT_SECRET'), array('HS256'));
     
        return $tokenDecode->sub;
    }

}
