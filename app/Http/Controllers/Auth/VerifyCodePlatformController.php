<?php

namespace App\Http\Controllers\Auth;


// extends
use App\Http\Controllers\Controller;
// responses
use App\Http\Responses\Response as ResponseJson;
use App\Http\Resources\Auth\VerifyCodePltformResource;
// requests
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Auth\NewCodePlatformRequest;
//Business
use App\Business\ClienteBusiness;

class VerifyCodePlatformController  extends Controller
{

    public function __construct()
    {
        $this->result = new ResponseJson();
    }
    private $message = 'código incorrecto';


        //
    /**
     * Created by Ede Nunez
     *
     * Modify by Ede Nunez
     * Date: 11 Jun 2020
     * Description: Procesa el codigo y devuelve la informacion de la plataforma
     */
    public function __invoke(NewCodePlatformRequest $request)
    {

        $ObjClass = new \App\Business\Cliente\VerifyCodeClient;
        // realiza toda la logica de validacion
        $client = $ObjClass($request->input('codigo'));
        
        if (!$client){
            // se define la respuesta de error
            $result = $this->result->build($this->STATUS_ERROR, $this->NO_RESULT, $this->NO_TOTAL, $this->message);
            return response()->json($result, Response::HTTP_UNAUTHORIZED);
        }
    
        // Resultado mappeado
        $result = new VerifyCodePltformResource($client);

        // construye respuesta correcta
        $result = $this->result->build($this->STATUS_OK, $result, $this->NO_TOTAL, "Código encontrado");

        // response el resultado con su codigo Http
        return response()->json($result, Response::HTTP_OK);
    }

/**
     * @OA\Post(
     *     path="/admin/auth/VerifyCodePlatform",
     *     tags={"Auth"},
     *     summary="varifica el codigo ingresado",
     *     operationId="VerifyCodePlatform",
     *     @OA\Response(
     *         response=200,
     *         description="Codigo aceptado",
     *         @OA\JsonContent(ref="#/components/schemas/VerifyCodePlatformResponse")
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
     *     )
     * )
     */

    /**
     * @OA\Schema(
     *   schema="VerifyCodePlatformResponse",
     *   @OA\Property(
     *     property="status",
     *     type="boolean"
     *   ),
     *   @OA\Property(
     *     property="message",
     *     type="string"
     *   ),
     *   @OA\Property(
     *     property="data",
     *     ref="#/components/schemas/VerifyCodePlatformResponseData"
     *   )
     * )
     */

    /**
     * @OA\Schema(
     *   schema="VerifyCodePlatformResponseData",
     *   @OA\Property(
     *     property="nombre",
     *     type="string"
     *  ),
     *   @OA\Property(
     *     property="apellidos",
     *     type="string"
     *  ),
     *   @OA\Property(
     *     property="email",
     *     type="string"
     *  ),
     *      *   @OA\Property(
     *     property="descripcion",
     *     type="string"
     *  ),
     *      *   @OA\Property(
     *     property="subDominio",
     *     type="string"
     *  )
     * )
     */
}
