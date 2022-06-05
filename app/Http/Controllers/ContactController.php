<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ContactRequest;
use App\Http\Requests\Auth\UpdateContactRequest;
use App\Models\Contato;
use App\Models\Email;
use App\Models\Endereco;
use App\Models\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

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

            $emailUser = Auth::user()->email;

            $nome = $contact->nome;

            // Mail::send('mail.mailview', ['nome' => $nome ], function ($message) use ($emailUser){
            //         $message->to($emailUser);
            //         $message->subject('Novo contato cadastrado');
            //         // $message->bcc('jadyelbatera@gmail.com');
            //     });

            return redirect()->route('dashboard')->with('status', 'Contato cadastrado com sucesso!');

        }
        return redirect()->route('dashboard')->withErrors('error', 'Ocorreu um erro ao cadastrar, tente novamente!');;
    }


    public function searchSuggestion(Request $request)
    {
        $query = $request->term;
        $var = Contato::where('nome', 'like', "%{$query}%")
        ->orWhereHas('telefone', function ($q) use ($query) {
            $q->select('telefone')->where('telefone', 'like', "%{$query}%");
        })
        ->orWhereHas('email', function ($q) use ($query) {
            $q->select('email')->where('email', 'like', "%{$query}%");
        })
        ->get();

        if (is_numeric($query)) {
           return $var->pluck('telefone.0.telefone');
        } elseif (strpos($query,'@')) {
           return $var->pluck('email.0.email');
        } else {
            return $var->pluck('nome');
        }

    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $filters = $request->only('search');
        $query = $request->search;

        $contacts = Contato::where('nome', 'like', "%{$query}%")
        ->orWhereHas('telefone', function ($q) use ($query) {
            $q->select('telefone')->where('telefone', 'like', "%{$query}%");
        })
        ->orWhereHas('email', function ($q) use ($query) {
            $q->select('email')->where('email', 'like', "%{$query}%");
        })
        ->orWhereHas('endereco', function ($q) use ($query) {
            $q->where('endereco', 'like', "%{$query}%");
        })
        ->paginate(10);

        return view('dashboard',compact('contacts','query','filters'));

    }


    public function update(UpdateContactRequest $request)
    {

        if (!$contact = Contato::find($request->id_contact)) {
            return back()->withErrors([
                'Erro' => 'Algumas informações estão incorretas',
            ]);
        }

        $contact->nome = $request->edit_nome;
        $contact->sobrenome = $request->edit_sobrenome;
        $contact->observacoes = $request->edit_observacoes ?? "";

        if ($contact->telefone()->count() == count($request->edit_telefone)) {

            foreach ($contact->telefone as $key =>  $phone) {
                $phone->telefone = $request->edit_telefone[$key];
                $phone->tipo = $request->edit_tipo_telefone[$key];
                $phone->update();

            }
        }else{
            $contact->telefone()->delete();
            foreach ($request->edit_telefone as $key => $telefone) {
               $phone = new Telefone();
               $phone->telefone = $telefone;
               $phone->tipo = $request->edit_tipo_telefone[$key];
               $phone->id_contato = $contact->id;
               $phone->save();
            }
        }

        if ($contact->email()->count() == count($request->edit_email)) {

            foreach ($contact->email as $key =>  $mail) {
                $mail->email = $request->edit_email[$key];
                $mail->tipo = $request->edit_tipo_email[$key];
                $mail->update();

            }
        }else{
            $contact->email()->delete();
            foreach ($request->edit_email as $key => $email) {
               $mail = new Email();
               $mail->email = $email;
               $mail->tipo = $request->edit_tipo_email[$key];
               $mail->id_contato = $contact->id;
               $mail->save();


            }
        }

        if ($contact->endereco()->count() == count($request->edit_endereco)) {

            foreach ($contact->endereco as $key =>  $adress) {
                $adress->endereco = $request->edit_endereco[$key];
                $adress->cep = $request->edit_cep[$key];
                $adress->bairro = $request->edit_bairro[$key];
                $adress->cidade = $request->edit_cidade[$key];
                $adress->estado = $request->edit_estado[$key];
                $adress->update();

            }
        }else{
            $contact->endereco()->delete();
            foreach ($request->edit_endereco as $key => $endereco) {
               $adress = new Endereco();
               $adress->endereco = $request->edit_endereco[$key];
               $adress->cep = $request->edit_cep[$key];
               $adress->bairro = $request->edit_bairro[$key];
               $adress->cidade = $request->edit_cidade[$key];
               $adress->estado = $request->edit_estado[$key];
               $adress->id_contato = $contact->id;
               $adress->save();

            }
        }

        $contact->update();

        return redirect()->route('dashboard')->with('status', 'Contato editado com sucesso!');


    }


    public function destroy(Request $request)
    {
        $request->validate([
            'contact' => 'required',
        ]);

        if (!$contact = Contato::find($request->contact)) {
            return back()->withErrors([
                'Erro' => 'Algumas informações estão incorretas',
            ]);
        }

        if ($contact->telefone()->exists()) {
            foreach ($contact->telefone as $telefone) {
                $telefone->delete();
            }
        }

        if ($contact->email()->exists()) {
            foreach ($contact->email as $email) {
                $email->delete();
            }
        }

        if ($contact->endereco()->exists()) {
            foreach ($contact->endereco as $endereco) {
                $endereco->delete();
            }
        }

        $contact->delete();

        return redirect()->route('dashboard')->with('status', 'O contato foi apagado!');

    }
}
