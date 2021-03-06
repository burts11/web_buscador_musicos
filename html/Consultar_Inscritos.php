<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
        .div_inscritos {
            background-color: rgba(255,255,255,0.1);
            border-radius: 4px;
            padding: 4px;
            margin-bottom: 4px;
        }

        .div_inscritos{

            padding: 10px;
        }
    </style>
    <body>
        <h3>Inscritos en este concierto</h3>
        <h4 id="msg">No hay ningun músico inscrito</h4>


        <div id="musicos"></div>

    </body>

    <script>
        onJqueryWindowCallbackEventOne(VInfo.CONSULTAR, {

            callback: function (e) {
                var idconcierto = e.json.vparams.idconcierto;
                var query = `select musico.numerocomponentes, usuario.idusuario,usuario.nombre,comunidades.provincia,comunidades.munucipio from inscripcion 
join concierto on inscripcion.idconcierto = concierto.idconcierto 
join usuario on inscripcion.idmusico = usuario.idusuario
join comunidades on usuario.ciudad = comunidades.idciudad join musico on musico.idmusico = usuario.idusuario
where inscripcion.idconcierto =${idconcierto}`;
                var params = {
                    action: "RawQueryRet",
                    query: query};
                callAjaxBBDD(params, function (result) {
                    if (result.data.length != 0) {
                        $("#msg").hide();
                    }
                    $.each(result.data, function (i, item) {
                        var aceptar = $("<p><button type='button' class='form-control-btn'>Aceptar</button></p>");
                        var divpadre = $("<div></div>");
                        $(divpadre).addClass("div_inscritos");
                        $(divpadre).append("<label class='blockLabel'>Nombre: " + item.nombre + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Provincia: " + item.provincia + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Municipio: " + item.munucipio + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Número de componentes: " + item.numerocomponentes + "</label>");
                        $(divpadre).append(aceptar);
                        $("#musicos").append(divpadre);

                        $(aceptar).click(function () {
                            var query = `update inscripcion set estado = 2 where idmusico = ${item.idusuario} and idconcierto = ${idconcierto}`;
                            var params = {
                                action: "RawQueryRet",
                                query: query};
                            callAjaxBBDD(params, function (result) {
                                console.log(result);
                                var query = `update inscripcion set estado = 0 where idmusico <> ${item.idusuario} and idconcierto = ${idconcierto}`;
                                var params = {
                                    action: "RawQueryRet",
                                    query: query};
                                callAjaxBBDD(params, function (result) {
                                    var query = `update concierto set estado = 1,idmusico = ${item.idusuario} where idconcierto = ${idconcierto}`;
                                    var params = {
                                        action: "RawQueryRet",
                                        query: query};
                                    callAjaxBBDD(params, function (result) {
                                        VToast.mostrarMensaje("Musico aceptado");
                                        callJqueryWindowEvent(VEvent.PAGINA_LOCAL_CONCIERTO_APROBADO, {});
                                        e.json.vparams.close();
                                    });
                                });
                            });
                        });
                    });

                    e.json.vparams.onDialogContentLoaded();
                });

            }
        });
    </script>
</html>
