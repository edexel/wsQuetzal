<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class VerifyCodePltformResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nombre' => $this->nombre,
            "apellidos" => $this->apellidos,
            "email" => $this->email,
            "descripcion" => $this->descripcion,
            "subDominio" => $this->subDominio
        ];
    }
}