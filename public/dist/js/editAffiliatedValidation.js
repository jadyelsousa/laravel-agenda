$(document).ready(function() {
    $.validator.setDefaults({
    highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
    }
});
$("#formAffilied").validate({
    messages: {

        email1: {
        required: "Preencha o campo Email 1!"
    },
    email1_tipo: {
        required: "Escolha o Tipo do Email!"
    },
    telefone1: {
        required: "Preencha o campo Telefone 1!"
    },
    telefone1_tipo: {
        required: "Escolha o Tipo do Telefone!",
    },
    cep: {
        required: "Preencha o campo CEP!"
    },
    uf: {
        required: "Preencha o campo UF!"
    },
    bairro: {
        required: "Preencha o campo Bairro!"
    },
    numero: {
        required: "Preencha o campo N°!"
    },
    cidade: {
        required: "Preencha o campo Cidade!"
    },
    endereco: {
        required: "Preencha o campo Endereço!"
    }
    },
    rules: {
    email1: "required",
    email1_tipo: "required",
    telefone1: "required",
    telefone1_tipo: "required",
    cep: "required",
    uf: "required",
    bairro: "required",
    numero: "required",
    cidade: "required",
    endereco: "required",
    },

});



$('#submitButton').click(function() {
    $("#formAffilied").valid();

});
});
