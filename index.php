<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="js/base.js" type="text/javascript"></script>
        <script src="js/bbdd.js" type="text/javascript"></script>
        <link href="css/base.css" rel="stylesheet" type="text/css"/>
        <link href="css/homepage.css" rel="stylesheet" type="text/css"/>
        <link href="css/header.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.slides.min.js" type="text/javascript"></script>
        <script src="js/dynamically_page.js" type="text/javascript"></script>
        <script src="js/homepage.js" type="text/javascript"></script>
        <script src="js/login.js" type="text/javascript"></script>
    </head>
    <style>
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
            width: 60%;
            height: 60%;
        }
        .userMenuPic {

            width: 30%;
            height: 100%;
            position: absolute;
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
            font-size: 20px;
        }
    </style>
    <body>

        <div class="mainDiv" id="_mainDiv">
            <div class="headerDiv">
                <div class="divLogo" id="_logoContainer">
                    <img id="logoImg" class="clickableElement" src="img/logo.png">
                </div>
                <div id="_mainMenu" class="divMenu divPadding10">
                    <div class="menuItemContainer divPadding10 clickableElement">
                        <a href="#pagina_principal" data-href='pagina_principal' id="menuBtnHome" class="menuItem clickableElement">Home</a>
                    </div>
                    <div class="menuItemContainer divPadding10 clickableElement" id="menuRegistroDiv">
                        <a href="#registro" data-href='registro' id="menuBtnRegistro" class=" clickableElement">Registro</a>
                    </div>
                </div>
                <div id="_rightMenu">
                    <div id="_loginDiv">
                        <div class="userMenuChild divPadding10 centeredElementVertical loginDiv md-trigger" id="_loginContainer" data-modal="__login_modal">
                            <a class="clickableElement" id="_loginButton" >Login</a>
                        </div>
                        <!--                        <div class="userMenuChild divPadding10 centeredElementVertical registerDiv md-trigger" id="_registerContainer" data-modal="__register_modal">
                                                    <a class="clickableElement userMenuUserName" id="_registerButton" >Registrarse</a>
                                                </div>-->
                    </div>
                    <div id="_userMenu">
                        <div class="centeredElementVertical userMenuPic" id="_userMenuLogoContainer">
                            <img id="_userMenuLogo" class="clickableElement centeredElement" src="img/default_user_icon.png">
                        </div>
                        <div class="centeredElementVertical userMenuName clickableElement" id="_userMenuUserNameContainer">
                            <a class="clickableElement userMenuUserName">TEST</a>
                        </div>
                        <div class="centeredElementVertical userMenuCerrarSesion" id="_userMenuCerrarSesionContainer" >
                            <a class="clickableElement">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="hrSeparator">
            <!--<img id="loading" src="img/ajax_load.gif" alt="loading" style="visibility:hidden;" />-->
            <div class="_contentDiv" id="_divMainContent">
            </div>
            <div class="footerDiv">
                <div id="divIdiomas"></div>
            </div>

        </div>
        <script src="js/vmodal.js" type="text/javascript"></script>
        <script src="js/index.js" type="text/javascript"></script>
    </body>
</html>
