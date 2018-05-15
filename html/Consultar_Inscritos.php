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
            background-color: rgba(255,255,255,0.5);
            border-radius: 4px;
            padding: 4px;
            margin-bottom: 4px;
        }
    </style>
    <body>
        <h3>Inscritos en este concierto</h3>

        <div id="musicos"></div>

    </body>

    <script>
        onJqueryWindowCallbackEventOne(VInfo.CONSULTAR, {

            callback: function (e) {

                var idconcierto = e.json.vparams.idconcierto;
                var query = `select usuario.idusuario,usuario.nombre,comunidades.provincia,comunidades.munucipio from inscripcion 
join concierto on inscripcion.idconcierto = concierto.idconcierto 
join usuario on inscripcion.idmusico = usuario.idusuario
join comunidades on usuario.ciudad = comunidades.idciudad
where inscripcion.idconcierto =${idconcierto}`;
                var params = {
                    action: "RawQueryRet",
                    query: query};
                callAjaxBBDD(params, function (result) {
                    console.log(result);
                    $.each(result.data, function (i, item) {
                        var aceptar = $("<button type='button' class='form-control-btn'>ACEPTAR</button>");
                        var divpadre = $("<div></div>");
                        $(divpadre).addClass("div_inscritos");
                        $(divpadre).append("<label class='blockLabel'>Nombre: " + item.nombre + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Provincia: " + item.provincia + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Municipio: " + item.munucipio + "</label>");
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
                                    console.log(result);
                                    VToast.mostrarMensaje("Musico aceptado");
                                    console.log(result);
                                    
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
