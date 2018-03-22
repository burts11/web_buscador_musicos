<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <style>
        .miv2_container{

            position: relative;
            width: 100%;
            height: 100%;
            /*background-color: rgba(0,0,0,0.5);*/
        }

        .miv2_musico_landscape{
            position: relative;
            display: inline-block;
            width: 100%;
            height: 30em;
            overflow: hidden;
        }

        #miv2_musico_landscape_img {
            display: inline-block;
            position: relative;
            width: 100%;
            height: 180%;
        }

        .miv2_tituloWrapper{

            position: absolute;
            display: inline-block;
            color: var(--textColorPrimary);
            bottom: 0px;
            width: 100%;
            height: 1.5em;
            font-size: 3em;
            left: 0px;
            background-color: rgba(0,0,0,0.4);
        }

        #musicoInfoSection{
            position: relative;
            display: inline-block;
            width: 100%;
            height: 10em;
        }

        .miv2_musico_info label {

            font-size: 2em !important;
            color: var(--textColorPrimary);
        }

        .miv2_musico_menu{

            position: relative;
            display: inline-block;
            background-color: #252525;
            width: 100%;
            height: 3.5em;
        }

        .miv2_musico_menu_tituloWrapper{

            position: relative;
            display: inline-block;
            font-weight: bold;
        }

        .miv2_musico_menu_titulo:hover{

            color: var(--textColorPrimaryShine);
        }

        .miv2_musico_menuWrapper{

            width: 30em;
            height: 100%;
            position: relative;
        }
    </style>
    <body>
        <div class="_childContainer">
            <div class="miv2_container">
                <div class="miv2_musico_landscape">
                    <img id="miv2_musico_landscape_img" src="">
                    <hr class="hrSeparator_2">
                    <div class="miv2_tituloWrapper">
                        <label class="miv2_titulo centeredElement"></label>
                    </div>
                </div>
                <div class="miv2_musico_menu">
                    <div class="miv2_musico_menuWrapper centeredElement">
                        <div class="miv2_musico_menu_tituloWrapper divPadding10 centeredElementVertical clickableElement" data-section="#musicoInfoSection">
                            <label class="miv2_musico_menu_titulo textoUpperCase clickableElement">Información</label>
                        </div>
                        <div class="miv2_musico_menu_tituloWrapper divPadding10 centeredElementVertical clickableElement" data-section="">
                            <label class="miv2_musico_menu_titulo textoUpperCase clickableElement">Galería</label>
                        </div>
                        <div class="miv2_musico_menu_tituloWrapper divPadding10 centeredElementVertical clickableElement" data-section="#musicoMp3">
                            <label class="miv2_musico_menu_titulo textoUpperCase clickableElement">Playlist</label>
                        </div>
                    </div>
                </div>
                <section id="musicoInfoSection">
                    <div class="miv2_musico_info divPadding10 ">
                        <label class="miv2_musico_nombre blockLabel"></label>     
                        <label class="miv2_musico_apellidos blockLabel"></label>                    
                        <label class="miv2_musico_nombre_artistico blockLabel"></label>                    
                        <label class="miv2_musico_genero blockLabel"></label>                    
                    </div> 
                </section>
                <section id="musicoMp3">
                    <div class="divPadding10 ">
                        <div class='jAudio'>
                            <audio id="jAudio_audio_control"></audio>
                            <div class='jAudio--ui'>
                                <div class='jAudio--thumb'></div>
                                <div class='jAudio--status-bar'>
                                    <div class='jAudio--details'></div>
                                    <div class='jAudio--volume-bar'></div>
                                    <div class='jAudio--progress-bar'>
                                        <div class='jAudio--progress-bar-wrapper'>
                                            <div class='jAudio--progress-bar-played'>
                                                <span class='jAudio--progress-bar-pointer'></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='jAudio--time'>
                                        <span class='jAudio--time-elapsed'>00:00</span>
                                        <span class='jAudio--time-total'>00:00</span>
                                    </div>
                                </div>
                            </div>
                            <div class='jAudio--playlist'>
                            </div>
                            <div class='jAudio--controls'>
                                <ul>
                                    <li><button class='jAudio--control jAudio--control-prev' data-action='prev'><span></span></button></li>
                                    <li><button class='jAudio--control jAudio--control-play' data-action='play'><span></span></button></li>
                                    <li><button class='jAudio--control jAudio--control-next' data-action='next'><span></span></button></li>
                                </ul>
                            </div>

                        </div>
                    </div> 
                </section>
            </div>
        </div>
    </body>
    <script>
        onJqueryWindowCallbackEventOne(VInfo.MUSICO_INFO_V2, {

            callback: function (e) {

                var data = e.json.data;
                var usuario = data["usuario"];

                $('body').scrollTop(0);

                callAjaxFileManager({action: "ListarArchivos", path: `${usuario}/audio/tracks`}, function (json) {

                    if (success(json)) {
                        var pList = {

                            playlist: [
                            ]
                        };

                        var tracks = Main.obtenerUserDataPath(usuario) + "audio/tracks/";
                        var thumbs = Main.obtenerUserDataPath(usuario) + "audio/thumbs/";

                        $.each(json.data, function (i, item) {

                            var playListItem = {

                                file: tracks + item,
                                thumb: thumbs + item.beforeLastIndex(".") + ".jpg",
                                trackName: item.beforeLastIndex("."),
                                trackArtist: "",
                                trackAlbum: ""
                            };

                            pList.playlist.push(playListItem);
                        });

                        var myAudio = document.getElementById("jAudio_audio_control");
                        myAudio.volume = 1.0; 
                        $(".jAudio").jAudio(pList);
                    } else {

                        $("#musicoMp3").hide();
                    }
                });

                var headerTop = $("#_mainHeader").outerHeight();
                $(".miv2_musico_menu_tituloWrapper").click(function (e) {

                    e.preventDefault();

                    var section = $(this).attr("data-section");
                    var sectionOffset = $(section).offset().top;

                    $('body, html').stop().animate({
                        scrollTop: sectionOffset - headerTop
                    }, 1000, function () {
                    });
                });

                $("#miv2_musico_landscape_img").prop("src", Main.obtenerUserDataPath(usuario) + "img/album_art.jpg");

                $("#miv2_musico_landscape_img").click(function () {
                    $(".miv2_musico_info").removeClass("fadeInMoveAnim").addClass("fadeOutMoveAnim");
                });

                $(".miv2_titulo").text(data["nombreartistico"]);

                $(".miv2_musico_nombre").text(data["nombre"]);
                $(".miv2_musico_apellidos").text(data["apellidos"]);
                $(".miv2_musico_nombre_artistico").text(data["nombreartistico"]);
                $(".miv2_musico_genero").text(data["genero"]);

                Main.cambiarTitulo("Musico");
                window.history.replaceState({}, '#', '#');
            }
        });
//
//        var data = {
//            apellidos: "Ferri Llopis",
//            ciudad: null,
//            email: "wrtrwt",
//            genero: "Balada",
//            generoID: 2,
//            idmusico: 4,
//            idusuario: 4,
//            nombre: "Luis",
//            nombreartistico: "Nino Bravo",
//            numerocomponentes: 1,
//            pass: "1234",
//            telefono: 0,
//            tipo: 1,
//            usuario: "nino",
//            web: ""
//        };
    </script>
</html>
