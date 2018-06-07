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

        #aceptados {
            color:white;
        }

        #conciertos .form-control-btn{

            margin-top: 0.2em;
        }

        #conciertos .localConciertoDiv {

            padding: 1em;
        }
    </style>
    <body>
        <div class="_childContainer divPadding10">
            <p><button type="button" id="dialogoConciertos" class="form-control-btn">Añadir conciertos</button></p>
            <script>
                $("#dialogoConciertos").click(function () {

                    VModal.show("Local_conciertos", "", {modalEffect: "vModalFadeIn-show", VModalId: "dialogo_dar_alta_concierto", modalTop: "40%"}, {
                        onDialogShow: function (ev) {

                            callJqueryWindowEvent(VInfo.CONCIERTO_INFO, ev);
                        },
                        onDialogClose: function (ev) {
                        }
                    });
                });
            </script>            
            <div id="conciertos">
            </div>

            <div id="aceptados">

            </div>
        </div>
        <script>

            cargarConciertos();
            cargarConciertosAceptados();

            onJqueryWindowCallbackEventOne(VEvent.PAGINA_LOCAL_CONCIERTO_ADDED, {

                callback: function (e) {
                    cargarConciertos();
                }
            });

            onJqueryWindowCallbackEventOne(VEvent.PAGINA_LOCAL_CONCIERTO_APROBADO, {

                callback: function (e) {
                    cargarConciertos();
                    cargarConciertosAceptados();
                }
            });

            function cargarConciertos() {
                var idlocal = Usuario.id;
                var query = `select concierto.idconcierto,usuario.nombre as Local,concierto.fecha,concierto.hora,genero.nombre as genero,concierto.estado,concierto.valoreconomico
from concierto join genero on concierto.genero = genero.idgenero
join usuario on usuario.idusuario = concierto.idlocal where concierto.idlocal = ${idlocal} and concierto.estado = 0`;
                var params = {
                    action: "RawQueryRet",
                    query: query};
                callAjaxBBDD(params, function (result) {
                    $("#conciertos").empty();
                    $.each(result.data, function (i, item) {

                        var ConsultarUsuarios = $("<button type='button' class='form-control-btn'>Consultar Inscritos</button>");
                        var divpadre = $("<div></div>");
                        $(divpadre).addClass("divBorderRadiusOrange");
                        $(divpadre).addClass("localConciertoDiv");
                        $(divpadre).append("<label  class='blockLabel'> Local: " + item.Local + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Fecha: " + item.fecha + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Hora: " + item.hora + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Genero: " + item.genero + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Valor Económico: " + item.valoreconomico + "</label><br>");
//                        $(divpadre).append("<label  class='blockLabel'>Pendiente de selección</label>");
                        var botonBaja = $("<button type='button' class='form-control-btn'>Dar de baja</button>");
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
                                    cargarConciertos();
                                });
                            });
                        });
                        $(divpadre).append(botonBaja);
                        $(divpadre).append(ConsultarUsuarios);
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
            }
            function cargarConciertosAceptados() {
                var idlocal = Usuario.id;
                var query = `select usuario.nombre,concierto.fecha,concierto.hora,genero.nombre as genero,comunidades.munucipio,comunidades.provincia from concierto 
                join usuario on concierto.idmusico = usuario.idusuario join genero on concierto.genero = genero.idgenero
join comunidades on concierto.ciudad = comunidades.idciudad where concierto.idlocal = ${idlocal} and concierto.estado = 1`;
                var params = {
                    action: "RawQueryRet",
                    query: query};
                callAjaxBBDD(params, function (result) {
                    $("#aceptados").empty();

                    if (result.data.length > 0) {
                        $("#aceptados").append("<br><h2>Conciertos Aceptados</h2>");
                    }
                    
                    $.each(result.data, function (i, item) {
                        var divpadre = $("<div></div>");
                        $(divpadre).addClass("divBorderRadiusOrange");
                        $(divpadre).append("<label  class='blockLabel'> Musico/Grupo: " + item.nombre + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Fecha: " + item.fecha + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Hora: " + item.hora + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Genero: " + item.genero + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Provincia: " + item.provincia + "</label>");
                        $(divpadre).append("<label  class='blockLabel'> Municipio: " + item.munucipio + "</label>");
                        $("#aceptados").append(divpadre);
                    });
                });
            }
        </script>
    </body>
</html>
