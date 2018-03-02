<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/concierto.css" rel="stylesheet" type="text/css"/>
        <link href="../css/dialog.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        .perfil_info_container {

            position: relative;
            width: 100%;
            height: 100%;
            display: inline-block;
            /*background-color: orange;*/
        }    

        .perfil_info_logo_container {
            display: block;
            position: relative;
            width: 8em;
            height: 8em;
            min-width: 6em;
            min-height: 6em;
            margin-top: 1em;
        }

        #perfil_info_logo {
            display: inline-block;
            position: relative;
            width: 100%;
            height: 100%;
            display: none;
        }

        .perfil_info_detalles{

            display: inline-block;
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: none;
        }

        #perfil_actualizar_detalles {

            margin-top: 2em;
        }
    </style>
    <body>
        <div class="_childContainer divPadding10">
            <!--<button id="btnPerfil">PERFIL DIALOG</button>-->
            <!--<label class="tituloH1-Grey padding10 musico_info_titulo textoCentradoHorizontalUpperCase">Perfil</label>-->
            <div class="perfil_info_container">
                <div class="perfil_info_logo_container centeredElementHorizontal">
                    <img id="perfil_info_logo">
                </div>
                <div class="perfil_info_detalles divPadding10">
                    <div class="form-container">
                        <div class="form-control">
                            <label class="form-control-label">Nombre</label> <input  class="form-control-textfield" type="text" id="input_fan_nombre" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Apellidos</label> <input class="form-control-textfield" type="text" id="input_fan_apellidos" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Email </label> <input class="form-control-textfield" type="text" id="input_fan_email" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Usuario </label> <input class="form-control-textfield" type="text" id="input_fan_usuario" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Contraseña </label> <input class="form-control-textfield" type="text" id="input_fan_pass" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Ubicacion </label> <input class="form-control-textfield" type="text" id="input_fan_ubicacion" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Aforo </label> <input class="form-control-textfield" type="text" id="input_fan_aforo" value="">
                        </div>
                        <div class="form-control">
                            <button class="form-control-btn" id="perfil_actualizar_detalles"> Actualizar</label> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/perfil.js" type="text/javascript"></script>
    </body>
</html>
