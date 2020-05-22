<?php

namespace App\Http\Resources\Admin\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'id' => $this->idUsuario,
            'token' => $this->token,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'created_at' => is_object($this->created_at) ? $this->created_at->toDateTimeString() : $this->created_at,
            'updated_at' => is_object($this->updated_at) ? $this->updated_at->toDateTimeString() : $this->updated_at,
        ];
    }
}