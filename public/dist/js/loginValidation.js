$(function () {

    $.validator.setDefaults({

    });
    $('#quickForm').validate({
        rules: {
            cpf: {
                required: true,
                minlength: 11
            },
            password: {
                required: true,
                minlength: 5
            },
        },
        errorElement: 'x-input',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-control').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });
});
