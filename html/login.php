<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/login.js" type="text/javascript"></script>
    </head>
    <style>
        #l_loginDiv {
            position: relative;
            text-align: center;
        }

        .loginCon .form-control .form-control-label{

            position: relative;
            display: inline-block;
            width:auto;
            text-align:left;
            min-width: 3em;
        }

        .loginCon .form-control .form-control-textfield{
            display: inline-block;
            width:60%;
            overflow: hidden;
        }
    </style>
    <body>
        <div class="_childContainer loginCon">
            <h1 lang='es' data-lang-token='DialogLogin_Titulo' class="tituloH1 tituloH1-Grey">Iniciar Sesión</h1>
            <hr class="hrSeparator_dialog"> 
            <div class="form-container">
                <div class="form-control">
                    <label lang='es' data-lang-token='DialogLogin_Usuario' class="form-control-label" for="input_username">Usuario</label> <input class="form-control-textfield" type="text" id="input_username" value="" required>
                </div>
                <div class="form-control">
                    <label lang='es' data-lang-token='DialogLogin_Pass' class="form-control-label" for="input_userpass">Contraseña</label> <input class="form-control-textfield" type="text" id="input_userpass" value="" required>
                </div>
            </div>
            <div class="centeredElementHorizontal" id="l_loginDiv">
                <button lang='es' data-lang-token='DialogLogin_Submit' class="form-control-btn" id="input_login_btn">Entrar</button> 
            </div>
        </div>
    </body>
</html>


