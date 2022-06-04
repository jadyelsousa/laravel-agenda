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


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
