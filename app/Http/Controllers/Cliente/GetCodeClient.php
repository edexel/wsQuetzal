<?php

namespace App\Http\Controllers\CLiente;


use App\Http\Responses\Response as ResponseJson;
// responses
use Symfony\Component\HttpFoundation\Response;


use Illuminate\Http\Request;
// Utils
use App\Utils\JwtToken;
//Models
use App\Models\Cliente;
// resource
use App\Http\Resources\Admin\Auth\LoginResource;

class GetCodeClient extends Controller
{
    public function __construct()
    {
        $this->oResponse = new ResponseJson();
    }
 

    public function __invoke(Request $oRequest)
    {
                
        try {
             // Encuentra usuario de la base de datos
             $oUser = usuario::All();
             
        
            return response()->json($this->oResponse->fnResult(true, $oUser, "Success"), 200);
        } catch (Exception $ex) {
            // Error
            return response()->json($this->oResponse->fnResult(false, null, 'Exception: ' . $ex), Response::HTTP_BAD_REQUEST);
        }
    }
}
