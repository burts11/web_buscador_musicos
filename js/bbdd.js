function obtenerLogin() {
    var user = localStorage.getItem("user_login");
    var user_pass = localStorage.getItem("user_pass");

    if (user !== null && user_pass !== null) {

        var json = {

            USER: user,
            PASS: user_pass
        };

        return json;
    }

    return null;
}

function usuarioLogueado(func) {
    var parameters = {
        action: "UsuarioLogueado"
    };

    callAjaxPost("bbdd/mybbdd.php", parameters, function (json) {

        func(json);
    });
}

function mostrarSesion() {

    var parameters = {
        action: "MostrarSesion"
    };

    callAjaxPost("bbdd/mybbdd.php", parameters, function (json) {

        console.log("SESSION ->");
        console.log(json);
    });
}

function cerrarSesion(result) {

    var parameters = {
        action: "CerrarSesion"
    };

    callAjaxPost("bbdd/mybbdd.php", parameters, function (json) {

        if (success(json)) {

            result.success(json);
            callJqueryCustomEvent(BBDD.SESION_CERRADA_SUCCESS, parameters);
        } else {
            result.error(json);
            callJqueryCustomEvent(BBDD.SESION_CERRADA_ERROR, parameters);
        }
    });
}

function iniciarSesion(user, pass, params) {

    var parameters = {
        action: "IniciarSesion",
        user: user,
        pass: pass
    };

    callAjaxPost("bbdd/mybbdd.php", parameters, function (json) {

        if (success(json)) {

            params.success(json);
            callJqueryCustomEvent(BBDD.SESION_CERRADA, parameters);
        } else {
            params.error(json);
            callJqueryCustomEvent(BBDD.SESION_CERRADA_ERROR, parameters);
        }
    });
}

function obtenerMusicos() {

    $("#divMusicos").empty();
    console.log("working?");

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

            $(musicoHeader).append($("<h3>").text(nombre));

            $(div).append(musicoHeader);
            $(div).append("<hr class='musicoSeparator'>");

            $(musicoBody).append($("<div>").addClass("musicoAlbumArtContainer"));

            var fullPath = Main.obtenerUserDataPath(nombre) + "img/album_art.jpg";
            $(musicoBody).find(".musicoAlbumArtContainer").append("<img>").find("img").addClass("musicoAlbumArtImg").prop("src", fullPath);

            $(musicoBody).append($("<div>").addClass("musicoInfo"));

            $(musicoBody).find(".musicoInfo").append($("<p>").addClass("blockLabel").text("Nombre artístico: " + nombreartistico));
            $(musicoBody).find(".musicoInfo").append($("<p>").addClass("blockLabel").text("Género: " + genero));

            $(div).append(musicoBody);
            $("#divMusicos").append(div);
            console.log(nombre);
        });
    });
}

function success(e) {

    if (e["resultado"] === "Success") {
        return true;
    }

    return false;
}

function successJSON(e) {

    if (e.json["resultado"] === "Success") {
        return true;
    }
    
    return false;
}

function callAjaxPost(url, dataJSON, func) {

    $.ajax({
        type: METHOD.POST,
        url: url,
        dataType: "json",
        data: dataJSON,
        cache: false,
        success: function (rawJson) {

            var json = $.parseJSON(rawJson);
            func(json);
        },
        error: function (err) {

            var dataJSON = {
                resultado: "error",
                errorResponse: err
            };
            func(dataJSON);
        }
    }
    );
}

function callAjaxBBDD(dataJSON, func) {

    $.ajax({
        type: METHOD.POST,
        url: "bbdd/mybbdd.php",
        dataType: "json",
        data: dataJSON,
        cache: false,
        success: function (rawJson) {

            var json = $.parseJSON(rawJson);
            func(json);
        },
        error: function (err) {

            var dataJSON = {
                resultado: "ERROR",
                errorResponse: err
            };
            func(dataJSON);
        }
    }
    );
}

function callAjax(type, url, dataJSON, func) {

    $.ajax({
        type: type,
        url: url,
        dataType: "json",
        data: dataJSON,
        cache: false,
        success: function (rawJson) {

            var json = $.parseJSON(rawJson);
            func(json);
        },
        error: function (err) {

            var dataJSON = {
                resultado: "ERROR",
                errorResponse: err
            };
            func(dataJSON);
        }
    }
    );
}