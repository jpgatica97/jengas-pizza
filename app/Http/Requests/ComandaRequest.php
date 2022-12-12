<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComandaRequest extends FormRequest
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
        'fecha' => ['required','max:255'],
        'estado' => ['required','max:255'],
        'rut_encargado' => ['required','max:255'],
        'id_venta' => ['required','max:255']
        ];
    }
}
