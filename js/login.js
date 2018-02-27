onJqueryReady(function () {

    onJqueryWindowCallbackEvent(VModalMessage.CLOSING, {

        callback: function (e) {
            
            console.log("clickkk");
        }
    });

    onJqueryWindowCallbackEvent(VModalMessage.READY, {

        callback: function (e) {

            $("#input_login_btn").click(function () {

                var user = $("#input_username").val();
                var pass = $("#input_userpass").val();

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