onJqueryWindowCallbackEventOne(VInfo.LOGIN_INFO, {

    callback: function (e) {

        e.json.vparams.onDialogContentLoaded();

        $("#input_username").on("keydown", function (event) {
            if (event.which === Key.ENTER) {
                login();
            }
        });

        $("#input_userpass").on("keydown", function (event) {
            if (event.which === Key.ENTER) {
                login();
            }
        });

        $("#input_login_btn").click(function () {

            login();
        });

        function login() {

            var user = $("#input_username").val();
            var pass = $("#input_userpass").val();
            if ((user === "" || pass === ""))
            {
                console.log("No se han introducido un usuario o contraseña válido");
                return;
            }

            iniciarSesion(user, pass, {

                success: function (json) {
                    console.log("Login success -> ");
                    console.log(json);
                    e.json.vparams.close();
                    Main.comprobarUsuarioLogueado();
                },
                error: function (json) {

                    console.log("Login error -> ");
                    console.log(json);

                    e.json.vparams.close();
                }
            });
        }
    }
});

