onJqueryReady(function () {

    onJqueryWindowCallbackEvent(VModalMessage.CLOSING, {

        callback: function (e) {

            console.log("clickkk");
        }
    });

    onJqueryWindowCallbackEventOne(VModalMessage.READY, {

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
                        VModal.closeWithId(e.json.modalId);
                        Main.comprobarUsuarioLogueado();
                    },
                    error: function (json) {
                        VModal.closeWithId(e.json.modalId);
                    }
                });
            });
        }
    });
});