<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

/**
 * Created by Joel Valdivia
 * Date 10 Jun 2020
 * Request validator de ForgotController
 */
class ForgotRequest extends ApiFormRequest
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
            'username' => 'required|max:150'
        ];
    }

    public function messages() {
        return [
            'username.required' => 'El usuario es requerido',
            'username.exists' => 'Tu usuario y/o contraseña son incorrectos, por favor verifica tus datos',
            'username.min' => 'Tu usuario debe contener al menos 6 caracteres',
            'username.max' => 'Tu usuario debe contener al máximo 150 caracteres'
        ];
    }
}
