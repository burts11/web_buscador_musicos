<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <style>
        .form-container{

            width: auto;
            height: 100%;
            position:  relative;
            display: block;
            /*background-color: red;*/
            padding: 10px;
        }

        .form-control-margin {

            margin-bottom: 4px;
        }

        .form-control  {

            position: relative;
            display: block;
            margin-bottom: 4px;
        }

        * {

            color: black;
            font-family: Lato;
        }

        .form_control_text_color{

            color: #dbdbdb;
        }

        #l_loginDiv {
            position: relative;
            text-align: center;
        }
    </style>
    <body>
        <div class="_childContainer">
            <h1 class="tituloH1 tituloH1-Grey">Iniciar Sesión</h1>
            <hr class="hrSeparator_dialog"> 
            <div class="form-container">
                <div class="form-control">
                    <label class="form-control-label">User:</label> <input type="text" id="input_username" value="">
                </div>
                <div class="form-control">
                    <label class="form-control-label">Password: </label> <input type="text" id="input_userpass" value="">
                </div>
            </div>
            <div class="centeredElementHorizontal" id="l_loginDiv">
                <input type="button" id="input_login_btn" value="Entrar">
            </div>
        </div>
    </div>
    <script src="../js/login.js" type="text/javascript"></script>
</body>
</html>
