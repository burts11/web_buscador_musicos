onJqueryReady(function () {

    $("#divMusicos").empty();

    var select = "SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;";
//    var select = "SELECT * FROM usuario where idusuario = 1";

    callAjaxBBDD(
            {
                action: "RawQuery",
                query: select
            }, function (result) {

        $("#divMusicos").empty();

        $.each(result, function (i, item) {
//            console.log(item);

            var usuario = item;
            var nombre = usuario ["nombre"];
            var nombreartistico = usuario ["nombreartistico"];
            var genero = usuario ["genero"];

            var div = $("<div>").addClass("musicoContainer clickableElement").css({width: "220px"});

            $(div).bind("click", function () {

                VModal.show("musico_info", item, {modalEffect: "md-effect-5", VModalId: generateUniqueId()}, {
                    onDialogShow: function (ev) {

                        var usuarioId = usuario["idusuario"];
                        callJqueryWindowEvent(VInfo.MUSICO_INFO, usuarioId);
                    },
                    onDialogClose: function (ev) {
                    }
                });
            });

            var musicoHeader = $("<div>").addClass("musicoHeader");
            var musicoBody = $("<div>").addClass("musicoBody");
            var musicoFooter = $("<div>").addClass("musicoFooter");

            $(musicoHeader).append($("<label>").addClass("musicoHeaderTitulo").text(nombre));

            $(div).append(musicoHeader);
            $(div).append("<hr class='musicoSeparator'>");

            $(musicoBody).append($("<div>").addClass("musicoAlbumArtContainer"));

            var fullPath = Main.obtenerUserDataPath(nombre) + "img/album_art.jpg";
            $(musicoBody).find(".musicoAlbumArtContainer").append("<img>").find("img").addClass("musicoAlbumArtImg").prop("src", fullPath);

            $(musicoFooter).append($("<div>").addClass("musicoInfo"));

            $(musicoFooter).find(".musicoInfo").append($("<label>").addClass("blockLabel musicoInfoTexto clickableElement").text("Nombre artístico: " + nombreartistico));
            $(musicoFooter).find(".musicoInfo").append($("<label>").addClass("blockLabel musicoInfoTexto clickableElement").text("Género: " + genero));

            $(div).append(musicoBody);
            $(div).append(musicoFooter);
            $("#divMusicos").append(div);
        });
    });

    $(function () {
        $('#slides').slidesjs({
            width: 200,
            height: 120,
            navigation: false,
            pagination: {
                active: false,
                // [boolean] Create pagination items.
                // You cannot use your own pagination. Sorry.
                effect: "fade"
                        // [string] Can be either "slide" or "fade".
            },
            play: {
                active: false,
                // [boolean] Generate the play and stop buttons.
                // You cannot use your own buttons. Sorry.
                effect: "fade",
                // [string] Can be either "slide" or "fade".
                interval: 2000,
                // [number] Time spent on each slide in milliseconds.
                auto: true,
                // [boolean] Start playing the slideshow on load.
                swap: true,
                // [boolean] show/hide stop and play buttons
                pauseOnHover: false,
                // [boolean] pause a playing slideshow on hover
                restartDelay: 2500
                        // [number] restart delay on inactive slideshow
            }
        });
    });
});