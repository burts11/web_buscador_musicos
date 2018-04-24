<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/musico.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="_childContainer divPadding10">
            <button type="button" id="dialogoConciertos">añadee</button>
            <script>

                $("#dialogoConciertos").click(function () {

                    VModal.show("Local_conciertos", "", {modalEffect: "vModalFadeIn-show", VModalId: "dialogo_dar_alta_concierto"}, {
                        onDialogShow: function (ev) {

                            callJqueryWindowEvent(VInfo.CONCIERTO_INFO, ev);
                        },
                        onDialogClose: function (ev) {
                        }
                    });
                });
            </script>            
            <br>
            <div id="conciertos">
            </div>
        </div>
        <script>

            $("#conciertos").empty();

            var idlocal = Usuario.id;
            var query = `select concierto.idconcierto,usuario.nombre as Local,concierto.fecha,concierto.hora,genero.nombre as genero,concierto.estado
from concierto join genero on concierto.genero = genero.idgenero
join usuario on usuario.idusuario = concierto.idlocal where concierto.idlocal = ${idlocal}`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                console.log(result);

                $("#conciertos").empty();

                $.each(result.data, function (i, item) {
                    var divpadre = $("<div></div>");
                    $(divpadre).append("<label  class='blockLabel'> Local: " + item.Local + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Fecha: " + item.fecha + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Hora: " + item.hora + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Genero: " + item.genero + "</label>");
                    if (item.estado === 0) {
                        $(divpadre).append("<label  class='blockLabel'> Estado: Libre</label>");
                    } else {
                        $(divpadre).append("<label  class='blockLabel'> Estado: Ocupado</label>");

                    }
                    var botonBaja = $("<button type='button'>Dar de baja el concierto</button>");

                    $(botonBaja).click(function () {
                        var id = item.idconcierto;
                        var query = `delete from concierto where idconcierto = ${id}`;

                        var params = {
                            action: "RawQueryRet",
                            query: query};
                        callAjaxBBDD(params, function (result) {
                            console.log(result);
                        });
                    });
                    $(divpadre).append(botonBaja);
                    $(divpadre).append("<br></br>");
                    $("#conciertos").append(divpadre);

                });


            });
        </script>
    </body>
</html>
