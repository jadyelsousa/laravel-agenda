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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Contatos</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" placeholder="Procurar Contato">
                                        <div class="input-group-append">
                                            <div class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body p-0">
                                <div class="mailbox-controls">

                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                            class="far fa-square"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-reply"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-share"></i>
                                        </button>
                                    </div>

                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <div class="float-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-chevron-left"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                        </div>

                                    </div>

                                </div>
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            @forelse ($contacts as $contact)
                                                <tr>
                                                    <td>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" value="" id="check4">
                                                            <label for="check4"></label>
                                                        </div>
                                                    </td>
                                                    <td class="mailbox-name"><a
                                                            href="#">{{ $contact->telefone[0]->telefone }}</a>...</td>
                                                    <td class="mailbox-name"><a
                                                            href="read-mail.html">{{ $contact->email[0]->email }}</a>...
                                                    </td>
                                                    <td class="mailbox-subject"><b>{{ $contact->nome }}</b>
                                                        {{ $contact->sobrenome }}
                                                    </td>
                                                    <td class="mailbox-attachment">
                                                        {{ $contact->endereco[0]->endereco }}
                                                    </td>
                                                    <td class="mailbox-date"><a href="" target="__blank"
                                                            class="nav-link float-right">
                                                            <i class="fas fa-edit"></i>
                                                        </a></td>
                                                </tr>
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
                                {{$contacts->links()}}
                                <div class="mailbox-controls">
                                    <div class="float-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-chevron-left"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
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
                                            onblur="pesquisacep(this.value);" id="cep" value="{{ old('cep.0') }}"
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
                                            placeholder="Endereço ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" name="bairro[]" id="bairro"
                                            placeholder="Bairro ">
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
                                <textarea class="form-control" rows="3" name="observacoes" placeholder="(Opcional)"></textarea>
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
        <!-- /.modal -->

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

    <!-- Page specific script -->
    <script>
        $(function() {

            $('#cadForm').validate({
                rules: {

                    'email[]': {
                        required: true,
                        email: true,
                    },
                    'telefone[]': {
                        required: true,
                    },
                    'tipo_telefone[]': {
                        required: true,
                    },
                    'endereco[]': {
                        required: true,
                    },
                    'bairro[]': {
                        required: true,
                    },
                    'cidade[]': {
                        required: true,
                    },
                    'estado[]': {
                        required: true,
                    },
                    'cep[]': {
                        required: true,
                    },
                    nome: {
                        required: true,
                    },
                    sobrenome: {
                        required: true
                    },
                },
                messages: {
                    'email[]': {
                        required: "Campo obrigatório",
                        email: "Insira um email válido."
                    },
                    'telefone[]': {
                        required: "Campo obrigatório",
                    },
                    'endereco[]': {
                        required: "Campo obrigatório",
                    },
                    'bairro[]': {
                        required: "Campo obrigatório",
                    },
                    'cidade[]': {
                        required: "Campo obrigatório",
                    },
                    'estado[]': {
                        required: "Campo obrigatório",
                    },
                    'cep[]': {
                        required: "Campo obrigatório",
                    },
                    nome: {
                        required: "Campo obrigatório",
                    },
                    sobrenome: {
                        required: "Campo obrigatório"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        $('.telefone-mask').mask('(00) 0000-00009');
        $('.telefone-mask').blur(function(event) {
            if ($(this).val().length == 15) {
                $('.telefone-mask').mask('(00) 00000-0009');
            } else {
                $('.telefone-mask').mask('(00) 0000-00009');
            }
        });

        $(".cep-mask").mask("99.999-999");
        $('.cep-mask').blur(function(event) {
            $(".cep-mask").mask("99.999-999");
        });
    </script>
    <script>
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('endereco').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
            // document.getElementById('ibge').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('endereco').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('estado').value = (conteudo.uf);
                $("#mensagem").html('');
                // document.getElementById('ibge').value=(conteudo.ibge);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                $("#mensagem").html('(CEP inválido!)');
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#mensagem").html('(Aguarde, consultando CEP ...)');
                    document.getElementById('endereco').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('estado').value = "...";
                    // document.getElementById('ibge').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    $("#mensagem").html('(CEP inválido!)');
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>
    <script>
        $(document).on('click', '.addmorephone', function(ev) {
            var $clone = $(this).parent().parent().clone(true);
            $clone.find("input")
                .val("");
            var $newbuttons =
                "<button type='button' class='mb-xs mr-xs btn btn-primary removephone'><i class='fa fa-minus'></i></button>";
            $clone.find('.tnp-buttons').html($newbuttons).end().appendTo($('#phoneappendhere'));
        });

        $(document).on('click', '.removephone', function() {
            $(this).parent().parent().remove();
        });

        $(document).on('click', '.addmoremail', function(ev) {
            var $clone = $(this).parent().parent().clone(true);
            $clone.find("input")
                .val("");
            var $newbuttons =
                "<button type='button' class='mb-xs mr-xs btn btn-primary removemail'><i class='fa fa-minus'></i></button>";
            $clone.find('.tnm-buttons').html($newbuttons).end().appendTo($('#mailappendhere'));
        });

        $(document).on('click', '.removemail', function() {
            $(this).parent().parent().remove();
        });

        $(document).on('click', '.addmoreadress', function(ev) {
            var clone = $('div.adress-group:eq(0)').clone();
            clone.find("input[type='text']")
                .val("");
            var $newbutton =
                "<button type='button' class='mb-xs mr-xs btn btn-primary removeadress'><i class='fa fa-minus'></i></button>";
            clone.find('.tna-buttons').html($newbutton);
            clone.appendTo(".adressappendhere");

        });

        $(document).on('click', '.removeadress', function() {
            $(this).closest(".adress-group").remove();

        });
    </script>


</body>

</html>
