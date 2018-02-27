<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
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

        .footerDiv{

            position: relative;
            display: inline-block;
            /*background-color: red;*/
            height: 7%;
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

        .dropDown_container {
            position: absolute;
            display: none;
            background-color: white;
            padding: 1em;
            border-radius: 0.5em;
            box-shadow: 0 0px 10px rgba(36,37,38,0.7);
        }

        .dropDown_Item{
            padding: 0.5em;
            cursor: pointer;
        }

        .dropDown_Item:hover, .dropDown_Item:focus{

            background-color: #f1f1f1;
            padding: 0.5em;
            position: relative;
            display: inline-block;
            border-radius: 0.5em;
        }

        .dropDown_Item label{
            cursor: pointer;
            border-radius: 0.5em;
            color: var(--textColorPrimary);
        }

        .dropDown_container-show{

            visibility: visible;
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
                        <a href="#pagina_principal" data-href='pagina_principal' id="menuBtnHome" class="menuItem clickableElement">Página principal</a>
                    </div>
                    <div class="menuItemContainer divPadding10 clickableElement" id="menuRegistroDiv">
                        <a href="#registro" data-href='registro' id="menuBtnRegistro" class=" clickableElement">Registro</a>
                    </div>
                </div>
                <div id="_rightMenu">
                    <div id="_loginDiv">
                        <div class="userMenuChild divPadding10 centeredElementVertical loginDiv md-trigger" id="_loginContainer" data-modal="__login_modal">
                            <a class="clickableElement" id="_loginButton">Login</a>
                        </div>
                    </div>
                    <div id="_userMenu">
                        <div class="centeredElementVertical userMenuPic dropDown_Trigger" id="_userMenuLogoContainer">
                            <img id="_userMenuLogo" class="clickableElement centeredElement " src="img/default_user_icon.png">
                        </div>
                        <!--                        <div class="centeredElementVertical userMenuName clickableElement" id="_userMenuUserNameContainer">
                                                    <a class="clickableElement userMenuUserName"></a>
                                                </div>
                                                <div class="centeredElementVertical userMenuCerrarSesion" id="_userMenuCerrarSesionContainer" >
                                                    <a class="clickableElement">Cerrar Sesión</a>
                                                </div>-->
                    </div>
                </div>
            </div>
            <hr class="hrSeparator">
            <div class="_contentDiv" id="_divMainContent">
            </div>
            <hr class="hrBottomSeparator">
            <div class="footerDiv">
                <div class="footer_info centeredElement">
                    <label class="footer_company_label">Music</label>
                </div>
            </div>
        </div>
        <div class="dropDown_container">
            <div class="dropDown_Item" id="drop_editar_perfil" data-modal='_editar_perfil_modal'>
                <label>Editar Perfil</label>
            </div>
            <div class="dropDown_Item" id="drop_cerrar_sesion">
                <label>Cerrar Sesión</label>
            </div>
        </div>
        <script src="js/dropdown.js" type="text/javascript"></script>
        <script src="js/vmodal.js" type="text/javascript"></script>
        <script src="js/index.js" type="text/javascript"></script>
    </body>
</html>
