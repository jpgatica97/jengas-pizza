<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre_completo' => ['required','max:255'],
            'email' => ['required'],
            'rol' => ['required'],
            'direccion' => ['required', 'max:1000'],
            'habilitacion' => ['required'],
        ];
    }
}
