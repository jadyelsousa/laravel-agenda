
// Código jquery para validação de front end do formuluário de novo contato
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


// Código jquery para validação de front end do formuluário de edição de contato
$(function() {

    $('#editForm').validate({
        rules: {

            'edit_email[]': {
                required: true,
                email: true,
            },
            'edit_telefone[]': {
                required: true,
            },
            'edit_tipo_telefone[]': {
                required: true,
            },
            'edit_endereco[]': {
                required: true,
            },
            'edit_bairro[]': {
                required: true,
            },
            'edit_cidade[]': {
                required: true,
            },
            'edit_estado[]': {
                required: true,
            },
            'edit_cep[]': {
                required: true,
            },
            edit_nome: {
                required: true,
            },
            edit_sobrenome: {
                required: true
            },
        },
        messages: {
            'edit_email[]': {
                required: "Campo obrigatório",
                email: "Insira um email válido."
            },
            'edit_telefone[]': {
                required: "Campo obrigatório",
            },
            'edit_endereco[]': {
                required: "Campo obrigatório",
            },
            'edit_bairro[]': {
                required: "Campo obrigatório",
            },
            'edit_cidade[]': {
                required: "Campo obrigatório",
            },
            'edit_estado[]': {
                required: "Campo obrigatório",
            },
            'edit_cep[]': {
                required: "Campo obrigatório",
            },
            edit_nome: {
                required: "Campo obrigatório",
            },
            edit_sobrenome: {
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

//  Máscaras de inputs

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


// Busca de Endereço por cep - api viacep

function pesquisacep(valor) {

    var cep = valor.value;
    var inputCidade = valor.parentElement.nextElementSibling.firstElementChild;
    var inputEstado = inputCidade.parentElement.nextElementSibling.firstElementChild;
    var inputEndereco = valor.parentElement.parentElement.parentElement.lastElementChild.firstElementChild.firstElementChild;
    var inputBairro = inputEndereco.parentElement.nextElementSibling.firstElementChild;


    if (cep != "") {
        cep = cep.replace("-", "").replace(".", "");
        $("#mensagem").html('(Aguarde, consultando CEP ...)');
        var url = 'https://viacep.com.br/ws/'+cep+'/json/';
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var result = JSON.parse(this.responseText);
                console.log(result);
                if(result.erro != "true"){
                    console.log(result);
                    inputEndereco.setAttribute("value",result.logradouro);
                    inputEstado.setAttribute("value",result.uf);
                    inputBairro.setAttribute("value",result.bairro);
                    inputCidade.setAttribute("value",result.localidade);
                    $("#observacoes").focus();
                    $("#mensagem").html('');
                }else{
                    inputEndereco.setAttribute("value","");
                    inputEstado.setAttribute("value","");
                    inputBairro.setAttribute("value","");
                    inputCidade.setAttribute("value","");
                    $("#mensagem").html('(CEP inválido!)');
                }
            }
        }
        };
        xhttp.open('GET', url, true);
        xhttp.send();
    }

}
// Script que clona o campo de telefone;



$(document).on('click', '.addmorephone', function(ev) {
    var $clone = $(this).parent().parent().clone(true);
    $clone.find("input")
        .val("");
    var $newbuttons =
        "<button type='button' class='mb-xs mr-xs btn btn-primary removephone'><i class='fa fa-minus'></i></button>";
    $clone.find('.tnp-buttons').html($newbuttons).end().appendTo($('#phoneappendhere'));
});

// Script que remove o campo de telefone;

$(document).on('click', '.removephone', function() {
    $(this).parent().parent().remove();
});


// Script que clona o campo de email;
$(document).on('click', '.addmoremail', function(ev) {
    var $clone = $(this).parent().parent().clone(true);
    $clone.find("input")
        .val("");
    var $newbuttons =
        "<button type='button' class='mb-xs mr-xs btn btn-primary removemail'><i class='fa fa-minus'></i></button>";
    $clone.find('.tnm-buttons').html($newbuttons).end().appendTo($('#mailappendhere'));
});

// Script que remove o campo de email;

$(document).on('click', '.removemail', function() {
    $(this).parent().parent().remove();
});

// Script que clona os campos de endereço;

$(document).on('click', '.addmoreadress', function(ev) {
    var clone = $('div.adress-group:eq(0)').clone();
    clone.find("input").attr("value","");

    var $newbutton =
        "<button type='button' class='mb-xs mr-xs btn btn-primary removeadress'><i class='fa fa-minus'></i></button>";
    clone.find('.tna-buttons').html($newbutton);
    clone.appendTo(".adressappendhere");

});

// Script que remove os campos de endereço;

$(document).on('click', '.removeadress', function() {
    $(this).closest(".adress-group").remove();

});


// Script que clona o campo de telefone do modal editar;



$(document).on('click', '.addmorephone-edit', function(ev) {
    var $clone = $(this).parent().parent().clone();
    $clone.find("input")
        .val("");
     $('#phoneappendhere-edit').append($clone)
    var $newbuttons =
        "<button type='button' class='mb-xs mr-xs btn btn-primary removephone-edit'><i class='fa fa-minus'></i></button>";
    $clone.find('.tnp-buttons').html($newbuttons).end().appendTo($('#phoneappendhere-edit'));
});

// // Script que remove o campo de telefone do modal editar;

$(document).on('click', '.removephone-edit', function() {
    $(this).parent().parent().remove();
});


// Script que clona o campo de email do modal editar;
$(document).on('click', '.addmoremail-edit', function(ev) {
    var $clone = $(this).parent().parent().clone().last();
    $clone.find("input")
        .val("");
    var $newbuttons =
        "<button type='button' class='mb-xs mr-xs btn btn-primary removemail-edit'><i class='fa fa-minus'></i></button>";
    $clone.find('.tnm-buttons').html($newbuttons).end().appendTo($('#mailappendhere-edit'));
});

// Script que remove o campo de email do modal editar;

$(document).on('click', '.removemail-edit', function() {
    $(this).parent().parent().remove();
});

// Script que clona os campos de endereço do modal editar;

$(document).on('click', '.addmoreadress-edit', function(ev) {
    var clone = $('div.adress-group-edit:eq(0)').clone().last();
    // clone.find("input[type='text']")
    //     .val("");
    var $newbutton =
        "<button type='button' class='mb-xs mr-xs btn btn-primary removeadress-edit'><i class='fa fa-minus'></i></button>";
    clone.find('.tna-buttons').html($newbutton);
    clone.appendTo(".adressappendhere-edit");

});

// Script que remove os campos de endereço do modal editar;

$(document).on('click', '.removeadress-edit', function() {
    $(this).closest(".adress-group-edit").remove();

});




// script para passar valor do contato para modal de exclusão

$(document).on('click', '.deleteContact', function() {
    var id = $(this).attr('data-id');
    // pega o id do contato ao clicar no botão, e adiciona ao input contactId
    $('#contactId').val(id);

    $('#mdlExcluir').modal('show');
});

//  script para modal de edição de contato

$(document).on('click', '.modalEdit', function() {

    // limpa os dados dessas classes toda vez que clicar em editar
    $(".phone-row").html("");
    $("#phoneappendhere-edit").html("");
    $(".email-row").html("");
    $("#mailappendhere-edit").html("");
    $(".adress-group-edit").html("");
    $("#adressappendhere-edit").html("");

    var newId = 0;
    // recebe os dados do contato clicado
    var contact = $(this).attr('data-contact');
    // converte para um objeto JSON
    contact = JSON.parse(contact);
    $('#edit_nome').val(contact.nome);
    $('#edit_sobrenome').val(contact.sobrenome);
    $('#edit_observacoes').val(contact.observacoes);
    $('#id_contact').val(contact.id);

    // pegando as divs onde vão ser criados os elementos
    var telefoneDiv = document.getElementById("phone-row");
    var telefoneAppendDiv = document.getElementById("phoneappendhere-edit");
    var emailDiv = document.getElementById("email-row");
    var emailAppendDiv = document.getElementById("mailappendhere-edit");
    var enderecoDiv = document.getElementById("adress-group-edit");
    var enderecoAppendDiv = document.getElementById("adressappendhere-edit");


    contact.telefone.map( divisao => {
        // pecorrer os contatos e criar os elementos
        var divPrincial = document.createElement('div');
        divPrincial.setAttribute("class","form-row");
        var divOne = document.createElement('div');
        divOne.setAttribute("class","form-group col-md-4");
        var inputTelefone = document.createElement('input');
        inputTelefone.setAttribute("type","text");
        inputTelefone.setAttribute("class","form-control telefone-mask");
        inputTelefone.setAttribute("name","edit_telefone[]");
        inputTelefone.setAttribute("value", divisao.telefone);
        inputTelefone.setAttribute("id", "edit_telefone");
        inputTelefone.setAttribute("placeholder", "(__) ____-____");
        divOne.appendChild(inputTelefone);
        var divTwo = document.createElement('div');
        divTwo.setAttribute("class","form-group col-md-6");
        var selectTelefone = document.createElement('select');
        selectTelefone.setAttribute("class","form-control");
        selectTelefone.setAttribute("name","edit_tipo_telefone[]");
        var optionOneTelefone = document.createElement('option');
        optionOneTelefone.innerHTML = "Celular";
        // verifica qual elemento está marcado no banco de dados
        if (divisao.tipo == "Celular") {
            optionOneTelefone.setAttribute('selected', 'selected');
        }
        var optionTwoTelefone = document.createElement('option');
        optionTwoTelefone.innerHTML = "Comercial";
        if (divisao.tipo == "Comercial") {
            optionTwoTelefone.setAttribute('selected', 'selected');
        }
        var optionThreeTelefone = document.createElement('option');
        optionThreeTelefone.innerHTML = "Casa";
        if (divisao.tipo == "Casa") {
            optionThreeTelefone.setAttribute('selected', 'selected');
        }
        var optionFourTelefone = document.createElement('option');
        optionFourTelefone.innerHTML = "Principal";
        if (divisao.tipo == "Principal") {
            optionFourTelefone.setAttribute('selected', 'selected');
        }
        var optionFiveTelefone = document.createElement('option');
        optionFiveTelefone.innerHTML = "Outros";
        if (divisao.tipo == "Outros") {
            optionFiveTelefone.setAttribute('selected', 'selected');
        }
        selectTelefone.appendChild(optionOneTelefone);
        selectTelefone.appendChild(optionTwoTelefone);
        selectTelefone.appendChild(optionThreeTelefone);
        selectTelefone.appendChild(optionFourTelefone);
        selectTelefone.appendChild(optionFiveTelefone);
        divTwo.appendChild(selectTelefone);
        var divThree = document.createElement('div');
        divThree.setAttribute("class","form-group col-md-2 tnp-buttons");
        var buttonTelefone = document.createElement('button');
        buttonTelefone.setAttribute("type","button");
        // verifica para criação do botão de mais ou menos
        if (newId > 0) {
            buttonTelefone.setAttribute("class","mb-xs mr-xs btn btn-primary removephone-edit");
            var buttonIconTelefone = document.createElement('i');
            buttonIconTelefone.setAttribute("class","fa fa-minus");
        }else {
            buttonTelefone.setAttribute("class","mb-xs mr-xs btn btn-primary addmorephone-edit");
            var buttonIconTelefone = document.createElement('i');
            buttonIconTelefone.setAttribute("class","fa fa-plus");
        }

        buttonTelefone.appendChild(buttonIconTelefone);
        divThree.appendChild(buttonTelefone);
        // verifica onde a div será colocada
        if (newId > 0) {
            divPrincial.appendChild(divOne);
            divPrincial.appendChild(divTwo);
            divPrincial.appendChild(divThree);
            telefoneAppendDiv.appendChild(divPrincial);
        }else {
            telefoneDiv.appendChild(divOne);
            telefoneDiv.appendChild(divTwo);
            telefoneDiv.appendChild(divThree);
        }

        newId++;

    });

    newId = 0;
    contact.email.map( divisao => {
        // pecorrer os emails e criar os elementos
        var divPrincial = document.createElement('div');
        divPrincial.setAttribute("class","form-row")
        var divOne = document.createElement('div');
        divOne.setAttribute("class","form-group col-md-4");
        var inputEmail = document.createElement('input');
        inputEmail.setAttribute("type","text");
        inputEmail.setAttribute("class","form-control");
        inputEmail.setAttribute("name","edit_email[]");
        inputEmail.setAttribute("value", divisao.email);
        inputEmail.setAttribute("id", "edit_email");
        inputEmail.setAttribute("placeholder", "Email");
        divOne.appendChild(inputEmail);
        var divTwo = document.createElement('div');
        divTwo.setAttribute("class","form-group col-md-6");
        var selectEmail = document.createElement('select');
        selectEmail.setAttribute("class","form-control");
        selectEmail.setAttribute("name","edit_tipo_email[]");
        var optionOneEmail = document.createElement('option');
        optionOneEmail.setAttribute('selected', 'selected');
        optionOneEmail.innerHTML = "Pessoal";
        if (divisao.tipo == "Pessoal") {
            optionOneEmail.setAttribute('selected', 'selected');
        }
        var optionTwoEmail = document.createElement('option');
        optionTwoEmail.innerHTML = "Corporativo";
        if (divisao.tipo == "Corporativo") {
            optionTwoEmail.setAttribute('selected', 'selected');
        }
        var optionThreeEmail = document.createElement('option');
        optionThreeEmail.innerHTML = "Academico";
        if (divisao.tipo == "Academico") {
            optionThreeEmail.setAttribute('selected', 'selected');
        }
        var optionFourEmail = document.createElement('option');
        optionFourEmail.innerHTML = "Principal";
        if (divisao.tipo == "Principal") {
            optionFourEmail.setAttribute('selected', 'selected');
        }
        var optionFiveEmail = document.createElement('option');
        optionFiveEmail.innerHTML = "Outros";
        if (divisao.tipo == "Outros") {
            optionFiveEmail.setAttribute('selected', 'selected');
        }
        selectEmail.appendChild(optionOneEmail);
        selectEmail.appendChild(optionTwoEmail);
        selectEmail.appendChild(optionThreeEmail);
        selectEmail.appendChild(optionFourEmail);
        selectEmail.appendChild(optionFiveEmail);
        divTwo.appendChild(selectEmail);
        var divThree = document.createElement('div');
        divThree.setAttribute("class","form-group col-md-2 tnm-buttons");
        var buttonEmail = document.createElement('button');
        buttonEmail.setAttribute("type","button");
        if (newId > 0) {
            buttonEmail.setAttribute("class","mb-xs mr-xs btn btn-primary removemail-edit");
            var buttonIconEmail = document.createElement('i');
            buttonIconEmail.setAttribute("class","fa fa-minus");
        }else {
            buttonEmail.setAttribute("class","mb-xs mr-xs btn btn-primary addmoremail-edit");
            var buttonIconEmail = document.createElement('i');
            buttonIconEmail.setAttribute("class","fa fa-plus");
        }
        buttonEmail.appendChild(buttonIconEmail);
        divThree.appendChild(buttonEmail);

        if (newId > 0) {
            divPrincial.appendChild(divOne);
            divPrincial.appendChild(divTwo);
            divPrincial.appendChild(divThree);
            emailAppendDiv.appendChild(divPrincial);
        }else {
            emailDiv.appendChild(divOne);
            emailDiv.appendChild(divTwo);
            emailDiv.appendChild(divThree);
        }

        newId++;
    });

    newId = 0;
    contact.endereco.map( divisao => {
        // pecorrer os enderecos e criar os elementos
        var divPrincipal = document.createElement('div');
        divPrincipal.setAttribute("class","adress-group-edit")
        var divOne = document.createElement('div');
        divOne.setAttribute("class","form-row");
        var divTwo = document.createElement('div');
        divTwo.setAttribute("class","form-group col-md-2");
        var inputCep = document.createElement('input');
        inputCep.setAttribute("type","text");
        inputCep.setAttribute("class","form-control cep-mask");
        inputCep.setAttribute("onblur","pesquisacep(this);");
        inputCep.setAttribute("id","edit_cep");
        inputCep.setAttribute("value",divisao.cep);
        inputCep.setAttribute("name","edit_cep[]");
        inputCep.setAttribute("placeholder","CEP");
        divTwo.appendChild(inputCep);
        var divThree = document.createElement('div');
        divThree.setAttribute("class","form-group col-md-6");
        var inputCidade = document.createElement('input');
        inputCidade.setAttribute("type","text");
        inputCidade.setAttribute("class","form-control");
        inputCidade.setAttribute("id","edit_cidade");
        inputCidade.setAttribute("value",divisao.cidade);
        inputCidade.setAttribute("name","edit_cidade[]");
        inputCidade.setAttribute("placeholder","Cidade");
        divThree.appendChild(inputCidade);
        var divFour = document.createElement('div');
        divFour.setAttribute("class","form-group col-md-2");
        var inputEstado = document.createElement('input');
        inputEstado.setAttribute("type","text");
        inputEstado.setAttribute("class","form-control");
        inputEstado.setAttribute("id","edit_estado");
        inputEstado.setAttribute("value",divisao.estado);
        inputEstado.setAttribute("name","edit_estado[]");
        inputEstado.setAttribute("placeholder","Estado");
        divFour.appendChild(inputEstado);
        divOne.appendChild(divTwo);
        divOne.appendChild(divThree);
        divOne.appendChild(divFour);
        var divFive = document.createElement('div');
        divFive.setAttribute("class","form-row");
        var divSix = document.createElement('div');
        divSix.setAttribute("class","form-group col-md-6");
        var inputEndereco = document.createElement('input');
        inputEndereco.setAttribute("type","text");
        inputEndereco.setAttribute("class","form-control");
        inputEndereco.setAttribute("id","edit_endereco");
        inputEndereco.setAttribute("value",divisao.endereco);
        inputEndereco.setAttribute("name","edit_endereco[]");
        inputEndereco.setAttribute("placeholder","Endereco");
        divSix.appendChild(inputEndereco);
        var divSeven = document.createElement('div');
        divSeven.setAttribute("class","form-group col-md-4");
        var inputBairro = document.createElement('input');
        inputBairro.setAttribute("type","text");
        inputBairro.setAttribute("class","form-control");
        inputBairro.setAttribute("id","edit_bairro");
        inputBairro.setAttribute("value",divisao.bairro);
        inputBairro.setAttribute("name","edit_bairro[]");
        inputBairro.setAttribute("placeholder","Bairro");
        divSeven.appendChild(inputBairro);
        var divEight = document.createElement('div');
        divEight.setAttribute("class","form-group col-md-2 tna-buttons");
        var buttonEndereco = document.createElement('button');
        buttonEndereco.setAttribute("type","button");
        if (newId > 0) {
            buttonEndereco.setAttribute("class","mb-xs mr-xs btn btn-primary removeadress-edit");
            var buttonIconEndereco = document.createElement('i');
            buttonIconEndereco.setAttribute("class","fa fa-minus");
        }else {
            buttonEndereco.setAttribute("class","mb-xs mr-xs btn btn-primary addmoreadress-edit");
            var buttonIconEndereco = document.createElement('i');
            buttonIconEndereco.setAttribute("class","fa fa-plus");
        }

        buttonEndereco.appendChild(buttonIconEndereco);
        divEight.appendChild(buttonEndereco);
        divFive.appendChild(divSix);
        divFive.appendChild(divSeven);
        divFive.appendChild(divEight);
        if (newId > 0) {
            divPrincipal.appendChild(divOne);
            divPrincipal.appendChild(divFive);
            enderecoAppendDiv.appendChild(divPrincipal);
        }else {
            enderecoDiv.appendChild(divOne);
            enderecoDiv.appendChild(divFive);

        }
        newId++;

    });

});
