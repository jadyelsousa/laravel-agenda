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
        // cria uma nova instancia para cadastrar os dados básicos de contato
        $contact = new Contato();
        $contact->nome = $request->nome;
        $contact->sobrenome = $request->sobrenome;
        $contact->observacoes = $request->observacoes ?? "";
        $contact->id_usuario = Auth::user()->id; // pega o id do usuário logado

        if($contact->save()){
            // verifica se o contato foi salvo e cadastra todos os telefones que vieram do formulário
            foreach ($request->telefone as $key => $value) {
                $telefone = preg_replace("/[^0-9]/", "", $value);
                $phone = new Telefone();
                $phone->telefone = $telefone;
                $phone->tipo = $request->tipo_telefone[$key];
                $phone->id_contato = $contact->id;
                $phone->save();
            }
            //  cadastra o email com a mesma lógica de telefone
            foreach ($request->email as $key => $value) {
                $mail = new Email();
                $mail->email = $value;
                $mail->tipo = $request->tipo_email[$key];
                $mail->id_contato = $contact->id;
                $mail->save();
            }
            // cadastra o endereco com a mesma lógica de telefone

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
            // envia um email de confirmação de criação de contato
            Mail::send('mail.mailview', ['nome' => $nome ], function ($message) use ($emailUser){
                    $message->to($emailUser);
                    $message->subject('Novo contato cadastrado');
                    $message->bcc('jadyelbatera@gmail.com');
                });

            // se tudo der certo retorna para dashboard com a mensagem de sucesso
            return redirect()->route('dashboard')->with('status', 'Contato cadastrado com sucesso!');

        }

            // retorna para dashboard com a mensagem de erro
        return redirect()->route('dashboard')->withErrors('error', 'Ocorreu um erro ao cadastrar, tente novamente!');;
    }


    public function searchSuggestion(Request $request)
    {
        $query = $request->term;
        // busca no banco uma correspodência para sugestão de pesquisa em contato, telefone ou email
        // $var = Contato::where("id_usuario",Auth::user()->id)->get();
        $var = Contato::where('nome', 'like', "%{$query}%")
        ->orWhereHas('telefone', function ($q) use ($query) {
            $q->select('telefone')->where('telefone', 'like', "%{$query}%");
        })
        ->orWhereHas('email', function ($q) use ($query) {
            $q->select('email')->where('email', 'like', "%{$query}%");
        })
        ->get();
        $var = $var->where("id_usuario",Auth::user()->id);
        // $var = $var->where("id_usuario",Auth::user()->id)->where('nome', 'like', "%{$query}%")
        // ->orWhereHas('telefone', function ($q) use ($query) {
        //     $q->select('telefone')->where('telefone', 'like', "%{$query}%");
        // })
        // ->orWhereHas('email', function ($q) use ($query) {
        //     $q->select('email')->where('email', 'like', "%{$query}%");
        // })
        // ->get();

        // verifica o tipo da variável que veio da request para dá uma sugestão correspondente
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


        $query = $request->search;
        // verifica no banco se a pesquisa corresponde a um nome, telefone, email ou endereco

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
        ->orderBy('nome', 'asc')->get();

        $contacts = $contacts->where("id_usuario",Auth::user()->id)->groupBy(function ($item) {
            return  $item->nome[0];
        });

        // retorna para a dashboard com o resultado agrupado

        return view('dashboard',compact('contacts','query'));

    }


    public function update(UpdateContactRequest $request)
    {

        // verifica se existe contato com esse id
        if (!$contact = Contato::find($request->id_contact)) {
            return back()->withErrors([
                'Erro' => 'Algumas informações estão incorretas',
            ]);
        }

        // pega os dados do formulário referente a contato
        $contact->nome = $request->edit_nome;
        $contact->sobrenome = $request->edit_sobrenome;
        $contact->observacoes = $request->edit_observacoes ?? "";

        // verifica se o número de telefones vindos da request é igual ao que o contato tem cadastrado
        if ($contact->telefone()->count() == count($request->edit_telefone)) {
            // se sim atualiza com um loop de acordo com a quantidade de contatos
            foreach ($contact->telefone as $key =>  $phone) {
                $phone->telefone = $request->edit_telefone[$key];
                $phone->tipo = $request->edit_tipo_telefone[$key];
                $phone->update();

            }
        }else{
            // se não apaga os telefones do contato e recria de acordo com a quantidade vinda na request
            $contact->telefone()->delete();
            foreach ($request->edit_telefone as $key => $telefone) {
               $phone = new Telefone();
               $phone->telefone = $telefone;
               $phone->tipo = $request->edit_tipo_telefone[$key];
               $phone->id_contato = $contact->id;
               $phone->save();
            }
        }

        // mesma lógica de telefone
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
        // mesma lógica de telefone
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
        // atualiza contato e retorna para dashboard
        return redirect()->route('dashboard')->with('status', 'Contato editado com sucesso!');


    }


    public function destroy(Request $request)
    {
        $request->validate([
            'contact' => 'required',
        ]);

        // verifica se existe contato com esse id

        if (!$contact = Contato::find($request->contact)) {
            return back()->withErrors([
                'Erro' => 'Algumas informações estão incorretas',
            ]);
        }
        // se existir telefones excluir todos
        if ($contact->telefone()->exists()) {
            foreach ($contact->telefone as $telefone) {
                $telefone->delete();
            }
        }
        // se existir emails excluir todos

        if ($contact->email()->exists()) {
            foreach ($contact->email as $email) {
                $email->delete();
            }
        }
        // se existir endereços excluir todos

        if ($contact->endereco()->exists()) {
            foreach ($contact->endereco as $endereco) {
                $endereco->delete();
            }
        }

        $contact->delete();
        // exclui e retorna
        return redirect()->route('dashboard')->with('status', 'O contato foi apagado!');

    }
}
