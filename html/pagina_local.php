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
            var query = `select concierto.idconcierto,usuario.nombre as Local,concierto.fecha,concierto.hora,genero.nombre as genero,concierto.estado,concierto.valoreconomico
from concierto join genero on concierto.genero = genero.idgenero
join usuario on usuario.idusuario = concierto.idlocal where concierto.idlocal = ${idlocal}`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                $("#conciertos").empty();

                $.each(result.data, function (i, item) {
                    
                    var query = `select usuario.nombre from inscripcion join usuario on inscripcion.idmusico = usuario.idusuario where inscripcion.estado = 2 and idconcierto = ${item.idconcierto}`;
                     var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                
                               console.log("inscripciomnnnnnn");

                console.log(result);
                    var ConsultarUsuarios = $("<button type='button' class='form-control-btn'>Consultar Inscritos</button>");

                    var divpadre = $("<div></div>");
                    $(divpadre).addClass("div_concierto");
                    $(divpadre).append("<label  class='blockLabel'> Local: " + item.Local + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Fecha: " + item.fecha + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Hora: " + item.hora + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Genero: " + item.genero + "</label>");
                    $(divpadre).append("<label  class='blockLabel'> Valor Economico: " + item.valoreconomico + "</label>");
                    if (item.estado === 0) {
                        $(divpadre).append("<label  class='blockLabel'>Pendiente de selección</label>");
                    } else if (item.estado === 1){
                        $(divpadre).append("<label  class='blockLabel'>Musico aceptado: "+result.data[0].nombre+" </label>");

                    }

                    var botonBaja = $("<button type='button' class='form-control-btn'>DAR DE BAJA</button>");
                  

                    $(botonBaja).click(function () {
                        var id = item.idconcierto;
                        var query = `delete from concierto where idconcierto = ${id}`;

                        var params = {
                            action: "RawQueryRet",
                            query: query};
                        callAjaxBBDD(params, function (result) {
                            var query = `delete from inscripcion where idconcierto = ${id}`;
                              var params = {
                            action: "RawQueryRet",
                            query: query};
                         callAjaxBBDD(params, function (result) {
                             VToast.mostrarMensaje("Concierto dado de baja");
                                    
                                    e.json.vparams.close();
                                });
                        });
                        
                    });
                    
                     $(divpadre).append(botonBaja);
                     $(divpadre).append(ConsultarUsuarios);
                    $(divpadre).append("<br></br>");
                    $("#conciertos").append(divpadre);

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


            });
        </script>


        
    </body>
</html>
