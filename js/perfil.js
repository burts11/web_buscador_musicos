onJqueryWindowCallbackEventOne(VInfo.PERFIL_INFO, {

    callback: function (e) {
        switch (e.json["TipoUsuario"]) {

            case "Fan":
                cargarFan(e);
                break;
            case "Musico":
                cargarMusico(e);
                break;
            case "Local":
                break;
        }

        e.json.vparams.onDialogContentLoaded();
    }
});

function cargarMusico(e) {
    loadPage("perfil_musico", {

        success: function (result) {
            var rootPerfil = $('<div class="__root_perfil">').html(result);
            $("#perfil_info_container").append(rootPerfil);
        },
        error: function (result) {
            console.log(result);
        }
    });
}

function cargarFan(e) {
    loadPage("perfil_fan", {

        success: function (result) {
            var rootPerfil = $('<div class="__root_perfil">').html(result);
            $("#perfil_info_container").append(rootPerfil);
        },
        error: function (result) {
            console.log(result);
        }
    });
}
