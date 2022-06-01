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

    siape_status: {
        required: "Preencha o campo Status!"
    },
    siape_matricula: {
        required: "Preencha o campo Siape!"
    },
    ncompleto: {
        required: "Preencha com seu Nome Completo!"
    },
    cpf: {
        required: "Preencha o campo CPF!",
        minlength: "Preencha com 11 caracteres!"
    },
    dtnasc: {
        required: "Preencha a sua data de nascimento!"
    },
    email: {
        required: "Preencha o campo Email!",
        email: "Preencha com um endereço de email válido!"
    },
    telefone: {
        required: "Preencha o número de telefone!"
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
    terms: {
        required: "Marque aqui se concorda com os termos."
    },
    endereco: {
        required: "Preencha o campo Endereço!"
    }
    },
    rules: {
    siape_status: "required",
    siape_matricula: "required",
    ncompleto: "required",
    dtnasc: "required",
    cpf: {
    required: true,
    minlength: 14,
    },
    email: { // compound rule
        required: true,
        email: true,
    },
    telefone: "required",
    cep: "required",
    uf: "required",
    bairro: "required",
    numero: "required",
    cidade: "required",
    endereco: "required",
    terms: "required",
    },

});



$('#submitButton').click(function() {
    $("#formAffilied").valid();

});
});
