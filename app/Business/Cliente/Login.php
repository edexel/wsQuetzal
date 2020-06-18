<?php

namespace App\Business\Cliente;

// Facades
use Illuminate\Support\Facades\DB;
// Models
use App\Models\Cliente;
// Utils
use App\Utils\JwtToken;
//Models
use Illuminate\Support\Facades\Hash;


/**
 * Clase de negocios del Cliente
 *
 * Created by Edewaldo Nuñez.
 * Date: 16 Jun 2020
 */
class Login
{

    
     /**
     *  valida que el Cliente exista en el sistema
     *
     * @return \App\Model\Cliente
     */
    public static function __invoke($username,$password)
    {
        
        // Encuentra usuario de la base de datos
        $user = Cliente::where('email', $username)->first();
  
        //verifica si el usuario existe con email
        if (!$user)
            $user = Cliente::where('username', $username)->first();
        
        // verifica si el usuario existe sino responde con error
        if (!$user) 
            return false;
        
        // Verifica la contraseña y genera un token sino responde con error
        if (!Hash::check($password, $user->password)) 
            return false;
        
        // El usuario es válido. se asigna a el resultado el token.
        $user['token'] = JwtToken::createCodeClient($user);

        return $user;
    }
}
