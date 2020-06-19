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
    public function __invoke($username,$password)
    {
        
        // Encuentra cliente de la base de datos
        $cliente = Cliente::where('email', $username)->first();
       
        // //verifica si el usuario existe con email
        // if (!$cliente)
        //     $cliente = Cliente::where('username', $username)->first();
        
        // verifica si el usuario existe sino responde con error
        if (!$cliente) 
            return false;
        
        // Verifica la contraseña y genera un token sino responde con error
        if (!Hash::check($password, $cliente->password)) 
            return false;
        
        // El usuario es válido. se asigna a el resultado el token.
        $cliente['token'] = JwtToken::createCodeClient($cliente);

        return $cliente;
    }
}
