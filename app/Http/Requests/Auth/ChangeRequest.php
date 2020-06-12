<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

/**
 * Created by Joel Valdivia
 * Date 10 Jun 2020
 * Request validator de ChangeController
 */
class ChangeRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            't' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8'
        ];
    }

    public function messages() {
        return [
            't.required' => 'El token es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe contener minimo 8 caracteres',
            'confirm_password.required' => 'La contraseña es requerida',
            'confirm_password.same' => 'Las contraseñadeben coincidir',
            'confirm_password.min' => 'La contraseña debe contener minimo 8 caracteres',
        ];
    }
}
