<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/registro.js" type="text/javascript"></script>
    </head>
    <style>
        h1{
            color: orange;
        }
        .registroContainer{

            width: 100% !important;
            height: 100%;
        }
    </style>
    <body>
        <div class="_childContainer divPadding10">
            <div class="registroContainer">
                <h1 class="tituloH1 tituloH1-Grey registro_h1">Registro</h1>

                <div class="div_registro_local">

                    <div class="form-container">
                        <div class="form-control">
                            <label class="form-control-label">Nombre:</label> <input type="text" id="input_local_nombre" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Email: </label> <input type="text" id="input_local_email" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Usuario: </label> <input type="text" id="input_local_usuario" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Contraseña: </label> <input type="text" id="input_local_pass" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Ubicacion: </label> <input type="text" id="input_local_ubicacion" value="">
                        </div>
                        <div class="form-control">
                            <label class="form-control-label">Aforo: </label> <input type="text" id="input_local_aforo" value="">
                        </div>
                        <div class="form-control">
                            <button class="form-control-btn">Registrarse</label> 
                        </div>
                    </div>
                </div>
            </div>

            <h1>Registra un local</h1>
            <div class="form-control">
                <!--Nombre:  <input type="text" name="nombre" <br>-->
                <label>Nombre: </label> <input type="text" name="nombre">
            </div>
            <div>Email: <input type="email" name="email"></div>
            <div>Usuario: <input type="text" name="usuario"></div>
            <div>Contraseña: <input type="password" name="contraseña"></div>
            <div>Ubicacion: <input type="text" name="ubicacion"></div>
            <div>Aforo: <input type="number" name="aforo"></div>
            <div>Imagen: <input type="text" name="imagen"></div>
            <input type="submit" name="register" value="Register"><br>
        </div>
    </div>
</body>
</html>
