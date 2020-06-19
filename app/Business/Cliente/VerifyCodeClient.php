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
    public  function __invoke($code)
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
}
