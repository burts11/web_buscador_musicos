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
                        $(divpadre).append(boton);

                        $(boton).click(function () {
                            var usuario = Usuario.id;
                            var query = `insert into inscripcion values('${usuario}',1,'${item.idconcierto}')`;
                            var params = {
                                action: "RawQueryRet",
                                query: query};

                            callAjaxBBDD(params, function (result) {
                                console.log(result);

                                $(boton).text("Pendiente");

                            });
                        });

                        var query = `select estado from inscripcion  where idmusico  = ${idmusico} AND idconcierto = ${item.idconcierto};`;
                        var params = {
                            action: "RawQueryRet",
                            query: query};

                        callAjaxBBDD(params, function (result) {

                            var estadoConcierto = parseInt(result.data[0].estado);
                            if (estadoConcierto === 0) {

                            } else if (estadoConcierto === 2) {
                                $(boton).text("Aceptado");
                            } else if (estadoConcierto === 1) {
                                $(boton).text("Pendiente");
                            }
                        });

                        $("#musico").append(divpadre);
                    });

                });
            });
        </script>
    </body>
</html>
