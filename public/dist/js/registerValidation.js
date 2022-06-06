
// Código jquery para validação de front end do formuluário de novo usuário
$(function() {

    $('#registerForm').validate({
        rules: {

            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                minlength: 8,
                equalTo : "#password"
            },

        },
        messages: {
            email: {
                required: "Campo obrigatório",
                email: "Insira um email válido."
            },
            name: {
                required: "Campo obrigatório",
            },
            password: {
                required: "Campo obrigatório"
            },
            password_confirmation: {
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


