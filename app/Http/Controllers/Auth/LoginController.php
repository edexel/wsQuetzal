<?php

namespace App\Http\Controllers\Auth;

use App\Http\Responses\Response as ResponseJson;

// responses
use Symfony\Component\HttpFoundation\Response;

use Validator;
use Illuminate\Http\Request;
// Facades
use Illuminate\Support\Facades\Hash;
// Utils
use App\Utils\JwtToken;
//Models
use App\Models\usuario;
// resource
use App\Http\Resources\Admin\Auth\LoginResource;



class LoginController
{

    public function __construct()
    {
        $this->oResponse = new ResponseJson();
    }
    private $message = 'Tu usuario y/o contraseña son incorrectos, por favor verifica tus datos';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 /**
     * @OA\Post(
     *     path="/admin/auth/login",
     *     tags={"Auth"},
     *     summary="Login de usuario",
     *     operationId="Login",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     description="usuario del sistema",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="contraseña de usuario",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function __invoke(Request $oRequest)
    {

        if (self::validateRequest($oRequest)->fails())
            return response()->json($this->oResponse->fnResult(false, null, $validation->errors()), Response::HTTP_BAD_REQUEST);
   

                
        try {
             // Encuentra usuario de la base de datos
             $oUser = usuario::where('email', $oRequest->input('email'))->first();
              // verifica nombre de usuario
            if(!$oUser)
             // Encuentra usuario de la base de datos
             $oUser = usuario::where('username', $oRequest->input('email'))->first();

             // verifica si el usuario existe con el status activo sino responde con error
            if(!$oUser)
            return response()->json($this->oResponse->fnResult(false, $this->message, $this->message),  Response::HTTP_UNAUTHORIZED);
            // Verifica la contraseña y genera un token sino responde con error
            if (!Hash::check($oRequest->input('password'), $oUser->password))
                return response()->json($this->oResponse->fnResult(false, $this->message, $this->message), Response::HTTP_UNAUTHORIZED);               

            $oUser['token']  = JwtToken::create($oUser);
            // Resultado mappeado
            $oResult = new LoginResource($oUser);

            return response()->json($this->oResponse->fnResult(true, $oResult, "Success"), 200);
        } catch (Exception $ex) {
            // Error
            return response()->json($this->oResponse->fnResult(false, null, 'Exception: ' . $ex), Response::HTTP_BAD_REQUEST);
        }
    }


    private function validateRequest($oRequest){

        $credentials = $oRequest->only('email', 'password');
        $validation = \Validator::make($credentials, [
        //    'email' => 'required|email|max:150',
            'password'  => 'required|max:150'
        ],[
            'email.required' => 'Por favor ingresa un correo válido',
            'email.email' => 'Por favor ingresa un correo válido',
            'email.exists' => 'Tu usuario y/o contraseña son incorrectos, por favor verifica tus datos',
            'email.min' => 'Tu correo electrónico debe contener al menos 6 caracteres',
            'email.max' => 'Tu correo electrónico debe contener al máximo 150 caracteres',
            'password.required' => 'Tu usuario y/o contraseña son incorrectos, por favor verifica tus datos',
            'password.min' => 'Tu contraseña debe contener al menos 8 caracteres',
            'password.max' => 'Tu correo electrónico debe contener al máximo 150 caracteres',
        ]);

        return $validation;
    }
}
