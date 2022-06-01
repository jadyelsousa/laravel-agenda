


    function verificar(){

        var texto=document.getElementById("ncompleto").value;

        for (letra of texto){
            if (!isNaN(texto)){
                alert("Não digite números");
                document.getElementById("ncompleto").value="";
                return;
            }
            letraspermitidas="ABCEDFGHIJKLMNOPQRSTUVXWYZ abcdefghijklmnopqrstuvxwyzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ"
            var ok=false;
            for (letra2 of letraspermitidas ){
                if (letra==letra2){
                    ok=true;
                }
            }
            if (!ok){
                alert("Não digite caracteres que não sejam letras ou espaços");
                document.getElementById("ncompleto").value="";
                return;
            }
        }
}

function verificar2(){

    var texto=document.getElementById("ninstituidor").value;
    
    for (letra of texto){
        if (!isNaN(texto)){
            alert("Não digite números");
            document.getElementById("ninstituidor").value="";
            return;
        }
        letraspermitidas="ABCEDFGHIJKLMNOPQRSTUVXWYZ abcdefghijklmnopqrstuvxwyzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ"
        var ok=false;
        for (letra2 of letraspermitidas ){
            if (letra==letra2){
                ok=true;
            }
        }
        if (!ok){
            alert("Não digite caracteres que não sejam letras ou espaços");
            document.getElementById("ninstituidor").value="";
            return;
        }
    }
}

    function _cpf(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    if (cpf.length != 11 ||
    cpf == "00000000000" ||
    cpf == "11111111111" ||
    cpf == "22222222222" ||
    cpf == "33333333333" ||
    cpf == "44444444444" ||
    cpf == "55555555555" ||
    cpf == "66666666666" ||
    cpf == "77777777777" ||
    cpf == "88888888888" ||
    cpf == "99999999999")
    return false;
    add = 0;
    for (i = 0; i < 9; i++)
    add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
    rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
    return false;
    add = 0;
    for (i = 0; i < 10; i++)
    add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
    rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
    return false;
    return true;
    }

    function validarCPF(el){
        if( !_cpf(el.value) ){
        alert("CPF inválido!");
        // apaga o valor
        el.value = "";
        }
        else{
            getDados();
        }
        }

    // $("#ncompleto").on("input", function(){
    //     var regexp = /[a-zA-Z\u00C0-\u00FF ]+/i;
    //     if(this.value.match(regexp)){
    //         $(this).val(this.value.replace(regexp,' '));
    //     }
    //     });

    $("body").on("submit", "form", function() {
        $(this).submit(function() {
            return false;
        });
        return true;
    });

    $(function(){
                $("[name='terms']").change(function(){
                    var countSelected = $("input[name=terms]:checked").length;
                    var $btnEnviar = $('#submitButton');
                    $btnEnviar.prop("disabled", countSelected == 0);
                    $btnEnviar.val('Enviar');
                });
            });


    jQuery(function($) {

        $("#cpf").mask("000.000.000-00");
    });

    $('#telefone').mask('(00) 0000-00009');
    $('#telefone').blur(function(event) {
        if ($(this).val().length == 15) {
            $('#telefone').mask('(00) 00000-0009');
        } else {
            $('#telefone').mask('(00) 0000-00009');
        }
    });



    $('#cep').on('blur', function() {

        if ($.trim($("#cep").val()) != "") {
            var cep = $("#cep").val().replace("-", "").replace(".", "");
            $("#mensagem").html('(Aguarde, consultando CEP ...)');
            var url = 'https://viacep.com.br/ws/'+cep+'/json/unicode/';
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    var result = JSON.parse(this.responseText);

                    if(result.erro != true){
                        console.log(result.erro);
                        console.log(result);
                        $("#endereco").val(unescape(result.logradouro));
                        $("#bairro").val(unescape(result.bairro));
                        $("#cidade").val(unescape(result.localidade));
                        $("#uf").val(unescape(result.uf));
                        $("#numero").focus();
                        $("#mensagem").html('');
                    }else{
                        $("#mensagem").html('(CEP inválido!)');
                    }
                }
            }
            };
            xhttp.open('GET', url, true);
            xhttp.send();
        }
    });

    $("#cep").inputmask({
        mask: ["99999-999", ],
        keepStatic: true
    });



