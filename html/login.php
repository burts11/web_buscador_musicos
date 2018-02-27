<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <style>
        #l_loginDiv {
            position: relative;
            text-align: center;
        }

        .loginCon .form-control .form-control-label{

            float: left;
            width:20%;
            text-align:left;
        }

        .loginCon .form-control .form-control-textfield{

            margin-right: 1em;
            width:60%;
        }
    </style>
    <body>
        <div class="_childContainer loginCon">
            <h1 class="tituloH1 tituloH1-Grey">Iniciar Sesión</h1>
            <hr class="hrSeparator_dialog"> 
            <div class="form-container">
                <div class="form-control">
                    <label class="form-control-label" for="input_username">Usuario</label> <input class="form-control-textfield" type="text" id="input_username" value="">
                </div>
                <div class="form-control">
                    <label class="form-control-label" for="input_userpass">Contraseña</label> <input class="form-control-textfield" type="text" id="input_userpass" value="">
                </div>
            </div>
            <div class="centeredElementHorizontal" id="l_loginDiv">
                <button class="form-control-btn" id="input_login_btn">Entrar</button> 
            </div>
        </div>
        <script src="../js/login.js" type="text/javascript"></script>
    </body>
</html>


