<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ContactRequest;
use App\Models\Contato;
use App\Models\Email;
use App\Models\Endereco;
use App\Models\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $contact = new Contato();
        $contact->nome = $request->nome;
        $contact->sobrenome = $request->sobrenome;
        $contact->observacoes = $request->observacoes ?? "";
        $contact->id_usuario = Auth::user()->id;

        if($contact->save()){

            foreach ($request->telefone as $key => $value) {
                $telefone = preg_replace("/[^0-9]/", "", $value);
                $phone = new Telefone();
                $phone->telefone = $telefone;
                $phone->tipo = $request->tipo_telefone[$key];
                $phone->id_contato = $contact->id;
                $phone->save();
            }

            foreach ($request->email as $key => $value) {
                $mail = new Email();
                $mail->email = $value;
                $mail->tipo = $request->tipo_email[$key];
                $mail->id_contato = $contact->id;
                $mail->save();
            }

            foreach($request->endereco as $key => $value){
                $cep = preg_replace("/[^0-9]/", "", $request->cep[$key]);
                $adress = new Endereco();
                $adress->endereco = $value;
                $adress->cep = $cep;
                $adress->bairro = $request->bairro[$key];
                $adress->cidade = $request->cidade[$key];
                $adress->estado = $request->estado[$key];
                $adress->id_contato = $contact->id;
                $adress->save();
            }

            return redirect()->route('dashboard')->with('status', 'Contato cadastrado com sucesso!');

        }
        return redirect()->route('dashboard')->withErrors('error', 'Ocorreu um erro ao cadastrar, tente novamente!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
