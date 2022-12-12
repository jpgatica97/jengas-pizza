<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
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
            'fecha' => ['required'],
            'estado' => ['required'],
            'neto' => ['required'],
            'iva' => ['required'],
            'total' => ['required'],
            'observaciones' => ['required'],
            'medio_venta' => ['required'],
            'metodo_pago' => ['required'],
            'rut_cliente' => ['required'],
        ];
    }
}
