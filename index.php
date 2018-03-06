<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta charset="UTF-8">  
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/vtoast.js" type="text/javascript"></script>
        <script src="js/js.cookie.js" charset="utf-8" type="text/javascript"></script>
        <script src="js/jquery-lang.js" charset="utf-8" type="text/javascript"></script>
        <script src="js/base.js" type="text/javascript"></script>
        <script src="js/baseFunc.js" type="text/javascript"></script>
        <script src="js/bbdd.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
        <link href="css/base.css" rel="stylesheet" type="text/css"/>
        <link href="css/vpopupmenu.css" rel="stylesheet" type="text/css"/>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.slides.min.js" type="text/javascript"></script>
        <script src="js/dynamically_page.js" type="text/javascript"></script>
        <script src="js/homepage.js" type="text/javascript"></script>
        <script src="js/login.js" type="text/javascript"></script>
    </head>
    <style>
        .headerDiv{

            width: 100%;
            height: 8%;
            position: relative;
            display: inline-block;
        }

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

        #_rightMenu{

            position: relative; 

            display: inline-block;
            width: auto;
            height: 100%;
            float: right; 
            margin-right: 10px;
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
            padding: 2em;
        }

        .footerDiv{

            position: relative;
            display: inline-block;
            /*background-color: red;*/
            /*background-color: #b7b7b7;*/
            height: auto;
            width: 100%;
        }

        .footer_company_label{

            display: inline-block;
            height: 30px; line-height: 30px; padding: 0;
        }

        #_loginContainer{
            display: none;
        }

        #_loginButton{

            /*visibility: hidden;*/
            font-size: 1.1em;
        }

        .footer_info {

            color: var(--textColorPrimary);
        }

        .divConciertos {
            width: 100%;
        }


        .divIdiomas{
            position: relative;
            display: inline-block;
            overflow: hidden;    
            /*background-color: red;*/
        }

        .idiomasContainer{
            border: 1px;
            border-radius: 0.5em;
            border-width: 0.5em;
            display: inline-block;
            padding: 0.9em;
            /*background-color: #222;*/
        }

        #idiomaFlag{

            position: relative;
            width: 24px;
            height: 24px;
            min-height: 20px;
            min-width: 20px;
        }
    </style>
    <body>
        <div class="mainDiv" id="_mainDiv">
            <div class="headerDiv">
                <div class="divLogo" id="_logoContainer">
                    <img id="logoImg" class="clickableElement" src="img/logo.png">
                </div>
                <div class="divIdiomas centeredElementVertical" id="_idiomasContainer">
                    <div class="idiomasContainer divPadding10 clickableElement vPopupTrigger" data-popup-container="popup1" >
                        <img id="idiomaFlag" class="clickableElement" src="img/flags/es.png">
                        <a lang="es" data-lang-token="Footer_CambiarIdioma" id="_languageSwitchButton" class="menuItem clickableElement whiteText"></a>
                    </div>
                </div>
                <div id="_mainMenu" class="divMenu divPadding10" id="menuPrincipalDiv">
                    <div class="menuItemContainer divPadding10 clickableElement">
                        <a lang="es" data-lang-token="MenuBotonPrincipal" href="#pagina_principal" data-href='pagina_principal' id="menuBtnHome" class="menuItem clickableElement">Página principal</a>
                    </div>
                    <div class="menuItemContainer divPadding10 clickableElement" id="menuRegistroDiv">
                        <a lang="es" data-lang-token="MenuBotonRegistro" href="#registro" data-href='registro' id="menuBtnRegistro" class=" clickableElement">Registro</a>
                    </div>
                </div>
                <div id="_rightMenu">
                    <div id="_loginDiv">
                        <div class="userMenuChild divPadding10 centeredElementVertical loginDiv md-trigger" id="_loginContainer" data-modal="__login_modal">
                            <a lang="es" data-lang-token="MenuBotonLogin" class="clickableElement" id="_loginButton">Iniciar Sesión</a>
                        </div>
                    </div>
                    <div id="_userMenu">
                        <div class="centeredElementVertical userMenuPic vPopupTrigger" id="_userMenuLogoContainer" data-popup-container="popupPerfil">
                            <img id="_userMenuLogo" class="clickableElement centeredElement " src="img/default_user_icon.png">
                        </div>
                    </div>
                </div>
            </div>
            <hr class="hrSeparator">
            <div class="_contentDiv" id="_divMainContent">
            </div>
            <div class="footerDiv">
                <div class="footerInfoContainer inlineDiv textoCentradoHorizontal"></div>
            </div>
        </div>
        <div class="vPopupMenuContainer" id="popup1">
            <div class="vPopupMenuItem" id="drop_idioma_castellano" data-modal='_editar_perfil_modal'>
                <img style="top: 50px; padding-right: 0.4em; " src="img/flags/es.png">
                <label style="vertical-align: top;"  lang="es" data-lang-token="Footer_CambiarIdioma_Castellano">Español</label>
            </div>
            <div class="vPopupMenuItem" id="drop_idioma_ingles">
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
        <script src="js/pagina_principal.js" type="text/javascript"></script>
        <script src="js/jlang.js" type="text/javascript"></script>
    </body>
</html>
