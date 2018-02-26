onJqueryReady(function () {

    var select = "SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;";
    callAjax(METHOD.POST, "bbdd/mybbdd.php",
            {
                action: "DirectSelect",
                select: select
            }, function (result) {

        console.log(result);
    });

    callAjax(METHOD.POST, "bbdd/mybbdd.php", {
        action: "ObtenerMusicos"}, function (result) {

        $("#divMusicos").empty();

        $.each(result, function (i, item) {
            console.log(item);

            var usuario = item;
            var nombre = usuario ["nombre"];
            var nombreartistico = usuario ["nombreartistico"];
            var genero = usuario ["genero"];

            var div = $("<div>").addClass("musicoContainer clickableElement").css({width: "300px"});

            var musicoHeader = $("<div>").addClass("musicoHeader");
            var musicoBody = $("<div>").addClass("musicoBody");
            var musicoFooter = $("<div>").addClass("musicoFooter");

            $(musicoHeader).append($("<h3>").text(nombre));

            $(div).append(musicoHeader);
            $(div).append("<hr class='musicoSeparator'>");

            $(musicoBody).append($("<div>").addClass("musicoAlbumArtContainer"));

            var fullPath = Main.obtenerUserDataPath(nombre) + "img/album_art.jpg";
            $(musicoBody).find(".musicoAlbumArtContainer").append("<img>").find("img").addClass("musicoAlbumArtImg").prop("src", fullPath);

            $(musicoBody).append($("<div>").addClass("musicoInfo"));

            $(musicoBody).find(".musicoInfo").append($("<p>").addClass("blockLabel").text("Nombre artístico: " + nombreartistico));
            $(musicoBody).find(".musicoInfo").append($("<p>").addClass("blockLabel").text("Género: " + genero));

            $(musicoFooter).append($("<div>").addClass("musicoVoteContainer"));

            $(musicoFooter).find(".musicoVoteContainer").append("<img>");
            $(musicoFooter).find("img").addClass("musicoVoteBtn").prop("src", "img/btn_vote.png");

            $(div).append(musicoBody);
            $(div).append(musicoFooter);

            $("#divMusicos").append(div);
            console.log(nombre);
        });
    });
});
