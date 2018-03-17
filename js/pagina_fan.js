onJqueryReady(function () {
    callAjaxBBDD({
        action: "RawQuery",
        query: "SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;"
    }, function (result) {
        console.log(result);

        $("#divMusicosFan").empty();

        $.each(result, function (i, item) {

            var usuario = item;
            var usuarioId = usuario["idusuario"];
            var nombre = usuario ["nombre"];
            var nombreartistico = usuario ["nombreartistico"];
            var genero = usuario ["genero"];

            var div = $("<div>").addClass("musicoContainer");

            var musicoBody = $("<div>").addClass("musicoBody clickableElement");
            var musicoFooter = $("<div>").addClass("musicoFooter");

            $(musicoBody).append($("<div>").addClass("musicoAlbumArtContainer"));
            $(musicoBody).append("<div class='musicoBodyOver'>");

            var fullPath = Main.obtenerUserDataPath(usuario["usuario"]) + "img/album_art.jpg";
            $(musicoBody).find(".musicoAlbumArtContainer").append("<img>").find("img").addClass("musicoAlbumArtImg").prop("src", fullPath);

            $(musicoFooter).append($("<div>").addClass("musicoInfo"));

            var nombreArtisticoDiv = $("<div>").addClass("blockDiv");
            var nombreArtisticoLang = $("<label lang='es' data-lang-token='MusicoInfoNombreArtistico'></>")
                    .addClass("musicoInfoTexto").text("Nombre artístico: ");
            var nombreArtisticoReal = $("<label>").addClass("musicoInfoTexto ").text(nombreartistico);

            $(nombreArtisticoDiv).append(nombreArtisticoLang).append(nombreArtisticoReal);

            var generoDiv = $("<div>").addClass("blockDiv");
            var generoLang = $("<label lang='es' data-lang-token='MusicoInfoGenero'></>")
                    .addClass("musicoInfoTexto").text("Género : ");
            var generoReal = $("<label>").addClass("musicoInfoTexto ").text(genero);

            $(generoDiv).append(generoLang).append(generoReal);

            $(musicoFooter).find(".musicoInfo").append(nombreArtisticoDiv);
            $(musicoFooter).find(".musicoInfo").append(generoDiv);

            $(musicoFooter).append($("<div>").addClass("musicoVoteContainer clickableElement"));

            $(musicoFooter).find(".musicoVoteContainer").append("<img>");
            $(musicoFooter).find("img").addClass("musicoVoteBtn").prop("src", "img/btn_vote.png");

            callAjaxBBDD(
                    {
                        action: "RawQueryOne", query: `select * from votacionmusico where idfan = ${Usuario.id} and idmusico = ${usuarioId} `
                    }, function (json) {

                if (!jsonEmpty(json)) {

                    $(musicoFooter).find(".musicoVoteBtn").prop("src", "img/btn_liked.png");
                }
            });

            $(div).append(musicoBody);
            $(div).append(musicoFooter);

            $(musicoBody).unbind("click").bind("click", function () {

                VModal.show("musico_info", item, {modalEffect: "md-effect-13", VModalId: generateUniqueId(),
                    CustomPadding: "true",
                    padding: "0px"}, {
                    onDialogShow: function (ev) {

                        ev["usuarioId"] = usuarioId;
                        ev["vparams"]["sender"] = "musico_info_fan";

                        callJqueryWindowEvent(VInfo.MUSICO_INFO, ev);
                    },
                    onDialogClose: function (ev) {
                    }
                });
            });

            $(musicoFooter).find(".musicoVoteContainer").off().click(function () {

                callAjaxBBDD(
                        {
                            action: "RawQueryOne", query: `select * from votacionmusico where idfan = ${Usuario.id} and idmusico = ${usuario["idusuario"]} `
                        }, function (json) {

                    if (!jsonEmpty(json)) {

                        VToast.mostrarError("Ya has votado a este músico");
                        return;
                    } else {
                        VToast.log("Se puede votar a " + nombre);

                        callAjaxBBDD({

                            action: "Insert",
                            tabla: "votacionmusico",
                            data: {
                                idmusico: usuarioId,
                                idfan: Usuario.id
                            }
                        }, function (json) {

//                            VToast.logS("Like");

                            if (success(json)) {
                                VToast.log("Liked " + nombre);
                                $(musicoFooter).find(".musicoVoteBtn").prop("src", "img/btn_liked.png");
                            } else {
                                VToast.log("Error al darle like a " + nombre);
                            }

                            VToast.log(json);

//                            VToast.logF("Like");
                        });
                    }
                });
            });

            $(musicoBody).mouseenter(function () {
                $(musicoBody).find(".musicoAlbumArtImg").addClass("zoomMusicoIn");
                $(musicoBody).find(".musicoBodyOver").addClass("fade-in-musico").show();
            });

            $(musicoBody).mouseleave(function () {

                $(musicoBody).find(".musicoBodyOver").stop().animate({opacity: 0}, 200);
                $(musicoBody).find(".musicoBodyOver").removeClass("fade-in-musico");
                $(musicoBody).find(".musicoAlbumArtImg").removeClass("zoomMusicoIn").addClass("zoomMusicoOut");

//                $(musicoBody).find(".musicoBodyOver").removeClass("musicoBodyOver_fadeIn").addClass("musicoBodyOver_fadeOut");
            });

            $("#divMusicosFan").append(div);
            $(div).addClass("musicoAnimIn");
            setTimeout(function () {

                $(div).addClass("musicoAnimIn2");
            }, 20);
        });
    });
});
