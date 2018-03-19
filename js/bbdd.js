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
        } else {
            result.error(json);
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
        } else {
            params.error(json);
        }
    });
}

function registrarMusico(params, callback) {
    var parameters = {
        action: "RegistrarMusico",
        nombre: params.nombre,
        email: params.email,
        usuario: params.usuario,
        pass: params.pass,
        tipo: 1,
        numerocomponentes: params.numerocomponentes,
        genero: params.genero,
        apellidos: params.apellidos,
        telefono: params.telefono,
        web: params.web,
        nombreartistico: params.nombreartistico
    };

    callAjaxPost("bbdd/mybbdd.php", parameters, function (json) {

        if (success) {
            callback.success(json);
        } else {
            callback.error(json);
        }
    });
}

function success(e) {

    if (e["resultado"].toString().toLowerCase() === "success") {
        return true;
    }

    return false;
}

function successJSON(e) {

    if (e.json["resultado"].toString().toLowerCase() === "success") {
        return true;
    }

    return false;
}

function successRowsMatched(e) {
    var queryInfo = e["queryInfo"];
    var splittedQueryInfo = queryInfo.split(queryInfo.substring(queryInfo.indexOf(':') + 1)[0]);
    var rowsChanged = parseInt(splittedQueryInfo[2]);

    if (rowsChanged >= 1)
    {
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