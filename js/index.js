var currentUser = "";
var currentUserType = "";

var Main = {

    inicio: function () {

        $("#_userMenu").hide();
        $("#menuRegistroDiv").hide();

        $("#menuPrincipalDiv").hide();
        $("#menuRegistroDiv").hide();

        $("#_mainMenu").hide();
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

                    $("#_userMenuLogo").hide().fadeIn();
                    $("#_userMenu").show();
                    $("#_mainMenu").hide().fadeIn("slow");

                    $("#menuRegistroDiv").hide();
                    $("#menuPrincipalDiv").hide();
                    $("#_userMenuLogoContainer").show("slow");

                    $("#_userMenuLogo").click(function (e) {

                    });

                    Main.onUsuarioLogueado(e);
                } else {

// El usuario no ha iniciado sesion
                    $("#_userMenu").hide();

                    $("#_mainMenu").hide().fadeIn();
                    $("#menuPrincipalDiv").hide().fadeIn();
                    $("#menuRegistroDiv").hide().fadeIn();

                    $("#_loginContainer").fadeIn();
                    $("#_loginDiv").fadeIn();

                    var menuHome = $("#menuBtnHome");
                    setActive(menuHome);
                }
            }

            Main.seleccionarBotonMenu(e);
        }))
            ;
    },
    onUsuarioLogueado: function (e)
    {
        console.log(e);

        switch (e["privilegio"]) {

            case "Administrador":
//                Main.agregarMenuBtn("pagina_principal", "menuBtnUserHome", "Home");
                cambiarPagina("pagina_principal");
//                cambiarHash("pagina_principal");
                break;
            case "Fan":
                Main.agregarMenuBtn("pagina_fan", "menuBtnUserHome", "Home");
                cambiarPagina("pagina_fan");
                cambiarHash("pagina_fan");
                break;
            case "Musico":
                Main.agregarMenuBtn("pagina_musico", "menuBtnUserHome", "Home");

                cambiarPagina("pagina_musico");
//                cambiarHash("pagina_musico");
                break;
            case "Local":
                Main.agregarMenuBtn("pagina_local", "menuBtnUserHome", "Home");

                cambiarPagina("pagina_local");
                cambiarHash("pagina_local");
                break;
            default:
                cambiarPagina("pagina_principal");
                cambiarHash("pagina_principal");
                break;
        }

        var menuHome = $("#menuBtnUserHome");
        setActive(menuHome);
        asignarBotonesMenu();
        Main.cambiarLogo(e);
    },
    onSesionFinalizada: function (e) {
        $("#menuBtnHome").attr("data-href", "pagina_principal");
        $("#menuBtnHome").attr("href", "#pagina_principal");
        cambiarPagina("pagina_principal");
        window.location.hash = "pagina_principal";

        $("#menuBtnUserHome").remove();
    },
    agregarMenuBtn: function (href, id, texto) {
//        alert("called");
        $("#_mainMenu").find("#" + id).parent(".menuItemContainer").remove();
        $("#_mainMenu").find("#" + id).remove();

        var menuBtn = '<div class="menuItemContainer divPadding10 clickableElement">' +
                '                        <a href="#' + href + '" data-href=\'' + href + '\' id="' + id + '" class="clickableElement">' + texto + '</a>' +
                '                    </div>';

        $("#_mainMenu").append(menuBtn);
    },
    obtenerUserDataPath: function (userName) {

        return "userdata/" + userName + "/";
    },
    cambiarLogo: function (e) {

        var fullPath = Main.obtenerUserDataPath(e.user) + "img/user_logo.png";
        $("#_userMenuLogo").prop("src", fullPath);
    },
    seleccionarBotonMenu: function (e) {
        var url = window.location.href;
        if (url.indexOf('#') > -1)
        {
            var cur = url.substr(url.indexOf("#") + 1);
            cambiarPagina(cur);
            var menuBtn = $("#_mainMenu > div > a[data-href='" + cur + "']");
            setActive(menuBtn);
        } else {

            if (!success(e)) {

                cambiarPagina("pagina_principal");
                var menuHome = $("#menuBtnHome");
                setActive(menuHome);
                console.log("PRUEBA");
                return;
            }

            var menuHome = $("#menuBtnHome");
            setActive(menuHome);
        }
    }
};

onJqueryWindowCallbackEvent(VMessage.PAGINA_DROP_DOWN_ITEM_CLICKED, {

    callback: function (e) {

        switch (e.json.id) {

            case "drop_editar_perfil":

                console.log("tes");
                var item = $("#" + "drop_editar_perfil");
                VModal.show("perfil", item, { modalEffect: "md-effect-2" }, {
                    onDialogShow: function (ev) {
                    },
                    onDialogClose: function (ev) {
                    }
                });

                break;
            case "drop_cerrar_sesion":

                cerrarSesion({

                    success: function (json) {

                        Main.comprobarUsuarioLogueado();
                        Main.onSesionFinalizada(json);
                    },
                    error: function (json) {

                    }
                });

                break;
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

        VModal.show("login", this, { modalEffect: "md-effect-2" }, {
            onDialogShow: function (ev) {

            },
            onDialogClose: function (ev) {
            }
        });
    });

    mostrarSesion();
    Main.comprobarUsuarioLogueado();
});

