<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromocionRequest extends FormRequest
{
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
            'nombre' => ['required','max:255'],
            'descripcion' => ['max:1000'],
            'precio' => ['required', 'min:1'],
            'categoria' => ['required'],
        ];
    }
}
