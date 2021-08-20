<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateVendaRequest extends FormRequest
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
            'id_produto' => 'required|exists:carrinho, id_produto',
            "nome_cliente" => 'required',
            "total" => 'required|numeric',
            "troco" => 'numeric',
            "tipo_pgto" => 'numeric',
            "data" => 'required|date',
            "hora" => 'required',
            "status" => 'required',
            "obs" => 'nullable',

        ];
    }
}