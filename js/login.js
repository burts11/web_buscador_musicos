onJqueryWindowCallbackEventOne(VInfo.LOGIN_INFO, {

    callback: function (e) {

        e.json.vparams.onDialogContentLoaded();
        inicializarJValidator();

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

            if (!$("#login_form").valid())
            {
                VToast.mostrarError("Debes escribir un usuario y una contraseña!");
                return;
            }
            
            var user = $("#input_username").val();
            var pass = $("#input_userpass").val();

            iniciarSesion(user, pass, {

                success: function (json) {
                    e.json.vparams.close();
                    Main.comprobarUsuarioLogueado();
                },
                error: function (json) {

                    VToast.mostrarError("El nombre de usuario o la contraseña es incorrecta!");
                }
            });
        }

        function inicializarJValidator() {
            $.validator.messages.required = '';
            $("#login_form").validate({
                showErrors: function (errorMap, errorList) {
                },
                onfocusout: false,
                onkeyup: false,
                rules: {
                    input_username: "required",
                    input_userpass: "required"
                }
            });
        }
    }
});

