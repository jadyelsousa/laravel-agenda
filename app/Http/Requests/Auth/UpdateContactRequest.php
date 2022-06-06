<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'edit_nome' => 'required',
            'edit_sobrenome' => 'required',
            'edit_email' => 'required|array',
            'edit_email.*' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
            'edit_telefone' => 'required|array',
            'edit_telefone.*' => 'required',
            'edit_cep' => 'required|array',
            'edit_cep.*' => 'required',
            'edit_estado' => 'required|array',
            'edit_estado.*' => 'required',
            'edit_bairro' => 'required|array',
            'edit_bairro.*' => 'required',
            'edit_cidade' => 'required|array',
            'edit_cidade.*' => 'required',
            'edit_endereco' => 'required|array',
            'edit_endereco.*' => 'required',
        ];
    }



}
