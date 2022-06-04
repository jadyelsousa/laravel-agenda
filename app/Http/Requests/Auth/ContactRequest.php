<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'nome' => 'required',
            'sobrenome' => 'required',
            'email' => 'required|array',
            'email.*' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'telefone' => 'required|array',
            'telefone.*' => 'required',
            'cep' => 'required',
            'cep.*' => 'required',
            'estado' => 'required',
            'estado.*' => 'required',
            'bairro' => 'required',
            'bairro.*' => 'required',
            'cidade' => 'required',
            'cidade.*' => 'required',
            'endereco' => 'required',
            'endereco.*' => 'required',
        ];
    }



}
