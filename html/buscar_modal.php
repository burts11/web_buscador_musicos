<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/newTextInput.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        .bm_conciertoInfoContainer{

            width: 100%;
            height: 100% !important;
            position: relative;
            display: inline-block;
            /*background-color: red;*/  
        }

        .bm_searchContainer{

            width: 100%;
            height: 8%;
            margin-left: 0px;
            position: relative;
            display: inline-block;
            /*background-color: orange;*/
        }

        #bm_searchField{

            width: 100%;
            height: 100%;
            position: relative;
        }

        .bm_searchImage{

            position: relative;
            width: 2em;
            height: 2em;
        }

        .bmSearchResultContainer  
        {
            position: relative;
            display: inline-block;
            width: 18em;
            height: 12em;
            margin-left: 0.5em;
            margin-top: 0.3em;
            /*background-color: red;*/  
        }

        .bmSearchResultBody{
            position: relative;
            width: 100%;
            height: 80%;
            background-color: rgba(0,0,0,0.8);  
            overflow: hidden;
        }

        .bmSearchResultFooter{
            position: relative;
            width: 100%;
            height: 20%;
            background-color: rgba(0,0,0,0.5);  
            text-align: center;
        }

        .bmThumbnail {

            position: relative;
            width: 100%;
            height: 100%;
        }

        #bm_results{

            width: 98%;
            margin-top: 1em;
            margin-left: 1em;
            /*background-color: rgba(0,0,0,0.5);*/
        }

        .bm_filtroChild{

            background-color: var(--backgroundControlPrimary);
            padding: 0.8em;
            display: inline-block;
            font-size: 0.85em;
            color: white;
        }

        .bm_filtroChild-active{

            background-color: var(--colorPrimaryShine);
        }

        .bm_filtroContainer{

            position: relative;
            display: block;
            height: 2em;
            width: 95%;
            margin-top: 1em;
        }

        .bm_filtroWrapper{

            height: auto;
        }

        ._childContainer{
            overflow-y: auto !important;
        }

        .bm_searchImageWrapper 
        {
            position: relative;
            display: inline-block;
            width: 2.5em;
            height: 100%;
        }

        .bm_searchWrapper 
        {
            position: relative;
            display: inline-block;
            width: 90%;
            height: 100%;
        }
    </style>
    <body>
        <!--        <div class="bmSearchResultContainer">
                    <div class="bmSearchResultBody">
                        <img> 
                    </div>
                    <div class="bmSearchResultFooter">
                        <label class="bmSearchName padding10 centeredElementVertical">Hola</label>
                    </div>
                </div> -->
        <div class="_childContainer divPadding10 ">
            <div class="bm_conciertoInfoContainer">
                <div class="bm_searchContainer">
                    <div class="bm_searchImageWrapper">
                        <img class="bm_searchImage clickableElement centeredElement inlineDiv" src="img/search.png">
                    </div>
                    <div class="bm_searchWrapper">
                        <input type="text" class="form-control-textfield fontSize9em inlineDiv" id="bm_searchField" lang="es" placeholder="Buscar..."> 
                    </div>
                </div>
                <div class="bm_filtroContainer">
                    <div class="bm_filtroWrapper centeredElementHorizontal">
                        <div class="bm_filtroChild clickableElement bm_filtroChild-active" id="bm_filtro_artistas">
                            <label lang="es" data-lang-token="Buscar_Dialogo_Artistas" class="clickableElement">Artistas</label>
                        </div>
                        <div class="bm_filtroChild clickableElement"  id="bm_filtro_conciertos">
                            <label lang="es" data-lang-token="Buscar_Dialogo_Conciertos" class="clickableElement">Conciertos</label>
                        </div>
                    </div>
                </div>
                <div id="bm_results">
                </div>
            </div>
        </div>
        <script>
            var filtroSeleccionado = "bm_filtro_artistas";
            var searchTimer;

            function buscarConciertos(val) {

                $("#bm_results").children().fadeOut();
//                $("#bm_results").empty();
                clearTimeout(searchTimer);

                var search = val;
                if (search.length >= 1)
                {
                    searchTimer = setTimeout(function () {

                        var query = `select usuario.nombre,concierto.fecha,concierto.hora,genero.nombre as genero,comunidades.munucipio,comunidades.provincia 
                                    from concierto 
                                     join usuario on concierto.idmusico = usuario.idusuario join genero on concierto.genero = genero.idgenero
                                    join comunidades on concierto.ciudad = comunidades.idciudad where usuario.nombre = "${val}"`;

                        callAjaxBBDD(
                                {
                                    action: "RawQuery",
                                    query: query
                                }, function (result) {

                            $.each(result, function (i, item) {
                                var container = $('<div class="bmSearchResultContainer">' +
                                        '            <div class="bmSearchResultFooter">' +
                                        '                <label class="bmSearchName padding10 centeredElement"></label></br>' +
                                        '                <label class="bmSearchFecha padding10 centeredElement"></label></br>' +
                                        '                <label class="bmSearchHora padding10 centeredElement"></label></br>' +
                                        '            </div>' +
                                        '        </div>');
//                                $(container).find(".bmSearchResultBody img").prop("src", Main.obtenerUserDataPath(item["usuario"]) + "img/album_art.jpg");

//                                $(container).append("<label class='blockLabel'>" + item.nombre + "</label>");
//                                $(container).append("<label class='blockLabel'>Fecha: " + item.fecha + "</label>");
//                                $(container).append("<label class='blockLabel'>Hora: " + item.hora + "</label>");
                                $(container).find(".bmSearchName").text(item["nombre"]);
                                $(container).find(".bmSearchFecha").text(item["fecha"]);
                                $(container).find(".bmSearchHora").text(item["hora"]);
                                $(container).find(".bmSearchResultBody").click(function () {

                                    cambiarHash("musico_info_v2");
                                    queueEvent(VInfo.MUSICO_INFO_V2, {data: item});
                                    VModal.closeWithId("buscar_modal");
                                });

                                console.log(item);
                                $("#bm_results").append(container).hide().fadeIn();
                            });
                        });
                    }, 250);
                }


                console.log("Buscando conciertos!");
            }

            function buscarArtistas(val) {
                clearTimeout(searchTimer);

                $("#bm_results").children().fadeOut();
                $("#bm_results").empty();

                var search = val;
                if (search.length >= 1)
                {
                    searchTimer = setTimeout(function () {

                        var query = `select musico.idmusico, usuario.email, musico.apellidos, usuario.nombre, usuario.ciudad, musico.web, musico.telefono, usuario.idusuario, usuario.usuario, musico.nombreartistico, musico.generoID, musico.numerocomponentes from musico inner join usuario on usuario.idusuario = musico.idmusico where nombreartistico like "%${val}%"`;

                        callAjaxBBDD(
                                {
                                    action: "RawQuery",
                                    query: query
                                }, function (result) {

                            $.each(result, function (i, item) {
                                var container = $('<div class="bmSearchResultContainer">' +
                                        '            <div class="bmSearchResultBody clickableElement">' +
                                        '                <img class="bmThumbnail"> ' +
                                        '            </div>' +
                                        '            <div class="bmSearchResultFooter">' +
                                        '                <label class="bmSearchName padding10 centeredElement"></label>' +
                                        '            </div>' +
                                        '        </div>');

                                $(container).find(".bmSearchResultBody img").prop("src", Main.obtenerUserDataPath(item["usuario"]) + "img/album_art.jpg");
                                $(container).find(".bmSearchName").text(item["nombreartistico"]);
                                $(container).find(".bmSearchResultBody").click(function () {

                                    cambiarHash("musico_info_v2");
                                    queueEvent(VInfo.MUSICO_INFO_V2, {data: item});
                                    VModal.closeWithId("buscar_modal");
                                });

                                console.log(item);
                                $("#bm_results").append(container).hide().fadeIn();
                            });
                        });
                    }, 250);
                }
            }

            $("#bm_searchField").off().on("keyup", function () {

                var texto = $("#bm_searchField").val();

                if (texto === "")
                {
                    $("#bm_results").children().fadeOut();
                    $("#bm_results").empty();
                    return;
                }

                switch (filtroSeleccionado) {

                    case "bm_filtro_artistas":
                        buscarArtistas(texto);
                        break;
                    case "bm_filtro_conciertos":
                        buscarConciertos(texto);
                        break;
                }
            });

            $(".bm_filtroContainer .bm_filtroChild").click(function (e) {

                $(".bm_filtroChild").not(this).removeClass("bm_filtroChild-active");
                $(this).addClass("bm_filtroChild-active");

                filtroSeleccionado = $(this).prop("id");

                $("#bm_searchField").keyup();
            });
        </script>
    </body>
</html>
