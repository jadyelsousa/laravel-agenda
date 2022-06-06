<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página inicial</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="layout-top-nav sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ route('login') }}" class="navbar-brand">
                    <span class="brand-text font-weight-light">personal contacts</span>
                </a>
            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <button type="submit" class="nav-link border-transparent"
                            style=" background-color: transparent !important; margin-top: -2px;" onclick="event.preventDefault();
                              this.disabled=true;
                              this.value='Enviando';
                              this.closest('form').submit(); "><i class="fas fa-sign-out-alt"></i>
                            <span class="d-none d-md-inline">Sair</span>



                        </button>
                    </form>
                </li>
            </ul>
    </div>
    </nav>
    <!-- /.navbar -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Bem vindo <small>{{ Auth::user()->name }}</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#modal-lg"><i class="fa fa-phone-plus"></i> Novo Contato</button>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                @if (isset($query))
                    <h5>Exibindo resultados para: "{{$query}}"</h5>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Contatos</h3>
                                <div class="card-tools">
                                    <form action="{{route('contact.search')}}" method="post">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="Procurar Contato">
                                            <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>

                                            {{-- código de autocomplete na pesquisa --}}
                                            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
                                            </script>
                                            <script type="text/javascript">
                                                var route = "{{ url('contact/searchSuggestion') }}";
                                                $('#search').typeahead({
                                                    source: function (query, process) {
                                                        return $.get(route, {
                                                            term : query
                                                        }, function (data) {
                                                            return process(data);
                                                        });
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    {{-- <div class="float-right">
                                        @if (isset($filters))
                                        {{ $contacts->appends($filters)->links()}}
                                        @else
                                        {{ $contacts->links()}}
                                        @endif
                                    </div> --}}

                                </div>
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            @forelse ($contacts as $key => $contact)
                                                <tr>
                                                    <td><h5>{{$key}}</h5></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @foreach ($contact as $item)
                                                <tr>
                                                    <td class="mailbox-subject"><b>{{ $item->nome }}</b>
                                                        {{ $item->sobrenome }}
                                                    </td>
                                                    <td class="mailbox-name"><a
                                                            href="tel:{{ $item->telefone[0]->telefone }}">{{ $item->telefone[0]->telefone }}</a>...</td>
                                                    <td class="mailbox-name"><a
                                                            href="mailto:{{$item->email[0]->email}}">{{ $item->email[0]->email }}</a>...
                                                    </td>
                                                    <td class="mailbox-attachment">
                                                        {{ $item->endereco[0]->endereco }}...
                                                    </td>
                                                    <td class="mailbox-date">
                                                        <a href="#" data-toggle="modal" data-target="#mdlExcluir" data-id="{{$item->id}}"
                                                        class="nav-link float-right deleteContact">
                                                        <i class="far fa-trash-alt"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#modal-lg-edit" data-contact="{{$item}}"
                                                        class="nav-link float-right modalEdit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            @empty
                                                <tr>
                                                    <td>
                                                        Nada ainda! Adicione novos contatos!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="card-footer p-0">
                                {{-- @if (isset($filters))
                                {{ $contacts->appends($filters)->links()}}
                                @else
                                {{ $contacts->links()}}
                                @endif --}}
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        {{-- Modal de Cadastro de Contato --}}
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Novo Contato</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="cadForm" method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}"
                                        placeholder="Nome">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sobrenome">Sobrenome</label>
                                    <input type="text" class="form-control" id="sobrenome" value="{{ old('sobrenome') }}"
                                        name="sobrenome" placeholder="Sobrenome">
                                </div>
                            </div>

                            <label>Telefone</label>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control telefone-mask" name="telefone[]" value="{{ old('telefone.0') }}"
                                        id="telefone" placeholder="(__) ____-____">
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control" name="tipo_telefone[]">
                                        <option selected>Celular</option>
                                        <option>Comercial</option>
                                        <option>Casa</option>
                                        <option>Principal</option>
                                        <option>Outros</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 tnp-buttons">
                                    <button type='button' class='mb-xs mr-xs btn btn-primary addmorephone'><i
                                            class='fa fa-plus'></i></button>

                                </div>
                            </div>
                            <div id="phoneappendhere">
                            </div>
                            <label>Email</label>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="email[]" value="{{ old('email.0') }}" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control" name="tipo_email[]">
                                        <option selected>Pessoal</option>
                                        <option>Corporativo</option>
                                        <option>Academico</option>
                                        <option>Principal</option>
                                        <option>Outros</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 tnm-buttons">
                                    <button type='button' class='mb-xs mr-xs btn btn-primary addmoremail'><i
                                            class='fa fa-plus'></i></button>

                                </div>
                            </div>
                            <div id="mailappendhere">
                            </div>
                            <label>Endereço</label>
                            <span id='mensagem' style='color: red; font-size: 13px;'></span>
                            <div class="adress-group">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <input type="text" class="form-control cep-mask"
                                            onblur="pesquisacep(this);" id="cep" value="{{ old('cep.0') }}"
                                            name="cep[]" placeholder="CEP">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="cidade"
                                            value="{{ old('cidade.0') }}" name="cidade[]" placeholder="Cidade">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" class="form-control" id="estado"
                                            value="{{ old('estado.0') }}" name="estado[]" placeholder="Estado">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="endereco[]" id="endereco"
                                        value="{{ old('endereco.0') }}" placeholder="Endereço ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" name="bairro[]" id="bairro"
                                        value="{{ old('bairro.0') }}" placeholder="Bairro ">
                                    </div>
                                    <div class="form-group col-md-2 tna-buttons">
                                        <button type='button' class='mb-xs mr-xs btn btn-primary addmoreadress'><i
                                                class='fa fa-plus'></i></button>

                                    </div>
                                </div>
                            </div>
                            <div id="adressappendhere" class="adressappendhere">
                            </div>
                            <div class="form-group">
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" name="observacoes" id="observacoes" placeholder="(Opcional)"></textarea>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /. fim do modal -->

        {{-- Modal de edição de contato --}}
        <div class="modal fade" id="modal-lg-edit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Contato</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="editForm" method="POST" action="{{ route('contact.update') }}">
                            @csrf
                            <input type="hidden" name="id_contact" id="id_contact">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="edit_nome" name="edit_nome" value="{{ old('edit_nome') }}"
                                        placeholder="Nome">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sobrenome">Sobrenome</label>
                                    <input type="text" class="form-control" id="edit_sobrenome" value="{{ old('edit_sobrenome') }}"
                                        name="edit_sobrenome" placeholder="Sobrenome">
                                </div>
                            </div>

                            <label>Telefone</label>
                            <div class="form-row phone-row" id="phone-row">
                                {{-- div onde serão criados campos de telefone --}}
                            </div>
                            <div id="phoneappendhere-edit">
                            </div>
                            <label>Email</label>
                            <div class="form-row email-row" id="email-row">
                                {{-- div onde serão criados campos de email --}}
                            </div>
                            <div id="mailappendhere-edit">
                            </div>
                            <label>Endereço</label>
                            <span id='edit_mensagem' style='color: red; font-size: 13px;'></span>
                            <div class="adress-group-edit" id="adress-group-edit">
                                {{-- div onde serão criados campos de endereco --}}
                            </div>
                            <div id="adressappendhere-edit" class="adressappendhere-edit">
                            </div>
                            <div class="form-group">
                                <label>Observações</label>
                                <textarea class="form-control" rows="3" id="edit_observacoes" name="edit_observacoes" placeholder="(Opcional)"></textarea>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /. fim do modal -->

        {{-- modal de exclusão de contato --}}

         <div class="modal" id="mdlExcluir" tabindex="-1" role="dialog">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-body text-center">
                    <form class="needs-validation" id="deleteform" action="{{route('contact.destroy')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="contact" id="contactId" class="recipient-name">
                        <br/>
                        <span style="font-size: 30px; color: #595959"><b>Exclusão de contato</b></span><br/>
                        <b style="font-size: 20px" class="text-danger">Tem certeza que deseja apagar esse contato?</b><br><br>
                        <a style="min-width: 100px; margin-right: 20px" type="button" class="btn btn-default btn-tam" data-dismiss="modal">Cancelar</a>
                        <button name="send" id="send" style="min-width: 100px" type='submit'  class='btn btn-danger btn-tam' >Excluir</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim do modal-->

    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class=" main-footer">

        <!-- Default to the left -->
        <strong>Click <a href="mailto:jadyelbatera@gmail.com">here</a></strong>
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/jquery-validation/jquery.mask.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- jquery-validation -->
    <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../../dist/js/dashboardValidation.js"></script>

</body>

</html>
