<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Responses\Response as ResponseJson;
// Codes Responses
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
// Facades
use Illuminate\Support\Facades\Hash;
//Models
use App\Models\usuario;



class GetAllController
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
