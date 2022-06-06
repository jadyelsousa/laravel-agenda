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
            'cep' => 'required|array',
            'cep.*' => 'required',
            'estado' => 'required|array',
            'estado.*' => 'required',
            'bairro' => 'required|array',
            'bairro.*' => 'required',
            'cidade' => 'required|array',
            'cidade.*' => 'required',
            'endereco' => 'required|array',
            'endereco.*' => 'required',
        ];
    }



}
