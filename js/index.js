var currentUser = "";
var currentUserType = "";

var Main = {

    inicio: function () {

        $("#_userMenu").hide();
        $("#menuRegistroDiv").hide();
        $("#_userMenuLogoContainer").hide();
        $("#_userMenuUserNameContainer").hide();
        $("#_userMenuCerrarSesionContainer").hide();
        $("#_mainMenu").hide().fadeIn("slow");
        $("#_logoContainer").hide().show("slow");
    },
    comprobarUsuarioLogueado: function () {
        if (usuarioLogueado(function (e) {

            if (e !== null)
            {
                if (success(e)) {

                    // Usuario logueado
                    currentUser = e.user;
                    $("#_loginDiv").hide();
                    $("#_userMenu").show();
                    $("#menuRegistroDiv").hide();
                    $("#_userMenuLogoContainer").show("slow");
                    $("#_userMenuUserNameContainer").show("slow");
                    $("#_userMenuUserNameContainer a").hide().text(e.user.toUpperCase()).fadeIn();
                    $("#_userMenuCerrarSesionContainer").hide().fadeIn();
                    $("#_userMenuLogo").click(function (e) {

                    });
                    Main.onUsuarioLogueado(e);
                } else {

// El usuario no ha iniciado sesion
                    $("#_userMenu").hide();
                    $("#_loginDiv").hide().show("slow");
                    $("#menuRegistroDiv").show("slow");
                    var menuHome = $("#menuBtnHome");
                    setActive(menuHome);
                }
            }

            callJqueryWindowEvent("page.logchecked", e);
        }))
            ;
    },
    onUsuarioLogueado: function (e)
    {
        console.log(e);

        switch (e["privilegio"]) {

            case "Administrador":
                $("#menuBtnHome").attr("data-href", "pagina_principal");
                $("#menuBtnHome").attr("href", "#pagina_principal");
                cambiarPagina("pagina_principal");
                window.location.hash = "pagina_principal";
                break;
            case "Fan":
                $("#menuBtnHome").attr("data-href", "pagina_fan");
                $("#menuBtnHome").attr("href", "#pagina_fan");
                cambiarPagina("pagina_fan");
                window.location.hash = "pagina_fan";
                break;
            case "Musico":
                $("#menuBtnHome").attr("data-href", "pagina_musico");
                $("#menuBtnHome").attr("href", "#pagina_musico");
                cambiarPagina("pagina_musico");
                window.location.hash = "pagina_musico";
                break;
            case "Local":
                $("#menuBtnHome").attr("data-href", "pagina_local");
                $("#menuBtnHome").attr("href", "#pagina_local");
                cambiarPagina("pagina_local");
                window.location.hash = "pagina_local";
                break;
            default:
                $("#menuBtnHome").attr("data-href", "pagina_principal");
                $("#menuBtnHome").attr("href", "#pagina_principal");
                cambiarPagina("pagina_principal");
                window.location.hash = "pagina_principal";
                break;
        }

        Main.cambiarLogo(e);
    },
    onSesionFinalizada: function (e) {
        $("#menuBtnHome").attr("data-href", "pagina_principal");
        $("#menuBtnHome").attr("href", "#pagina_principal");
        cambiarPagina("pagina_principal");
        window.location.hash = "pagina_principal";
    },
    agregarMenuBtn: function () {

    },
    obtenerUserDataPath: function (userName) {

        return "userdata/" + userName + "/";
    },
    cambiarLogo: function (e) {

        var fullPath = Main.obtenerUserDataPath(e.user) + "img/user_logo.png";
        $("#_userMenuLogo").prop("src", fullPath);
    }
};

onJqueryWindowCallbackEvent("page.logchecked", {

    callback: function (e) {

        var url = window.location.href;
        if (url.indexOf('#') > -1)
        {
            var cur = url.substr(url.indexOf("#") + 1);
            cambiarPagina(cur);
            var menuBtn = $("#_mainMenu > div > a[data-href='" + cur + "']");
            setActive(menuBtn);
        } else {

            if (!success(e.json)) {
                var menuHome = $("#menuBtnHome");
                setActive(menuHome);
                cambiarPagina("pagina_principal");
                return;
            }

            var menuHome = $("#menuBtnHome");
            setActive(menuHome);
        }
    }
});

onJqueryReady(function () {

    Main.inicio();

    onJqueryCallbackEvent(BBDD.LOGIN, {
        callback: function () {

        }
    });

    $("#_loginContainer").click(function (e) {

        VModal.show("login", this, {
            onDialogShow: function (ev) {
            },
            onDialogClose: function (ev) {
            }
        });
    });

    $("#_userMenuCerrarSesionContainer").click(function () {

        cerrarSesion({

            success: function (json) {

                Main.comprobarUsuarioLogueado();
                Main.onSesionFinalizada(json);
            },
            error: function (json) {

            }
        });
    });

    mostrarSesion();
    Main.comprobarUsuarioLogueado();
});

