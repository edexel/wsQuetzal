<?php

namespace App\Http\Controllers\Auth;

// extends
use App\Http\Controllers\Controller;

// responses
use App\Http\Responses\Response as ResponseJson;
use Symfony\Component\HttpFoundation\Response;
//Models
use App\Models\Usuario;
// requests
use App\Http\Requests\Auth\ForgotRequest;
// resource
use App\Mail\ForgotPasswordMail;
use App\Utils\Encrypt;
use Illuminate\Support\Facades\Mail;

/**
 * Created by Joel Valdivia
 * Date: 09 Jun 2020
 * Description: Se modifica la ruta y se refactoriza el código
 *              tambien se agrega el swagger en la parte final del archivo
 */
class ForgotController extends Controller
{

    private $message = 'No hemos podido encontrar el correo electrónico en el consultorio de Laura, favor de verificar su correo electrónico.';

    public function __construct()
    {
        $this->result = new ResponseJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ForgotRequest $request)
    {

        // Encuentra usuario de la base de datos
        $user = Usuario::where('email', $request->input('username'))->first();
        
        // se define la respuesta de error
        $result = $this->result->build($this->STATUS_ERROR, $this->NO_RESULT, $this->NO_TOTAL, $this->message);
       
        // verifica si el usuario existe sino responde con error
        if (!$user)
             return response()->json($result,  Response::HTTP_BAD_REQUEST);        

        // genera el token recover
        $token = Encrypt::encrypt($user->username.date('Y-m-d h:i:s'));
        // genera el enlace de token recover
        $url = env('APP_URL').'/res?t='.$token;
        // obtiene la vista de html que será enviado

        // envia correo con el enlace de recuperación dentro del HTML
        Mail::to($user->email)->send(new ForgotPasswordMail($url));

        // guarda el token recover para el usuario
        $user->tokenRecover = $token;
        $user->save();

    
        $this->message = 'Se te ha enviado el enlace para restablecer tu contraseña a tu correo electrónico.';

        // construye respuesta correcta
        $result = $this->result->build($this->STATUS_OK, $this->NO_RESULT, $this->NO_TOTAL, $this->message);

        // response el resultado con su codigo Http
        return response()->json($result, Response::HTTP_OK);
    }
    /**
     * @OA\Post(
     *     path="/web/auth/forgot",
     *     tags={"Auth"},
     *     summary="Restablecer contraseña",
     *     operationId="Forgot",
     *     @OA\Response(
     *         response=200,
     *         description="Se ha enviado el enlace de restablecer contraseña correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/ForgotResponse")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Usuario no encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
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
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    /**
     * @OA\Schema(
     *   schema="ForgotResponse",
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
