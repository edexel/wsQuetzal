<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewCodePlatformRequest;

// extends

// responses
use App\Http\Responses\Response as ResponseJson;
// responses
use App\Models\InstanciaCodigos;

// Facades
use App\Models\InstanciaSistema;
// Utils

//Models
use Illuminate\Http\Request;
// requests
use Symfony\Component\HttpFoundation\Response;
// resource

class SaveCodeDeviceClientController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->result = new ResponseJson();
    }
    private $message = 'código incorrecto';

    //
    /**
     * Created by Ede Nunez
     *
     * Modify by Ede Nunez
     * Date: 11 Jun 2020
     * Description: Guarda el codigo de activacion de dispositivo de un cliente
     */
    public function __invoke(NewCodePlatformRequest $request)
    {

        $code = $request->input('codigo');

        $idSistema = InstanciaSistema::where("idCliente", "=", $this->oCurrentUser->idCliente)->select("idInstanciaSistema")->first();
  
        // Guarda el codigo en el sistenma deacuerdoa la instancia de usuario logeado
        $instancia_codigos = new InstanciaCodigos;

        $instancia_codigos->idInstanciaSistema = $idSistema->idInstanciaSistema;
        $instancia_codigos->codigo = $code;
        $instancia_codigos->activo = 1;
        $instancia_codigos->created_at = date("Y-m-d H:i:s");

        $instancia_codigos->save();

        // construye respuesta correcta
        $result = $this->result->build($this->STATUS_OK, $this->NO_RESULT, $this->NO_TOTAL, "Código encontrado");

        // response el resultado con su codigo Http
        return response()->json($result, Response::HTTP_OK);
    }

/**
 * @OA\Post(
 *     path="/admin/cliente/SaveCodeDevice",
 *     tags={"Cliente"},
 *     summary="Guarda codigo en plataforma",
 *     operationId="SaveCodeDevice",
 *     @OA\Response(
 *         response=200,
 *         description="Exito",
 *         @OA\JsonContent(ref="#/components/schemas/SaveCodeDeviceResponse")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Codigo incorrecto",
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *     @OA\RequestBody(
 *         description="Input data format",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="codigo",
 *                     description="codigo ",
 *                     type="string",
 *                 )
 *             )
 *         )
 *     ),
 *     security={
 *         {"authorization": {}}
 *     }
 * )
 */

    /**
     * @OA\Schema(
     *   schema="SaveCodeDeviceResponse",
     *   @OA\Property(
     *     property="status",
     *     type="boolean"
     *   ),
     *   @OA\Property(
     *     property="message",
     *     type="string"
     *   )
     * )
     */

}
