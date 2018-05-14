<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/musico.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        .div_concierto {
            display: inline-block;
            margin-right: 150px;
        }
        #insc {
            color:white;
        }
    </style>
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

            <div id="insc"></div>
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


                $("#conciertos").empty();

                $.each(result.data, function (i, item) {
                    var divpadre = $("<div></div>");
                    $(divpadre).addClass("div_concierto");
                    $(divpadre).append("<label  class='blockLabel'> Local: " + item.Local + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Fecha: " + item.fecha + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Hora: " + item.hora + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Genero: " + item.genero + "</label>");
                    if (item.estado === 0) {
                        $(divpadre).append("<label  class='blockLabel'> Estado: Libre</label>");
                    } else {
                        $(divpadre).append("<label  class='blockLabel'> Estado: Ocupado</label>");

                    }

                    var botonBaja = $("<button type='button' class='form-control-btn'>DAR DE BAJA</button>");

                    $(botonBaja).click(function () {
                        var id = item.idconcierto;
                        var query = `delete from concierto where idconcierto = ${id}`;

                        var params = {
                            action: "RawQueryRet",
                            query: query};
                        callAjaxBBDD(params, function (result) {

                        });
                    });
                    $(divpadre).append(botonBaja);
                    $(divpadre).append("<br></br>");
                    $("#conciertos").append(divpadre);

                });


            });
        </script>


        <script>
            var usuario = Usuario.id;
            var query = `select concierto.fecha,concierto.hora,genero.nombre as Genero,concierto.valoreconomico,concierto.idconcierto 
from concierto 
join genero on concierto.genero = genero.idgenero 
join usuario on concierto.idlocal = usuario.idusuario
join inscripcion on concierto.idconcierto = inscripcion.idconcierto where inscripcion.estado = 1 and concierto.idlocal = ${usuario} group by inscripcion.idconcierto`;

            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                $("#insc").empty();
                $("#insc").append("<h2>CONCIERTOS PENDIENTES</h2><br>");
                $.each(result.data, function (i, item) {
                    var ConsultarUsuarios = $("<button type='button' class='form-control-btn'>Consultar Inscritos</button>");
                    var divpadre = $("<div></div>");
                    $(divpadre).addClass("div_insc");
                    $("#insc").append("<label class='blockLabel'>Fecha: " + item.fecha + "</label>");
                    $("#insc").append("<label class='blockLabel'>Hora: " + item.hora + "</label>");
                    $("#insc").append("<label class='blockLabel'>Genero: " + item.Genero + "</label>");
                    $("#insc").append("<label class='blockLabel'>Valor Economico: " + item.valoreconomico + "</label>");
                    $("#insc").append(ConsultarUsuarios);
                    $(divpadre).append("<br></br>");
                    $("#insc").append(divpadre);
                    $(ConsultarUsuarios).click(function () {

                        VModal.show("Consultar_Inscritos", "", {modalEffect: "vModalFadeIn-show", VModalId: "Consultar_Inscritos", CustomPadding: "true",
                            padding: "0px", modalTop: "40%"}, {
                            onDialogShow: function (ev) {
                                ev["vparams"]["idconcierto"] = item.idconcierto;
                                callJqueryWindowEvent(VInfo.CONSULTAR, ev);
                            },
                            onDialogClose: function (ev) {
                            }
                        });
                    });
                });
            });

//               
        </script>
    </body>
</html>
