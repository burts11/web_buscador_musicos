<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta http-equiv="X-UA-Compa    tible" content="IE=edge,chrome=1"> 
        <meta charset="UTF-8">  
        <link href="css/slick.css" rel="stylesheet" type="text/css"/>
        <link href="css/slick-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/base.css" rel="stylesheet" type="text/css"/>
        <link href="css/dialog.css" rel="stylesheet" type="text/css"/>
        <link href="css/vpopupmenu.css" rel="stylesheet" type="text/css"/>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <link href="css/jaudio.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery-filestyle.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/keys.js" type="text/javascript"></script>
        <script src="js/slick.min.js" type="text/javascript"></script>
        <script src="js/jaudio.js" type="text/javascript"></script>
        <script src="js/jquery.ba-outside-events.min.js" type="text/javascript"></script>
        <script src="js/jquery-filestyle.min.js" type="text/javascript"></script>
        <script src="js/vtoast.js" type="text/javascript"></script>
        <script src="js/vlog.js" type="text/javascript"></script>
        <script src="js/jquery-lang.js" charset="utf-8" type="text/javascript"></script>
        <script src="js/js.cookie.js" charset="utf-8" type="text/javascript"></script>
        <script src="js/jlang.js" type="text/javascript"></script>
        <script src="js/base.js" type="text/javascript"></script>
        <script src="js/baseFunc.js" type="text/javascript"></script>
        <script src="js/bbdd.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
        <script src="js/jquery.slides.min.js" type="text/javascript"></script>
        <script src="js/dynamically_page.js" type="text/javascript"></script>
        <script src="js/homepage.js" type="text/javascript"></script>
    </head>
    <style>
        .hrSeparator {

            height: 0.4em;
            border: 0;
            box-shadow: inset 0 0.4em 0.4em -0.4em rgba(0, 0, 0, 0.5);
        }

        .hrBottomSeparator {

            height: 2px;
            border: 0;
            box-shadow: inset 0 6px 6px -6px rgba(0, 0, 0, 0.5);
        }

        #_userMenu, #_userMenuLogoContainer {

            display: none;
        }

        #_userMenu{
            /*background-color: #e5e5e5;*/
            display: inline-block;
            position: relative;
            width: 300px;
            height: 100%;
            overflow: hidden;    
            float: right;
            border-radius: 6px;
        }

        #_userMenuLogo{
            position: relative;
            width: 48px;
            height: 48px;
        }

        .userMenuPic {

            width: 30%;
            height: 100%;
            position: relative;
            float: right;
        }

        .userMenuName, #_userMenuUserNameContainer {

            left: 40%;
            text-align: center;
            width: 20%;
            background-color: #f1f1f1;
            border-radius: 0px;
            padding: 10px;
            box-shadow: 0 10px 10px rgba(36,37,38,0.08);
            overflow: hidden;
        }

        .userMenuCerrarSesion{
            left: 75%;
            width: 25%;
            display: inline-block;
            text-align: center;
            font-size: 1em;
        }
        .footerInfoContainer {

            width: 100%;
            color: white;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .footerDiv{

            position: relative;
            display: inline-block;
            /*background-color: red;*/
            background-color: rgba(0,0,0,0.8);
            height: 0px;
            width: 100%;
        }

        .footer_company_label{

            display: inline-block;
            height: 30px; line-height: 30px; padding: 0;
        }

        #_loginContainer{
            display: none;
        }

        .footer_info {

            color: var(--textColorPrimary);
        }

        .divConciertos {
            width: 100%;
        }

    </style>
    <body>
        <!--rgb(35, 35, 35) DIALOG COLOR --> 
        <div class="mainDiv" id="_mainDiv">
            <div class="mainBackground"></div>
            <div class="mainSombra"></div>
            <div class="headerContainer" id="_mainHeader">
                <div class="headerDiv">
                    <div class="divLogo" id="_logoContainer">
                        <img id="logoImg" class="clickableElement centeredElementVertical" src="img/logo.png">
                    </div>
                    <div class="divIdiomas centeredElementVertical" id="_idiomasContainer">
                        <div class="idiomasContainer divPadding10 clickableElement vPopupTrigger" data-popup-container="popup1" >
                            <img id="idiomaFlag" class="clickableElement" style="display: none;">
                            <!--src="img/flags/es.png"-->
                        </div>
                    </div>
                    <div id="_mainMenu" class="divMenu divPadding10" id="menuPrincipalDiv">
                        <div class="menuItemContainer divPadding10 clickableElement" >
                            <a lang="es" data-lang-token="MenuBotonPrincipal" style="display: none;" data-href='pagina_principal' id="menuBtnHome" class="menuItem clickableElement">Página principal</a>
                        </div>
                    </div>
                    <div id="_rightMenu">
                        <div id="_searchDiv" class="inlineDiv clickableElement">
                            <img class="searchButtonImage clickableElement centeredElementVertical" src=img/search.png>
                        </div>
                        <div id="_loginDiv" style="display: none;">
                            <div class="userMenuChild divPadding10 centeredElementVertical loginDiv md-trigger" id="_loginContainer" data-modal="__login_modal">
                                <a lang="es" data-lang-token="MenuBotonLogin" class="clickableElement menuFontSize1" id="_loginButton">Iniciar Sesión</a>
                            </div>
                            <div class="userMenuChild divPadding10 md-trigger  centeredElementVertical " id="_registrarContainer" data-modal="__registro_modal">
                                <a lang="es" data-lang-token="MenuBotonRegistro" class="clickableElement menuFontSize1" id="_registerButton">Registrate</a>
                            </div>
                        </div>
                        <div id="_userMenu">
                            <div class="centeredElementVertical userMenuPic vPopupTrigger" id="_userMenuLogoContainer" data-popup-container="popupPerfil">
                                <img id="_userMenuLogo" class="clickableElement centeredElement " src="img/default_user_icon.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="_contentDiv" id="_divMainContent">
            </div>
            <div class="footerDiv">
                <div class="footerInfoContainer inlineDiv textoCentradoHorizontal">
                    <!--<label class="whiteText">Ooh Music</label>-->
                </div>
            </div>
        </div>

        <div class="vPopupMenuContainer" id="popup1">
            <div class="vPopupMenuItem" id="drop_idioma_es" data-modal='_editar_perfil_modal'>
                <img style="top: 50px; padding-right: 0.4em; " src="img/flags/es.png">
                <label style="vertical-align: top;"  lang="es" data-lang-token="Footer_CambiarIdioma_Castellano">Español</label>
            </div>
            <div class="vPopupMenuItem" id="drop_idioma_en">
                <img style="top: 2px; padding-right: 0.4em" src="img/flags/en.png">
                <label style="vertical-align: text-top;"  lang="es" data-lang-token="Footer_CambiarIdioma_Ingles">Inglés</label>
            </div>
        </div>
        <div class="vPopupMenuContainer" id="popupPerfil"  style="margin-right: 1em; width: auto">
            <div class="vPopupMenuItem" id="drop_editar_perfil" data-modal='_editar_perfil_modal'>
                <label>Editar Perfil</label>
            </div>
            <div class="vPopupMenuItem" id="drop_cerrar_sesion">
                <label>Cerrar Sesión</label>
            </div>
        </div>
        <script src="js/vmodal.js" type="text/javascript"></script>
        <script src="js/vpopupmenu.js" type="text/javascript"></script>
        <script src="js/index.js" type="text/javascript"></script>
        <!--<script src="js/pagina_principal.js" type="text/javascript"></script>-->
        <script>
            $("#euroBtn").click(function () {

                VModal.show("euromillones", "#euroBtn", {modalEffect: "md-effect-10", VModalId: "euromillones_modal", FullSize: "true"}, {
                    onDialogShow: function (ev) {

                        console.log(ev);
                        ev.vparams.onDialogContentLoaded();
                    },
                    onDialogClose: function (ev) {
                    }
                });
            });
        </script>
    </body>
</html>
