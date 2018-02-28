onJqueryReady(function () {

    var select = "SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;";
    callAjax(METHOD.POST, "bbdd/mybbdd.php",
            {
                action: "RawQuery",
                query: select
            }, function (result) {

        console.log(result);
    });

    callAjax(METHOD.POST, "bbdd/mybbdd.php", {
        action: "ObtenerMusicos"}, function (result) {

        $("#divMusicosFan").empty();

        $.each(result, function (i, item) {

            var usuario = item;
            var nombre = usuario ["nombre"];
            var nombreartistico = usuario ["nombreartistico"];
            var genero = usuario ["genero"];

            var div = $("<div>").addClass("musicoContainer clickableElement").css({width: "220px"});

            var musicoHeader = $("<div>").addClass("musicoHeader");
            var musicoBody = $("<div>").addClass("musicoBody");
            var musicoFooter = $("<div>").addClass("musicoFooter");

            $(musicoHeader).append($("<label>").addClass("musicoHeaderTitulo").text(nombre));

            $(div).append(musicoHeader);
            $(div).append("<hr class='musicoSeparator'>");

            $(musicoBody).append($("<div>").addClass("musicoAlbumArtContainer"));

            var fullPath = Main.obtenerUserDataPath(usuario["usuario"]) + "img/album_art.jpg";
            $(musicoBody).find(".musicoAlbumArtContainer").append("<img>").find("img").addClass("musicoAlbumArtImg").prop("src", fullPath);

            $(musicoFooter).append($("<div>").addClass("musicoInfo"));

            $(musicoFooter).find(".musicoInfo").append($("<label>").addClass("blockLabel musicoInfoTexto clickableElement").text("Nombre artístico: " + nombreartistico));
            $(musicoFooter).find(".musicoInfo").append($("<label>").addClass("blockLabel musicoInfoTexto clickableElement").text("Género: " + genero));

            $(musicoFooter).append($("<div>").addClass("musicoVoteContainer"));

            $(musicoFooter).find(".musicoVoteContainer").append("<img>");
            $(musicoFooter).find("img").addClass("musicoVoteBtn").prop("src", "img/btn_vote.png");

            $(div).append(musicoBody);
            $(div).append(musicoFooter);

            $("#divMusicosFan").append(div);
        });
    });
});
