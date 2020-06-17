<?php

namespace App\Business○2Cliente;

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
class VerifyCodeClient
{


     /**
     *  valida el codigo del cliente para logearse en la app
     *
     * @return \App\Model\Cliente
     */
    public static function __invoke($code)
    {
        
         // Busca los datos de la pplataforma
         $query =  DB::table('cliente')
         ->join('instancia_sistema', 'cliente.idCliente', '=', 'instancia_sistema.idCliente')
         ->join('instancia_codigos','instancia_codigos.idInstanciaCodigos', '=','instancia_codigos.idInstanciaSistema')
         ->select('cliente.*','instancia_sistema.*')
         ->where("instancia_codigos.codigo","=",$code)
         ->first();


        return $query != null ? $query : false;
    }

    
     /**
     *  valida que el Cliente exista en el sistema
     *
     * @return \App\Model\Cliente
     */
    public static function fnClient($username,$password)
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
