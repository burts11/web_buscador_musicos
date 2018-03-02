onJqueryReady(function () {

    onJqueryWindowCallbackEventOne(VInfo.LOGIN_INFO, {

        callback: function (e) {
            $("#input_login_btn").click(function () {

                var user = $("#input_username").val();
                var pass = $("#input_userpass").val();
                if ((user === "" || pass === ""))
                {
                    console.log("No se han introducido un usuario o contraseña válido");
                    return;
                }
                iniciarSesion(user, pass, {

                    success: function (json) {

                        e.json.vparams.close();
                        Main.comprobarUsuarioLogueado();
                    },
                    error: function (json) {
                        e.json.vparams.close();
                    }
                });
            });

            e.json.vparams.onDialogContentLoaded();
        }
    });
});

