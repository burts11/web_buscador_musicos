<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
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
            min-height: 10em;
        }

        #musicoFoto {
            display: inline-block;
            position: relative;
            width: 100%;
            height: 100%;
            box-shadow: 0 0px 10px rgba(36,37,38,0.8);
            min-width: 10em;
            min-height: 10em;
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
        <div class="_childContainer divPadding10">
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
            onJqueryReady(function () {

                onJqueryWindowCallbackEventOne(VInfo.MUSICO_INFO, {

                    callback: function (e) {

                        var select =
                                `SELECT usuario.usuario, usuario.nombre, musico.apellidos, musico.genero, musico.nombreartistico,
                 musico.numerocomponentes FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico where musico.idmusico = ${e.json}`;

                        callAjaxBBDD(
                                {
                                    action: "RawQueryOne",
                                    query: select
                                }, function (result) {

                            console.log(result);

                            var nombre = $("<label>").addClass("blockLabel musicoInfoTexto labelMarginBottom5em").text("Nombre : " + result["nombre"]);
                            var nombreartistico = $("<label>").addClass("blockLabel musicoInfoTexto labelMarginBottom5em").text("Nombre artístico : " + result["nombreartistico"]);
                            var genero = $("<label>").addClass("blockLabel musicoInfoTexto labelMarginBottom5em").text("Género : " + result["genero"]);
                            var componentes = $("<label>").addClass("blockLabel musicoInfoTexto labelMarginBottom5em").text("Número de componentes : " + result["numerocomponentes"]);

                            $(".musico_info_data").append(nombre);
                            $(".musico_info_data").append(nombreartistico);
                            $(".musico_info_data").append(genero);
                            $(".musico_info_data").append(componentes);

                            $(".musico_info_titulo").text(result["nombre"]).fadeIn();
                            $(".musico_info_data_container").hide().fadeIn("slow");

                            $("#musicoFoto").hide().prop("src", `userdata/${result.usuario}/img/album_art.jpg`).fadeIn();
                        });
                    }
                });
            });
        </script>
    </div>
</body>
</html>
