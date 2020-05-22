<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

// Facades
use Exception;
// JWT
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
// responses
use App\Http\Responses\Response;

class Authenticate
{
    private $oResponse;

    /**
     * Crea una instancia nueva del controlador iniciando la respuesta por default.
     *
     * Created by Jesus sanchez
     * Created date: 11 May 2018
     * @return void
     */
    public function __construct() {
        $this->oResponse = new Response();
    }

    /** Filtro
     * Valida que el token venga en las cabeceras de la petición y lo valida con uno existente.
     * 
     * Created by Jesus sanchez
     * Created date: 11 May 2018
     * @param $request, Clousure $next, $guard
     * @return App\Responses\Response
     */
    public function handle($request, Closure $next, $guard = null) {
        $sToken = $request->headers->get('authorization');
        // verifica que exista el token en el request
        if(!$sToken)
            return response()->json($this->oResponse->fnResult(false, null, 'Token inválido.'), 401);


        try {

            // decodifica el token
            $oCredentials = JWT::decode($sToken, env('JWT_SECRET'), ['HS256']);

            // Asinga los datos del usuario al $request->auth para usarlo en todo el sistema
            $request->auth = $oCredentials->sub;
            
            return $next($request);

        } catch(ExpiredException $e) {

            // Expira el token y regresa error. Debe hacer login de nuevo
            return response()->json($this->oResponse->fnResult(false, null, 'Token expirado.'), 400);
        } catch(Exception $e) {

            // Error al decodificar el token
            return response()->json($this->oResponse->fnResult(false, $e, 'Error en el token.'), 400);
        }
    }
}
