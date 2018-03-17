onJqueryWindowCallbackEventOne(VInfo.PERFIL_INFO, {

    callback: function (e) {

        $("#perfil_info_logo").prop("src", e.json.logo).fadeIn();
        $(".perfil_info_detalles").fadeIn();

        e.json.vparams.onDialogContentLoaded();
    }
});