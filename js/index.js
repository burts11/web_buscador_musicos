var currentUser = "";
var currentUserType = "";
var mainPageLoaded = false;
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

        $("#_searchDiv").hide();
        $("#_userMenu").hide();
        $("#menuRegistroDiv").hide();
        $("#menuPrincipalDiv").hide();
        $("#menuRegistroDiv").hide();
        $("#_mainMenu").hide();
        $("#_logoContainer").hide().show("slow");
        $("#_loginDiv").hide();
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

// El usuario no ha iniciado sesión
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
//        VToast.logS("Usuario Logueado");
//        console.log(e);
//        VToast.logF("Usuario Logueado");
        Usuario.asignar(e.id, e.nombre, e.privilegio);
        switch (e["privilegio"]) {

            case "Administrador":
//                cambiarPagina("pagina_principal");
                cambiarHash("pagina_principal");
                break;
            case "Fan":
                Main.agregarMenuBtn("pagina_fan", "menuBtnUserHome", "Inicio");
//                cambiarPagina("pagina_fan");
                cambiarHash("pagina_fan");
                $("#menuBtnHome").show();
                break;
            case "Musico":
                Main.agregarMenuBtn("pagina_musico", "menuBtnUserHome", "Inicio");
//                cambiarPagina("pagina_musico");
                cambiarHash("pagina_musico");
                $("#menuBtnHome").show();
                break;
            case "Local":
                Main.agregarMenuBtn("pagina_local", "menuBtnUserHome", "Inicio");
//                cambiarPagina("pagina_local");
                cambiarHash("pagina_local");
                $("#menuBtnHome").show();
                break;
            default:

                $("#menuBtnHome").fadeOut();
//                cambiarPagina("pagina_principal");
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
        cambiarHash("pagina_principal");
        window.location.reload();
    },
    agregarMenuBtn: function (href, id, texto) {
        $("#_mainMenu").find("#" + id).parent(".menuItemContainer").remove();
        $("#_mainMenu").find("#" + id).remove();
        var menuBtn = '<div class="menuItemContainer divPadding10 clickableElement">' +
                '                        <a lang="es" data-lang-token="MenuBotonHome" href="#' + href + '" data-href=\'' + href + '\' id="' + id + '" class="clickableElement">' + texto + '</a>' +
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

        if (!success(e)) {
            if (!mainPageLoaded) {
                cambiarPagina("pagina_principal");
                mainPageLoaded = true;
            } else {
                cambiarHash("p");
                cambiarHash("pagina_principal");
            }
        } else {
            onHashCambiado();
        }

//        var url = window.location.href;
//        if (url.indexOf('#') > -1)
//        {
//            var cur = url.substr(url.indexOf("#") + 1);
//            cambiarPagina(cur);
//            var menuBtn = $("#_mainMenu > div > a[data-href='" + cur + "']");
//            setActive(menuBtn);
//        } else {
//
//            if (!success(e)) {
//
//                cambiarPagina("pagina_principal");
//                var menuHome = $("#menuBtnHome");
//                setActive(menuHome);
//                return;
//            }
//
//            var menuHome = $("#menuBtnHome");
//            setActive(menuHome);
//        }
    }
};

if (window.history && window.history.pushState) {

    $(window).on('popstate', function () {

        onHashCambiado();
    });
}

function onHashCambiado() {
    var divMainContent = $("#_divMainContent");
    $(divMainContent).empty();
    var url = window.location.href;
    if (url.indexOf('#') > -1)
    {
        var cur = url.substr(url.indexOf("#") + 1);
        console.log("HASH CAMBIADO -> " + cur);
        
        if (cur === "" && $(divMainContent).children().length === 0) {
            cambiarHash("pagina_principal");
            return;
        }

        cambiarPagina(cur);
        var menuBtn = $("#_mainMenu > div > a[data-href='" + cur + "']");
        setActive(menuBtn);

        Main.cambiarTitulo($(menuBtn).text());
    }
}

onJqueryWindowCallbackEvent(VMessage.PAGINA_POPUP_MENU_ITEM_CLICKED, {

    callback: function (e) {

        console.log(e);
        switch (e.json.id) {
            case "drop_idioma_es":
                var img = $("#" + e.json.id + " > img").attr("src");
                $("#idiomaFlag").attr("src", img);
                JLang.cambiarIdioma("es");
                break;
            case "drop_idioma_en":
                var img = $("#" + e.json.id + " > img").attr("src");
                $("#idiomaFlag").attr("src", img);

                JLang.cambiarIdioma("en");
                break;
            case "drop_editar_perfil":
                var item = $("#" + "drop_editar_perfil");
                VModal.show("perfil", item, {modalEffect: "md-effect-15", VModalId: "index_show_perfil"}, {
                    onDialogShow: function (ev) {

                        var logoSrc = $("#_userMenuLogo").prop("src");
                        ev["logo"] = logoSrc;
                        ev["TipoUsuario"] = Usuario.privilegio;
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

    mostrarSesion();
    Main.comprobarUsuarioLogueado();

    setTimeout(function () {

        JLang.cargarIdiomaDefault(function (idiomaId) {
            console.log("Idioma id -> " + idiomaId);
            $("#idiomaFlag").attr("src", "img/flags/" + idiomaId + ".png");
            $("#idiomaFlag").hide().fadeIn();
        });
    }, 5);

    $("#_searchDiv").hide().fadeIn();

    $("#_logoContainer").click(function () {

        window.location.reload();
    });

    $("#_registrarContainer").unbind("click").bind("click", function (e) {

        VModal.show("registro", "#_registrarContainer", {
            modalEffect: "vModalFadeIn-show",
            VModalId: "buscar_modal",
            CustomSize: "true",
            modalWidth: "98%",
            modalHeight: "95%",
            CustomPadding: "true",
            padding: "0px",
            ContentPadding: "0px",
            enableScrollBar: "true"
        }, {
            onDialogShow: function (ev) {

//                console.log(ev);
//                ev.vparams.onDialogContentLoaded();
                callJqueryWindowEvent(VInfo.REGISTRAR_INFO, ev);
            },
            onDialogClose: function (ev) {
            }
        });
    });

    $("#_loginContainer").click(function (e) {

        VModal.show("login", "", {modalEffect: "vModalFadeIn-show", VModalId: "index_show_login", CustomPadding: "true",
            padding: "0px", modalTop: "20%"}, {
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
            modalWidth: "100%",
            modalHeight: "100%",
            CustomPadding: "true",
            padding: "0px",
            CustomMargin: "0px",
            BackgroundColor: "rgba(47, 47, 47, 0.85)"
        }, {
            onDialogShow: function (ev) {

//                console.log(ev);
                ev.vparams.onDialogContentLoaded();
            },
            onDialogClose: function (ev) {
            }
        });
    });


    $("#idiomaFlag").click(testFileManager);

    function testFileManager() {

        callAjaxTest("bbdd/FileManager.php", "text", {action: "ListarArchivos", path: "nocopyright/audio/tracks"}, function (result) {

            console.log(result);
        });
//
//        callAjaxPost("bbdd/FileManager.php",{ action: "CrearCarpeta", ruta: "userdata/test/img"}, function (result) {
//
//            console.log(result);
//        });
    }

    function callAjaxTest(url, type, dataJSON, func) {

        $.ajax({
            type: "POST",
            url: url,
            dataType: type,
            data: dataJSON,
            cache: false,
            success: function (rawJson) {

//                var json = $.parseJSON(rawJson);
                func(rawJson);
            },
            error: function (err) {

                var dataJSON = {
                    resultado: "error",
                    errorResponse: err
                };
                func(dataJSON);
            }
        });
    }
});

