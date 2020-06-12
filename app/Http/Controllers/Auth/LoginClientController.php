<?php

namespace App\Http\Controllers\Auth;

// extends
use App\Http\Controllers\Controller;
//Rquest
use App\Http\Requests\Auth\LoginRequest;

// responses
use App\Http\Resources\Auth\LoginClientResource;
use App\Http\Responses\Response as ResponseJson;
use App\Models\cliente;
// Facades
use App\Utils\JwtToken;

//Models
use Illuminate\Support\Facades\Hash;
// requests
use Symfony\Component\HttpFoundation\Response;
// resource
use Validator;

class LoginClientController  extends Controller
{

    public function __construct()
    {
        $this->result = new ResponseJson();
    }
    private $message = 'Tu usuario y/o contraseña son incorrectos, por favor verifica tus datos';

/**
 * Created by Ede Nunez
 *
 * Modify by Ede Nunez
 * Date: 10 Jun 2020
 * Description: Se modifica la ruta y se refactoriza el código
 *              tambien se agrega el swagger en la parte final del archivo
 */
    public function __invoke(LoginRequest $request)
    {

        // Encuentra usuario de la base de datos
        $client = cliente::where('email', $request->input('username'))->first();
        
        //verifica si el usuario existe con email
        if(!$client)
            // Si no encuentra su email busca por username
            $client = cliente::where('nombre', $request->input('username'))->first();

        // se define la respuesta de error
        $result = $this->result->build($this->STATUS_ERROR, $this->NO_RESULT, $this->NO_TOTAL, $this->message);
       
        // verifica si el usuario existe sino responde con error
        if (!$client)
             return response()->json($result,  Response::HTTP_UNAUTHORIZED);        

        // Verifica la contraseña y genera un token sino responde con error
        if (!Hash::check($request->input('password'), $client->password))
            return response()->json($result, Response::HTTP_UNAUTHORIZED);
         

        // El usuario es válido. se asigna a el resultado el token.
        $client['token'] =  JwtToken::createCodeClient($client);
      
        // Resultado mappeado
        $result = new LoginClientResource($client);
    
        $this->message = 'Usuario ha iniciado sesión correctamente';

        // construye respuesta correcta
        $result = $this->result->build($this->STATUS_OK, $result, $this->NO_TOTAL, $this->message);

        // response el resultado con su codigo Http
        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/admin/auth/loginClient",
     *     tags={"Auth"},
     *     operationId="loginClient",
     *     @OA\Response(
     *         response=200,
     *         description="El usuario a iniciado sesión correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/loginClientResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no fue autorizado",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorloginClientResponse")
     *     ),
     *     @OA\RequestBody(
     *         description="Formato de envío de datos",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="username",
     *                     description="Nombre de usuario",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Contraseña",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    /**
     * @OA\Schema(
     *   schema="loginClientResponse",
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
     *     ref="#/components/schemas/loginClientResponseData"
     *   )
     * )
     */

    /**
     * @OA\Schema(
     *   schema="loginClientResponseData",
     *   @OA\Property(
     *     property="token",
     *     type="string"
     *   )
     * )
     */

    /**
     * @OA\Schema(
     *   schema="ErrorloginClientResponse",
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
