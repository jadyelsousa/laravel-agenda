
            $('#rename').click(function(e) {
                $(this).hide();
                document.getElementById("acervo_name").disabled = false;
                $('#save').show();
                $('#cancel').show();
            });

            $('#cancel').click(function(e) {
                $(this).hide();
                var input = document.getElementById("acervo_name");
                input.disabled = true;
                var text = input.getAttribute('data-old');
                input.value = text;
                $('#save').hide();
                $('#rename').show();
            });

            // $('#save').click(function(e) {
            //     // do your save
            //     // once saved, hide btn
            //     $(this).hide();
            // });



            $(document).on('click', '.addSubPasta', function() {
                var divID = $(this).attr('data-div');
                $('#idDivisao').val(divID);
                $('#modal-xl-2').modal('show');
            });



            $(document).on('click', '.deleteFolder', function() {
                var divID = $(this).attr('data-div');
                $('#inputDivisao').val(divID);
                $('#mdlExcluirFolder').modal('show');
            });



            $(document).on('click', '.deleteSubFolder', function() {
                var subId = $(this).attr('data-sub');;
                $('#inputSub').val(subId);
                $('#mdlExcluirSubFolder').modal('show');
            });



            $(document).on('click', '.deleteDocument', function() {
                var docId = $(this).attr('data-doc');
                var type = $(this).attr('data-type');

                $('#idArquivo').val(docId);
                $('#typeFolder').val(type);

                $('#mdlExcluirdocumento').modal('show');
            });



            const list = document.querySelectorAll('.list');

            function accordion(e) {
                e.stopPropagation();
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                } else if (this.parentElement.parentElement.classList.contains('active')) {
                    this.classList.add('active');
                } else {
                    for (i = 0; i < list.length; i++) {
                        list[i].classList.remove('active');
                    }
                    this.classList.add('active');
                }
            }
            for (i = 0; i < list.length; i++) {
                list[i].addEventListener('click', accordion);
            }



            $("body").on("click", "a", function(e) {
                var target = $(this).attr("target");
                if (target == '_blank') {
                    $("#meuIFrame").attr('src', $(this).attr("href"));
                    return false;
                }
            });



            var formID = document.getElementById("formID");
            var send = $("#send");

            $(formID).submit(function(event) {
                if (formID.checkValidity()) {
                    send.attr('disabled', 'disabled');
                }
            });

            $(document).ready(function() {
                $('.accordion__header').click(function() {

                    $(".accordion__body").not($(this).next()).slideUp(400);
                    $(this).next().slideToggle(400);

                    $(".accordion__item").not($(this).closest(".accordion__item")).removeClass(
                        "open-accordion");
                    $(this).closest(".accordion__item").toggleClass("open-accordion");
                });
            });



$(document).ready(function () {
    $("#add_row").on("click", function () {
        // Dynamic Rows Code

        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function () {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;

        var tr = $("<tr></tr>", {
            id: "addr" + newid,
            "data-id": newid
        });

        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function () {
            var td;
            var cur_td = $(this);

            var children = cur_td.children();

            // add new td and element if it has a nane
            if ($(this).data("name") !== undefined) {
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });

                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name[]") /**+ newid */);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });

        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */

        // add the new row
        $(tr).appendTo($('#tab_logic'));

        $(tr).find("td button.row-remove").on("click", function () {
            $(this).closest("tr").remove();
        });
    });




    // Sortable Code
    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();

        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });

        return $helper;
    };

    $(".table-sortable tbody").sortable({
        helper: fixHelperModified
    }).disableSelection();

    $(".table-sortable thead").disableSelection();

    $("#add_row").trigger("click");
});


$(document).ready(function () {
    $("#add_row2").on("click", function () {
        // Dynamic Rows Code

        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic2 tr"), function () {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;

        var tr = $("<tr></tr>", {
            id: "addr" + newid,
            "data-id": newid
        });

        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic2 tbody tr:nth(0) td"), function () {
            var td;
            var cur_td = $(this);
            var children = cur_td.children();
            // add new td and element if it has a nane
            if ($(this).data("name") !== undefined) {
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });

                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name[]") /**+ newid */);
                c.appendTo($(td));
                    if (children[1]) {
                        var d = $(cur_td).find($(children[1]).prop('tagName')).clone().val("").text("Nenhum arquivo selecionado");
                        d.appendTo($(td));
                    }
                td.appendTo($(tr));

            } else {
                td = $("<td></td>", {
                    'text': $('#tab_logic2 tr').length
                }).appendTo($(tr));
            }
        });

        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */

        // add the new row
        $(tr).appendTo($('#tab_logic2'));

        $(tr).find("td button.row-remove").on("click", function () {
            $(this).closest("tr").remove();
        });
    });




    // Sortable Code
    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();

        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });

        return $helper;
    };

    $(".table-sortable tbody").sortable({
        helper: fixHelperModified
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row2").trigger("click");
});

$(document).ready(function () {
    $("#add_row3").on("click", function () {
        // Dynamic Rows Code

        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic3 tr"), function () {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;

        var tr = $("<tr></tr>", {
            id: "addr" + newid,
            "data-id": newid
        });

        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic3 tbody tr:nth(0) td"), function () {
            var td;
            var cur_td = $(this);

            var children = cur_td.children();

            // add new td and element if it has a nane
            if ($(this).data("name") !== undefined) {
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });

                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name[]") /**+ newid */);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                td = $("<td></td>", {
                    'text': $('#tab_logic3 tr').length
                }).appendTo($(tr));
            }
        });

        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */

        // add the new row
        $(tr).appendTo($('#tab_logic3'));

        $(tr).find("td button.row-remove").on("click", function () {
            $(this).closest("tr").remove();
        });
    });




    // Sortable Code
    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();

        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });

        return $helper;
    };

    $(".table-sortable tbody").sortable({
        helper: fixHelperModified
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row3").trigger("click");
});



$(document).ready(function () {
    $("#add_row4").on("click", function () {
        // Dynamic Rows Code

        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic4 tr"), function () {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;

        var tr = $("<tr></tr>", {
            id: "addr" + newid,
            "data-id": newid
        });

        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic4 tbody tr:nth(0) td"), function () {
            var td;
            var cur_td = $(this);

            var children = cur_td.children();

            // add new td and element if it has a nane
            if ($(this).data("name") !== undefined) {
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });

                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name[]") /**+ newid */);
                c.appendTo($(td));
                    if (children[1]) {
                        var d = $(cur_td).find($(children[1]).prop('tagName')).clone().val("").text("Nenhum arquivo selecionado");
                        d.appendTo($(td));
                    }
                td.appendTo($(tr));
            } else {
                td = $("<td></td>", {
                    'text': $('#tab_logic4 tr').length
                }).appendTo($(tr));
            }
        });

        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */

        // add the new row
        $(tr).appendTo($('#tab_logic4'));

        $(tr).find("td button.row-remove").on("click", function () {
            $(this).closest("tr").remove();
        });
    });




    // Sortable Code
    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();

        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });

        return $helper;
    };

    $(".table-sortable tbody").sortable({
        helper: fixHelperModified
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row4").trigger("click");
});






