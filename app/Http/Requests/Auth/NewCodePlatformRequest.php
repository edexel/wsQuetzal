<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class NewCodePlatformRequest extends ApiFormRequest
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
         //   'username' => 'required|max:150',
            'codigo'  => 'required|max:8'
        ];
    }

    public function messages() {
        return [
            'codigo.required' => 'El código es requerido',
            'codigo.max' => 'El código es invalido',
        ];
    }
}
