<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepartoRequest extends FormRequest
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
        'estado' => ['required'],
        'rut_repartidor' => ['required'],
        'id_venta' => ['required'],
        'hora_entrega' => ['required'],
        ];
    }
}
