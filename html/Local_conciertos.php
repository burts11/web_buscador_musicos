<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" id="formConciertoLocal">

            <div id="registroConcierto">
                <p> Fecha del concierto: <input type="date" id="fechaLocal"class="form-control-textfield-black" name="fechaLocal"> </p>
                <p> Hora del concierto: <input type="time" id="horaLocal" class="form-control-textfield-black" name="horaLocal"></p>
                <p>   Genero: <select id="generos">

                    </select></p>
                <p>   Valor economico: <input type="number" id="economicoLocal" class="form-control-textfield-black" name="economicoLocal"></p>
                <p>  Municipio: <select id="municipios"></p>

                </select>
            </div>
            <br>
            <button type="button" class="form-control-btn" id="nuevoConcierto">Añadir</button>
        </form>
        <script>

            onJqueryWindowCallbackEventOne(VInfo.CONCIERTO_INFO, {

                callback: function (e) {

                    e.json.vparams.onDialogContentLoaded();

                }
            });
            var selectGeneros = `select * from genero`;
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
        <?php
        // put your code here
        ?>
    </body>
</html>
