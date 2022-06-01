
$(document).on('click', '.modalEdit', function() {

    $("#modalBody").html("");
    var newId = 0;
    var div = $(this).attr('data-doc');
    var folderName = $(this).attr('data-folder');
    $('#folderName').val(folderName);
    div = JSON.parse(div);
    var myBody = document.getElementById("modalBody");
    div.map( divisao => {
        var tr = document.createElement('TR');
        tr.id = 'addr'+newId;
        tr.setAttribute("class","hidden");
        tr.setAttribute("data-id",newId);
        var inputHidden = document.createElement('input');
        inputHidden.setAttribute("type","hidden");
        inputHidden.setAttribute("name","id[]");
        inputHidden.setAttribute("value", divisao.id_documento);
        tr.appendChild(inputHidden);
        var inputHidden = document.createElement('input');
        inputHidden.setAttribute("type","hidden");
        inputHidden.setAttribute("name","divisao");
        inputHidden.setAttribute("value", divisao.id_divisao);
        tr.appendChild(inputHidden);
        var tdTitulo = document.createElement('TD');
        tdTitulo.setAttribute("data-name","titulo")
        var inputTitulo = document.createElement('input');
        inputTitulo.setAttribute("type", "text");
        inputTitulo.setAttribute("name", "titulo[]");
        inputTitulo.setAttribute("value", divisao.documento);
        inputTitulo.setAttribute("placeholder", "Nome");
        inputTitulo.setAttribute("class", "form-control");
        tdTitulo.appendChild(inputTitulo);
        tr.appendChild(tdTitulo);
        var tdDoc = document.createElement('TD');
        tdDoc.setAttribute("data-name","link_doc")
        var inputDoc = document.createElement('input');
        var label = document.createElement('label');
        label.setAttribute("for","file");
        label.setAttribute("class","selArquivo");
        label.setAttribute("style","padding: 8px 0 0 0;font-weight: 500;");
        fileName = divisao.arquivo.split("/").pop();
        if(fileName.length > 30){
            var inicio = fileName.substr(0,12);
            var final = fileName.substr(-13);
            label.innerHTML = inicio+"..."+final;
        }else{
            label.innerHTML = fileName;
        }
        inputDoc.setAttribute("type","file");
        inputDoc.setAttribute("name","link_doc[]");
        inputDoc.setAttribute("value",divisao.arquivo);
        inputDoc.setAttribute("class","form-control fileEdit");
        inputDoc.setAttribute("onchange","readURL(this);");
        inputDoc.setAttribute("accept",".pdf,.docx,.doc,.pptx,.ppt,.xls,.xlsx");
        inputDoc.setAttribute("style","border: none; color: transparent;float: left;max-width: 144px;");
        tdDoc.appendChild(inputDoc);
        tdDoc.appendChild(label);
        tr.appendChild(tdDoc);
        var tdRef = document.createElement('TD');
        tdRef.setAttribute("data-name","ref");
        var inputRef = document.createElement('input');
        inputRef.setAttribute("type","text");
        inputRef.setAttribute("name","ref[]");
        inputRef.setAttribute("value",divisao.referencia);
        inputRef.setAttribute("placeholder","Referências");
        inputRef.setAttribute("class","form-control");
        tdRef.appendChild(inputRef);
        tr.appendChild(tdRef);
        myBody.appendChild(tr);
        newId++;
    });

});

$(document).on('click', '.modalSubEdit', function() {

    $("#modalSubBody").html("");

    var newId = 0;
    var div = $(this).attr('data-doc');
    var folderName = $(this).attr('data-folder');
    $('#subfolderName').val(folderName);
    div = JSON.parse(div);
    console.log(div);
    var myBody = document.getElementById("modalSubBody");



    div.map( divisao => {
        var tr = document.createElement('TR');
        tr.id = 'addr'+newId;
        tr.setAttribute("class","hidden");
        tr.setAttribute("data-id",newId);
        var inputHidden = document.createElement('input');
        inputHidden.setAttribute("type","hidden");
        inputHidden.setAttribute("name","id[]");
        inputHidden.setAttribute("value", divisao.id_documento);
        tr.appendChild(inputHidden);

        var inputHidden = document.createElement('input');
        inputHidden.setAttribute("type","hidden");
        inputHidden.setAttribute("name","divisao");
        inputHidden.setAttribute("value", divisao.id_sub_divisao);
        tr.appendChild(inputHidden);

        var tdTitulo = document.createElement('TD');
        tdTitulo.setAttribute("data-name","titulo")
        var inputTitulo = document.createElement('input');
        inputTitulo.setAttribute("type", "text");
        inputTitulo.setAttribute("name", "titulo[]");
        inputTitulo.setAttribute("value", divisao.documento);
        inputTitulo.setAttribute("placeholder", "Nome");
        inputTitulo.setAttribute("class", "form-control");
        tdTitulo.appendChild(inputTitulo);
        tr.appendChild(tdTitulo);
        var tdDoc = document.createElement('TD');
        tdDoc.setAttribute("data-name","link_doc")
        var inputDoc = document.createElement('input');
        var label = document.createElement('label');
        label.setAttribute("for","file");
        label.setAttribute("class","selArquivo");
        label.setAttribute("style","padding: 8px 0 0 0;font-weight: 500;");
        fileName = divisao.arquivo.split("/").pop();
        if(fileName.length > 30){
            var inicio = fileName.substr(0,12);
            var final = fileName.substr(-13);
            label.innerHTML = inicio+"..."+final;
        }else{
            label.innerHTML = fileName;
        }
        inputDoc.setAttribute("type","file");
        inputDoc.setAttribute("name","link_doc[]");
        inputDoc.setAttribute("value",divisao.arquivo);
        inputDoc.setAttribute("class","form-control fileEdit");
        inputDoc.setAttribute("onchange","readURL(this);");
        inputDoc.setAttribute("accept",".pdf,.docx,.doc,.pptx,.ppt,.xls,.xlsx");
        inputDoc.setAttribute("style","border: none; color: transparent;float: left;max-width: 144px;");
        tdDoc.appendChild(inputDoc);
        tdDoc.appendChild(label);
        tr.appendChild(tdDoc);
        var tdRef = document.createElement('TD');
        tdRef.setAttribute("data-name","ref");
        var inputRef = document.createElement('input');
        inputRef.setAttribute("type","text");
        inputRef.setAttribute("name","ref[]");
        inputRef.setAttribute("value",divisao.referencia);
        inputRef.setAttribute("placeholder","Referências");
        inputRef.setAttribute("class","form-control");
        tdRef.appendChild(inputRef);
        tr.appendChild(tdRef);
        myBody.appendChild(tr);
        newId++;
    });

});


function readURL(input) {
    if (input.files[0]) {
        label = input.nextElementSibling;
        newName = input.files[0].name;
        console.log(newName.length);
        if(newName.length > 30){
            var inicio = newName.substr(0,12);
            var final = newName.substr(-13);
            label.innerHTML = inicio+"..."+final;
        }else{
            label.innerHTML = newName;
        }
        }
    }

