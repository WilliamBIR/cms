<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSucursalRequest extends FormRequest
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
        $rol = Auth::user()->role();
        if($rol<4){
            return [
                'namesucu' => 'required|max: 30',
                'det' => 'required|max: 8'
            ];
        }else{
            return [
                'namesucu' => 'required|max: 30',
            ];
        }
    }

    public function messages()
    {
        return [
            'namesucu.required' => 'El nombre de la sucursal es necesario',
            'namesucu.max' => 'El nombre de la sucursal no puede ser mayor a 30 caracteres',
            'det.required' => 'La determinante es necesaria',
            'det.max' => 'La determinante no puede ser mayor a 8 caracteres'
        ];
    }
}
