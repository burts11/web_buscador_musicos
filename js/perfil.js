onJqueryWindowCallbackEventOne(VInfo.PERFIL_INFO, {

    callback: function (e) {
        switch (e.json["TipoUsuario"]) {

            case "Fan":
                cargarHtml("perfil_fan", e);
                break;
            case "Musico":
                cargarHtml("perfil_musico", e);
                break;
            case "Local":
                cargarHtml("perfil_local", e);
                break;
        }

        e.json.vparams.onDialogContentLoaded();
    }
});

function cargarHtml(id, e) {

    loadPage(id, {

        success: function (result) {
            var rootPerfil = $('<div class="__root_perfil">').html(result);
            $("#perfil_info_container").append(rootPerfil);
            callJqueryWindowEvent(VInfo.PERFIL_INFO_UNKNOWN, e.json);
        },
        error: function (result) {
            console.log(result);
        }
    });
}
