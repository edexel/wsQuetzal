<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Firebase\JWT\JWT;
use App\Http\Responses\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
