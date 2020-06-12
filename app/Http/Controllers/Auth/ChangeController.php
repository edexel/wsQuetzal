<?php

namespace App\Http\Controllers\Auth;

// extends
use App\Http\Controllers\Controller;

// responses
use App\Http\Responses\Response as ResponseJson;
use Symfony\Component\HttpFoundation\Response;
// Facades
use Illuminate\Support\Facades\Hash;
//Models
use App\Models\Usuario;
// requests
use App\Http\Requests\Auth\ChangeRequest;
// resource
use App\Mail\ChangePasswordMail;
use Illuminate\Support\Facades\Mail;

/**
 * Created by Joel Valdivia
 * Date: 09 Jun 2020
 * Description: Se modifica la ruta y se refactoriza el código
 *              tambien se agrega el swagger en la parte final del archivo
 */
class ChangeController extends Controller
{

    private $message = 'No hemos podido cambiar tu contraseña, favor de solicitar de nuevo su enlace en ¿Olvidaste la contraseña?.';

    public function __construct()
    {
        $this->result = new ResponseJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ChangeRequest $request)
    {

        // Encuentra usuario de la base de datos
        $user = Usuario::where('tokenRecover', $request->input('t'))->first();

        // se define la respuesta de error
        $result = $this->result->build($this->STATUS_ERROR, $this->NO_RESULT, $this->NO_TOTAL, $this->message);

        // verifica si el usuario existe sino responde con error
        if (!$user)
            return response()->json($result,  Response::HTTP_BAD_REQUEST);

        // guarda el cambio de contraseña
        $user->password = Hash::make($request->input('password'));
        // $user->tokenRecover = '';
        $user->save();

        // envia correo con el enlace de recuperación dentro del HTML
        Mail::to($user->email)->send(new ChangePasswordMail());

        $this->message = 'Haz cambiado tu contraseña correctamente. Ahora podrás iniciar sesión con tu nueva contraseña.';

        // construye respuesta correcta
        $result = $this->result->build($this->STATUS_OK, $this->NO_RESULT, $this->NO_TOTAL, $this->message);

        // response el resultado con su codigo Http
        return response()->json($result, Response::HTTP_OK);
    }
    /**
     * @OA\Post(
     *     path="/web/auth/change",
     *     tags={"Auth"},
     *     summary="Restablecer contraseña",
     *     operationId="Change",
     *     @OA\Response(
     *         response=200,
     *         description="Se ha enviado el enlace de restablecer contraseña correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/ChangeResponse")
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
     *                     property="t",
     *                     description="Token de usuario",
     *                     type="string",
     *                 ),
     *                  @OA\Property(
     *                     property="password",
     *                     description="Contraseña nueva de usuario",
     *                     type="string",
     *                 ),
     *                  @OA\Property(
     *                     property="confirm_password",
     *                     description="Confirma nueva de usuario",
     *                     type="string",
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    /**
     * @OA\Schema(
     *   schema="ChangeResponse",
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
