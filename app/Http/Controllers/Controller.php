<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// requests
use Symfony\Component\HttpFoundation\Response;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    # PROPIEDADES GENERALES
    public $usuarioLogueado;
    public $NO_RESULT = null;
    public $NO_TOTAL = null;
    public $STATUS_OK = true;
    public $STATUS_ERROR = false;
    public $menssage;
    #TERMINA PROPIEDADES GENERALES

/**
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="authorization",
 *     name="authorization"
 * )
 */
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Quetzal Api System v1",
 *         @OA\License(name="Quetzal api")
 *     ),
 *     @OA\Server(
 *         description="Documentacion de Api de Quetzal",
 *         url="/api/v1",
 *     ),
 * )
 */
    public function __construct()
    {
        $this->oResponse = new Response();
    }
}
