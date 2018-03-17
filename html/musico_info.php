<!DOCTYPE html>
<html>
    <style>
        .musico_info_container {

            width: 100%;
            height: 100%;
            position: relative;
            display: block;
        }

        .musico_info_pic_container {
            display: block;
            position: relative;
            width: 100%;
            height: 100%;
            min-width: 10em;
            max-height: 18em;
            left: 0.6em;
        }

        #musicoFoto {
            display: inline-block;
            position: relative;
            width: 100%;
            height: 100%;
            box-shadow: 0 0px 10px rgba(36,37,38,0.8);
            min-width: 10em;
            max-height: 18em;
            display: none;
        }

        .musico_info_data_container {

            position: relative;
            display: inline-block;
            width: 100%;
            text-align: left;
            margin-top: 1em;
        }

        .musico_info_data{
            /*background-color: red;*/
            position: relative;
            display: inline-block;
            height: auto;
            width: 100%;
        }

        .musico_info_titulo {

            font-size: 2em;
        }
    </style>
    <body>        
        <div class="_childContainer">
            <label class="tituloH1-Grey padding10 musico_info_titulo textoCentradoHorizontalUpperCase"></label>
            <div class="musico_info_container" style="margin-top: 1em;">
                <div class="musico_info_pic_container">
                    <img id="musicoFoto">
                </div>
                <div class="musico_info_data_container">
                    <div class="musico_info_data textoCentradoHorizontal"></div>
                </div>
            </div>
        </div>
        <script>

            onJqueryWindowCallbackEventOne(VInfo.MUSICO_INFO, {

                callback: function (e) {

                    var select =
                            `SELECT usuario.usuario, usuario.nombre, musico.apellidos, musico.genero, musico.nombreartistico,
                 musico.numerocomponentes FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico where musico.idmusico = ${e.json.usuarioId}`;

                    callAjaxBBDD(
                            {
                                action: "RawQueryOne",
                                query: select
                            }, function (result) {

// nombre
                        var nombreDiv = $("<div>").addClass("blockDiv marginBottom5em");
                        var nombreLang = $("<label lang='es' data-lang-token='MusicoInfoNombre'></>")
                                .addClass("musicoInfoTexto").text("Nombre : ");
                        var nombreReal = $("<label>").addClass("musicoInfoTexto ").text(result["nombre"]);
                        $(nombreDiv).append(nombreLang);
                        $(nombreDiv).append(nombreReal);

// nombre artistico
                        var nombreArtisticoDiv = $("<div>").addClass("blockDiv marginBottom5em");
                        var nombreLang = $("<label lang='es' data-lang-token='MusicoInfoNombreArtistico'></>")
                                .addClass("musicoInfoTexto").text("Nombre artístico : ");
                        var nombreArtisticoReal = $("<label>").addClass("musicoInfoTexto labelMarginBottom5em").text(result["nombreartistico"]);

                        $(nombreArtisticoDiv).append(nombreLang);
                        $(nombreArtisticoDiv).append(nombreArtisticoReal);

// genero
                        var generoDiv = $("<div>").addClass("blockDiv marginBottom5em");
                        var generoLang = $("<label lang='es' data-lang-token='MusicoInfoGenero'></>").addClass("musicoInfoTexto").text("Género : ");
                        var generoReal = $("<label>").addClass("musicoInfoTexto").text(result["genero"]);

                        $(generoDiv).append(generoLang);
                        $(generoDiv).append(generoReal);


// componentesDiv
                        var componentesDiv = $("<div>").addClass("blockDiv marginBottom5em");
                        var componentesLang = $("<label lang='es' data-lang-token='MusicoInfoComponentes'></>").addClass("musicoInfoTexto").text("Número Componentes : ");
                        var componentesReal = $("<label>").addClass("musicoInfoTexto").text(result["numerocomponentes"]);

                        $(componentesDiv).append(componentesLang);
                        $(componentesDiv).append(componentesReal);

                        $(".musico_info_data").append(nombreDiv);
                        $(".musico_info_data").append(nombreArtisticoDiv);
                        $(".musico_info_data").append(generoDiv);
                        $(".musico_info_data").append(componentesDiv);

                        $(".musico_info_titulo").text(result["nombre"]).fadeIn();
                        $(".musico_info_data_container").hide().fadeIn("slow");

                        $("#musicoFoto").hide().prop("src", `userdata/${result.usuario}/img/album_art.jpg`).fadeIn();

                        e.json.vparams.onDialogContentLoaded();
                    });
                }
            });
        </script>
    </div>
</body>
</html>
