$(document).ready(function() {
    $("#corrige").click(function(event) {
        event.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        var idTest = $("input[name='test_id']").val();
        var idCurso = $("input[name='curso_id']").val();
        var cursoNombre = $("input[name='curso_nombre']").val();
        var nombreAlumna = $("input[name='alumna_id']").val();
        var idTema = $("input[name='tema_id']").val();
        var urlRedirige = `/${cursoNombre}/${idTema}`;
        console.log("idTest: " + idTest);
        console.log("idAlumna: " + nombreAlumna);
        var aciertos = 0;
        var fallos = 0;
        var nota = 0;
        var notaFinal;

        var preguntaRadioButtons = document.getElementsByTagName("input");
        var preguntas = document.getElementsByClassName("preguntas");
        var totalPreguntas = preguntas.length;

        /* console.log(preguntaRadioButtons); */

        for (var i = 0; i < preguntaRadioButtons.length; i++) {
            /* console.log(preguntaRadioButtons[i].checked); */
            if (preguntaRadioButtons[i].checked) {
                if (preguntaRadioButtons[i].value == "S") {
                    console.log(preguntaRadioButtons[i]);
                    aciertos++;
                    nota = nota + 1;
                } else {
                    console.log(preguntaRadioButtons[i]);
                    fallos++;
                }
            }
        }

        if(nota == 0) {
            notaFinal = 0;
        } else {
            notaFinal = (nota * 10)/totalPreguntas;
        }
        
        console.log("nota final: " + notaFinal);
        console.log("Aciertos: " + aciertos);
        console.log("Fallos: " + fallos);
        console.log("nota: " + nota);

        urlStore = $("#formulario").attr("action");
        
        console.log(urlStore);
        
        $.ajax({
            type: "POST",
            url: urlStore,
            data: {
                nota: notaFinal,
                test: idTest,
                curso: idCurso,
                tema: idTema,
                alumna: nombreAlumna
            },
            dataType: "json",
            success: function(data) {
                console.log("success");
                console.log(data);
                console.log("nota" + data[0].nota);
                console.log("url" + data[0].url);

                if (data[0].success == true) {
                    /* $('#contenidoAlumna').html(data[0].html); */
                    swal({
                        text: `Has sacado un ${data[0].nota}`,
                        buttons: "vale"
                    }).then(value => {
                        if (value) {
                            window.location.replace(data[0].url);
                        }
                    });
                } else {
                    console.log("Algo no fue bien.");
                }
            },
            error: function(data) {
                console.log(data);
                swal({
                    text: `¡Ya hiciste este examen!`,
                    buttons: "vale"
                }).then(value => {
                    if (value) {
                        window.location.replace(urlRedirige);
                    }
                });
            }
        });
    });
});
