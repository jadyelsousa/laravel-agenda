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
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-phone-plus"></i> Novo Contato</button>
                        </div>
                      </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
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
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check1">
                                                        <label for="check1"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a>
                                                </td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a
                                                    solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"></td>
                                                <td class="mailbox-date"><button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                                                    <i class="fas fa-comments"></i>
                                                    </button><button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                                                        <i class="fas fa-comments"></i>
                                                        </button></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check2">
                                                        <label for="check2"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star-o text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a>
                                                </td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a
                                                    solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">28 mins ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check3">
                                                        <label for="check3"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star-o text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a>
                                                </td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a
                                                    solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">11 hours ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check4">
                                                        <label for="check4"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a>
                                                </td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a
                                                    solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"></td>
                                                <td class="mailbox-date">15 hours ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check5">
                                                        <label for="check5"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a>
                                                </td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a
                                                    solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">Yesterday</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check6">
                                                        <label for="check6"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star-o text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a>
                                                </td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find a
                                                    solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">2 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check7">
                                                        <label for="check7"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star-o text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">2 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check8">
                                                        <label for="check8"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"></td>
                                                <td class="mailbox-date">2 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check9">
                                                        <label for="check9"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"></td>
                                                <td class="mailbox-date">2 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check10">
                                                        <label for="check10"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star-o text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"></td>
                                                <td class="mailbox-date">2 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check11">
                                                        <label for="check11"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star-o text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">4 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check12">
                                                        <label for="check12"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"></td>
                                                <td class="mailbox-date">12 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check13">
                                                        <label for="check13"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star-o text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">12 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check14">
                                                        <label for="check14"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">14 days ago</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="" id="check15">
                                                        <label for="check15"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fas fa-star text-warning"></i></a></td>
                                                <td class="mailbox-name"><a href="read-mail.html">Alexander
                                                        Pierce</a></td>
                                                <td class="mailbox-subject"><b>AdminLTE 3.0 Issue</b> - Trying to find
                                                    a solution to this problem...
                                                </td>
                                                <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td>
                                                <td class="mailbox-date">15 days ago</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="card-footer p-0">
                                <div class="mailbox-controls">

                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                        <i class="far fa-square"></i>
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
                    <form>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
                          </div>
                        </div>

                        <label >Telefone</label>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" name="telefone[]" placeholder="Telefone">
                              </div>
                              <div class="form-group col-md-6">
                                <select class="form-control" name="tipo[]">
                                    <option selected >Celular</option>
                                    <option>Comercial</option>
                                    <option>Casa</option>
                                    <option>Principal</option>
                                    <option>Outros</option>
                                    </select>
                              </div>
                              <div class="form-group col-md-2 tnp-buttons">
                                <button type='button' class='mb-xs mr-xs btn btn-primary addmorephone'><i class='fa fa-plus'></i></button>

                            </div>
                        </div>
                        <div id="phoneappendhere">
                        </div>
                        <label>Endereço</label>
                        <div class="adress-group">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" value="{{old('cep')}}" name="cep[]" placeholder="CEP">
                              </div>
                          <div class="form-group col-md-6">
                            <input type="text" class="form-control" value="{{old('cidade')}}" name="cidade[]" placeholder="Cidade">
                          </div>
                          <div class="form-group col-md-2">
                            <input type="text" class="form-control" value="{{old('estado')}}" name="estado[]" placeholder="Estado">
                          </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-10">
                            <input type="text" class="form-control" placeholder="Endereço ">
                          </div>
                          <div class="form-group col-md-2 tna-buttons">
                            <button type='button' class='mb-xs mr-xs btn btn-primary addmoreadress'><i class='fa fa-plus'></i></button>

                        </div>
                    </div>
                        </div>
                        <div id="adressappendhere">
                        </div>



                      </form>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  <button type="button" class="btn btn-primary">Salvar</button>
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
    <footer class="main-footer">

        <!-- Default to the left -->
        <strong>Click <a href="mailto:jadyelbatera@gmail.com">here</a></strong>
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
     <!-- jQuery -->
     <script src="../../plugins/jquery/jquery.min.js"></script>
     <!-- Bootstrap 4 -->
     <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
     <!-- AdminLTE App -->
     <script src="../../dist/js/adminlte.min.js"></script>
     <!-- AdminLTE for demo purposes -->
     <script src="../../dist/js/demo.js"></script>
    <script>



$(document).on('click', '.addmorephone', function (ev) {
	var $clone = $(this).parent().parent().clone(true);
	var $newbuttons = "<button type='button' class='mb-xs mr-xs btn btn-primary addmorephone'><i class='fa fa-plus'></i></button>&nbsp;<button type='button' class='mb-xs mr-xs btn btn-primary removephone'><i class='fa fa-minus'></i></button>";
	$clone.find('.tnp-buttons').html($newbuttons).end().appendTo($('#phoneappendhere'));
});

$(document).on('click', '.removephone', function () {
	$(this).parent().parent().remove();
});

$(document).on('click', '.addmoreadress', function (ev) {
    var clone = $('div.adress-group:eq(0)').clone().val("");
    console.log(clone);
    clone.find('[name]').each(function(i,c){
   });
   $('#adressappendhere').append(clone)

	var $newbuttons = "<button type='button' class='mb-xs mr-xs btn btn-primary addmoreadress'><i class='fa fa-plus'></i></button>&nbsp;<button type='button' class='mb-xs mr-xs btn btn-primary removeadress'><i class='fa fa-minus'></i></button>";
	$clone.find('.tna-buttons').html($newbuttons);
});

$(document).on('click', '.removeadress', function () {
	$(this).parent().parent().remove();
});
    </script>


</body>

</html>
