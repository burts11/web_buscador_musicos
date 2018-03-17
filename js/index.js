var currentUser = "";
var currentUserType = "";

var Usuario = {

    id: "",
    nombre: "",
    privilegio: "",

    asignar: function (id, nombre, privilegio) {

        this.id = id;
        this.nombre = nombre;
        this.privilegio = privilegio;
    }
};

var Main = {

    cambiarTitulo: function (titulo) {
        document.title = titulo;
    },
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
        VToast.logS("Usuario Logueado");
        console.log(e);
        VToast.logF("Usuario Logueado");

        Usuario.asignar(e.id, e.nombre, e.privilegio);

        switch (e["privilegio"]) {

            case "Administrador":
                cambiarPagina("pagina_principal");
                cambiarHash("pagina_principal");
                Main.cambiarTitulo("Home");
                break;
            case "Fan":
                Main.agregarMenuBtn("pagina_fan", "menuBtnUserHome", "Home");
                cambiarPagina("pagina_fan");
                cambiarHash("pagina_fan");
                Main.cambiarTitulo("Home - Fan");
                break;
            case "Musico":
                Main.agregarMenuBtn("pagina_musico", "menuBtnUserHome", "Home");
                cambiarPagina("pagina_musico");
                cambiarHash("pagina_musico");
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
        $("#menuBtnUserHome").remove();

        window.location.reload();
    },
    agregarMenuBtn: function (href, id, texto) {
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
                return;
            }

            var menuHome = $("#menuBtnHome");
            setActive(menuHome);
        }
    }
};

onJqueryWindowCallbackEvent(VMessage.PAGINA_POPUP_MENU_ITEM_CLICKED, {

    callback: function (e) {

        console.log(e);

        switch (e.json.id) {
            case "drop_idioma_castellano":

                var img = $("#" + e.json.id + " > img").attr("src");
                $("#idiomaFlag").attr("src", img);

                window.lang.change("es");
                break;
            case "drop_idioma_ingles":
                var img = $("#" + e.json.id + " > img").attr("src");
                $("#idiomaFlag").attr("src", img);

                window.lang.change("en");
                break;
            case "drop_editar_perfil":

                console.log("drop_editar_perfil clicked");
                var item = $("#" + "drop_editar_perfil");
                VModal.show("perfil", item, {modalEffect: "md-effect-15", VModalId: "index_show_perfil"}, {
                    onDialogShow: function (ev) {

                        var logoSrc = $("#_userMenuLogo").prop("src");
                        ev["logo"] = logoSrc;
                        callJqueryWindowEvent(VInfo.PERFIL_INFO, ev);
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

    $("#_registrarContainer").click(function (e) {

        VModal.show("registro", "#_registrarContainer", {
            modalEffect: "md-effect-15",
            VModalId: "buscar_modal",
            CustomSize: "true",
            modalWidth: "98%",
            modalHeight: "98%",
            CustomPadding: "true",
            padding: "0px"
        }, {
            onDialogShow: function (ev) {

                console.log(ev);
                ev.vparams.onDialogContentLoaded();
            },
            onDialogClose: function (ev) {
            }
        });
    });

    $("#_loginContainer").click(function (e) {

        VModal.show("login", "", {modalEffect: "md-effect-13", VModalId: "index_show_login"}, {
            onDialogShow: function (ev) {

                ev["vparams"]["sender"] = "login";
                callJqueryWindowEvent(VInfo.LOGIN_INFO, ev);
            },
            onDialogClose: function (ev) {
            }
        });
    });

    $("#_searchDiv").click(function () {

        VModal.show("buscar_modal", "#searchDiv", {
            modalEffect: "md-effect-15",
            VModalId: "buscar_modal",
            CustomSize: "true",
            modalWidth: "98%",
            modalHeight: "98%",
            CustomPadding: "true",
            padding: "0px"
        }, {
            onDialogShow: function (ev) {

                console.log(ev);
                ev.vparams.onDialogContentLoaded();
            },
            onDialogClose: function (ev) {
            }
        });
    });

    mostrarSesion();
    Main.comprobarUsuarioLogueado();
});

