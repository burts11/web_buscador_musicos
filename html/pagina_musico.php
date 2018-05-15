<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <style>
        #musico {

            position: relative;
            display: inline-block;
            width: 100%;
            height: 100%;
            background-color: orange;
        }
    </style>
    <body>
        <div class="_childContainer">
            <div id="musico">

            </div>
        </div>
        <script>
            var idmusico = Usuario.id;
            var genero = `select generoID from musico where idmusico = ${idmusico}`;


            var params = {
                action: "RawQueryRet",
                query: genero};
            callAjaxBBDD(params, function (result) {
                console.log(result);
                var query = `select * from concierto inner join usuario on concierto.idlocal = usuario.idusuario where genero = ${result.data[0].generoID}`;
                var params = {
                    action: "RawQueryRet",
                    query: query};
                callAjaxBBDD(params, function (result) {
                    $("#musico").empty();

                    console.log("Conciertos de musico");
                    console.log(result);

                    $.each(result.data, function (i, item) {
                        var divpadre = $("<div></div>");
                        divpadre.addClass("musico");
                        $(divpadre).append("<label class='blockLabel'>Nombre del local: " + item.nombre + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Fecha: " + item.fecha + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Hora: " + item.hora + "</label>");
                        $(divpadre).append("<label class='blockLabel'>Valor Economico: " + item.valoreconomico + "</label>");
                        var boton = $("<button type='button'>Inscribete</button>");
                        var boton_pendiente = $("<button type='button'>Pendiente</button>");
                        $(divpadre).append(boton);

                        $(boton).click(function () {
                            var usuario = Usuario.id;
                            var query = `insert into inscripcion values('${usuario}',1,'${item.idconcierto}')`;
                            var params = {
                                action: "RawQueryRet",
                                query: query};

                            callAjaxBBDD(params, function (result) {
                                console.log(result);

                                $(boton).hide();
                                $(boton_pendiente).show();
                                $(divpadre).append(boton_pendiente);
                            });
                        });

                        var query = `select estado, idconcierto from inscripcion  where idmusico  = ${idmusico} AND idconcierto = ${item.idconcierto}`;
                        var params = {
                            action: "RawQueryRet",
                            query: query};

                        callAjaxBBDD(params, function (result) {

                            var estadoConcierto = parseInt(result.data[0].estado);
                            if (estadoConcierto === 0) {
                                $(divpadre).append(boton_pendiente);
                                $(boton_pendiente).text("Denegado");
                                $(boton).hide();
                                 $(boton_pendiente).show();
                            } else if (estadoConcierto === 2) {
                                $(divpadre).append(boton_pendiente);
                                $(boton_pendiente).text("Aceptado");
                                $(boton).hide();
                                 $(boton_pendiente).show();
                            } else if (estadoConcierto === 1) {
                                $(divpadre).append(boton_pendiente);

                                $(boton_pendiente).text("Pendiente");
                                $(boton).hide();
                                 $(boton_pendiente).show();
                                $(boton_pendiente).click(function () {
                                    var usuario = Usuario.id;
                                    var query = `delete from inscripcion where idmusico = ${usuario} and idconcierto = ${item.idconcierto}`;
                                    var params = {
                                        action: "RawQueryRet",
                                        query: query};

                                    callAjaxBBDD(params, function (result) {
                                        console.log(result);
                                        $(boton_pendiente).hide();
                                        $(boton).show();

                                    });
                                });
                            }
                        });

                        $("#musico").append(divpadre);
                    });

                });
            });
        </script>
    </body>
</html>
