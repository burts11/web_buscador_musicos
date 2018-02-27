<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <style>
        h1{
            color: orange;
        }
        .registroContainer{

            position: relative;
            display: inline-block;
            width: 100%;
            height: 100%;
        }

        .top {

            width: 100%;
            height: 20%;
            /*background-color: orange;*/
            position: relative;
            display: block;
        }

        ._registroMenu{

            position: relative;
            height: 100%;
            margin-bottom: 10px;
            display: block;
            top: 0;
            color: var(--textColorPrimary);  
        }

        .registroMenuBtn{
            background-color: white;
            position: relative;
            width: 10%;
            height: 100%;
            display: inline-block;
            /*background-color: red;*/
            padding : 20px; 
            text-align: center;
            /*box-shadow: 0 0px 4px rgba(36,37,38,0.2);*/
            margin-left: 0.5em;
        }

        .registroMenuBtn:hover {
            background-color: #eaeaea;  
            position: relative;
            width: 10%;
            height: 100%;
            display: inline-block;
            /*background-color: red;*/
            padding : 20px; 
            text-align: center;
            box-shadow: 0 0px 10px rgba(36,37,38,0.2);
        }

        .registroMenuBtn_selected {
            background-color: #eaeaea;  
            position: relative;
            width: 10%;
            height: 100%;
            display: inline-block;
            /*background-color: red;*/
            padding : 20px; 
            text-align: center;
            box-shadow: 0 0px 10px rgba(36,37,38,0.2);
        }

        .div_registro_fan, .div_registro_local{

            display: none;
            min-width: 20em;
            min-height: 20em;
        }

        .div_registro_container  {

            margin-top: 0em;
            position: relative;
            display: block;
            height: 100%;
            /*background-color: blue;*/
            min-height: 20em;
        }

        .div_registro_container .form-control .form-control-label{

            float: left;
            width:10%;
            text-align:left;
            top: 0.5em;
            position: relative;
        }

        .div_registro_container .form-control-textfield {

        }
        
        .div_registro_container .form-control-btn {
            
            margin-top: 0.8em;
        }
        
        .registrarseBtn{
            
            margin-left: 3em;
        }
    </style>
    <body>
        <div class="_childContainer divPadding10">
            <div class="registroContainer">
                <div class="top">
                    <div class="_registroMenu">
                        <div class="registroMenuBtn registroMenuBtn_selected clickableElement" data-regid="registro_musico">
                            <label class="clickableElement">Músico</label>
                        </div>
                        <div class="registroMenuBtn clickableElement" data-regid="registro_local">
                            <label class="clickableElement">Local</label>
                        </div>
                        <div class="registroMenuBtn clickableElement" data-regid="registro_fan">
                            <label class="clickableElement">Fan</label>
                        </div>
                    </div>
                </div>
                <!--<h1 class="tituloH1 tituloH1-Grey registro_h1">Registro</h1>-->

                <div class="div_registro_container">
                    <div class="div_registro_musico  registro-div-active divPadding10" id="registro_musico">
                        <div class="form-container">
                            <div class="form-control">
                                <label class="form-control-label">Género </label> 
                                <select name="musico_genero">
                                    <option>Pop</option>
                                    <option>Rock</option>
                                    <option>Electrónica</option>
                                </select>
                                <br>
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Nombre </label> <input class="form-control-textfield"  type="text" id="input_musico_nombre" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Apellidos</label> <input class="form-control-textfield"  type="text" id="input_musico_apellidos" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Teléfono</label> <input class="form-control-textfield"  type="text" id="input_musico_telefono" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Email </label> <input  class="form-control-textfield" type="text" id="input_musico_email" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Web </label> <input type="text" class="form-control-textfield" id="input_musico_web" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Nombre artístico </label> <input   class="form-control-textfield" type="text" id="input_musico_artistico" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Componentes del grupo </label> <input  class="form-control-textfield" type="text" id="input_musico_componentes" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Usuario </label> <input  class="form-control-textfield" type="text" id="input_musico_ausuario" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Contraseña </label> <input  class="form-control-textfield" type="text" id="input_musico_pass" value="">
                            </div>
                            <div class="form-control">
                                <button class="form-control-btn registrarseBtn">Registrarse</label> 
                            </div>
                        </div>
                    </div>
                    <div class="div_registro_fan  divPadding10" id="registro_fan">
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
                                <button class="form-control-btn registrarseBtn">Registrarse</label> 
                            </div>
                        </div>
                    </div>
                    <div class="div_registro_local  divPadding10" id="registro_local">
                        <div class="form-container">
                            <div class="form-control">
                                <label class="form-control-label">Nombre</label> <input class="form-control-textfield" type="text" id="input_local_nombre" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Email </label> <input class="form-control-textfield" type="text" id="input_local_email" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Usuario </label> <input class="form-control-textfield" type="text" id="input_local_usuario" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Contraseña </label> <input class="form-control-textfield" type="text" id="input_local_pass" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Ubicacion </label> <input class="form-control-textfield" type="text" id="input_local_ubicacion" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Aforo </label> <input class="form-control-textfield" type="text" id="input_local_aforo" value="">
                            </div>
                            <div class="form-control">
                                <button class="form-control-btn registrarseBtn">Registrarse</label> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/registro.js" type="text/javascript"></script>
    </body>
</html>
