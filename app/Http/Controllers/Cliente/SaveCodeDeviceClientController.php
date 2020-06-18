<?php

namespace App\Http\Controllers\Cliente;

// extends
use App\Http\Controllers\Controller;
// responses
use App\Http\Responses\Response as ResponseJson;
use Symfony\Component\HttpFoundation\Response;
// requests
use Illuminate\Http\Request;
use App\Http\Requests\Auth\NewCodePlatformRequest;
//Business
use App\Business\InstanciaCodigoBusiness;


   //
    /**
     * Created by Ede Nunez
     *
     * Modify by Ede Nunez
     * Date: 11 Jun 2020
     * Description: Guarda el codigo de activacion de dispositivo de un cliente
     */
class SaveCodeDeviceClientController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->result = new ResponseJson();
    }
    private $message = 'código incorrecto';

 
    public function __invoke(NewCodePlatformRequest $request)
    {

         // realiza toda la logica de validacion
         $ObjClass = new \App\Business\InstanciaCodigo\saveCodeClientDevice;
         $client = $ObjClass($request->input('codigo'), $this->oCurrentUser->idCliente);

        // construye respuesta correcta
        $result = $this->result->build($this->STATUS_OK, $this->NO_RESULT, $this->NO_TOTAL, "Registro guardado");

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
