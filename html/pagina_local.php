<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/musico.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        #conciertos{
            color: white;
        }

        #formConciertoLocal{
            color: white;
        }


    </style>
    <body>
        <div class="_childContainer divPadding10">
            <form action="" id="formConciertoLocal">
                <button type="button" id="nuevoConcierto">Añade un concierto</button>
                <div id="registroConcierto">
<!--                    Nombre del local: <input type="text" id="nombreLocal" name="nombreLocal"><br>-->
                    Fecha del concierto: <input type="date" id="fechaLocal" name="fechaLocal"> <br>
                    Hora del concierto: <input type="time" id="horaLocal" name="horaLocal"> <br>
                    Genero: <select id="generos">

                    </select><br>
                    Valor economico: <input type="number" id="economicoLocal" name="economicoLocal"><br>
                    Municipio: <select id="municipios">

                    </select><br>
                </div>
            </form>
            <script>

                var selectGeneros = `select * from genero`
                var params = {
                    action: "RawQueryRet",
                    query: selectGeneros};
                callAjaxBBDD(params, function (result) {
                    $.each(result.data, function (i, item) {
                        var nombre = item.nombre;
                        var option = $("<option>" + nombre + "</option>");
                        $(option).attr("data-generoId", item.idgenero);
                        $("#generos").append(option);
                    });
                });

                var selectMunicipios = `select idciudad,munucipio from comunidades limit 100`
                var params = {
                    action: "RawQueryRet",
                    query: selectMunicipios};
                callAjaxBBDD(params, function (result) {
                    $.each(result.data, function (i, item) {
                        var nombre = item.munucipio;
                        var option = $("<option>" + nombre + "</option>");
                        $(option).attr("data-idciudad", item.idciudad);
                        $("#municipios").append(option);
                    });
                });
                $("#nuevoConcierto").click(insertConcierto);
                function insertConcierto() {
                    var fecha = $("#fechaLocal").val();
                    var hora = $("#horaLocal").val();
                    var generoId = $("#generos option:selected").attr("data-generoid");
                    var valorEconomico = $("#economicoLocal").val();
                    var estado = 0;
                    var idlocal = Usuario.id;
                    var municipioId = $("#municipios option:selected").attr("data-idciudad");

                    var query = (`insert into concierto values(default,'${idlocal}','${fecha}','${hora}','${generoId}','${valorEconomico}','${estado}','${municipioId}',null)`);
                    var params = {
                        action: "RawQueryRet",
                        query: query};
                    callAjaxBBDD(params, function (result) {
                        console.log(result);

                    });
                }
            </script>            
            <br>
            <div id="conciertos">

            </div>
        </div>
        <script>
            var idlocal = Usuario.id;
            var query = `select concierto.idconcierto,usuario.nombre as Local,concierto.fecha,concierto.hora,genero.nombre as genero,concierto.estado
from concierto join genero on concierto.genero = genero.idgenero
join usuario on usuario.idusuario = concierto.idlocal where concierto.idlocal = ${idlocal}`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                console.log(result);
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
                    
                    $(botonBaja).click(function() {
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
