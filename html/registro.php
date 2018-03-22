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

            position: relative;
            display: inline-block;
            width: 99.6%;
            height: 100%;
        }

        .top {

            width: 100%;
            /*background-color: orange;*/
            position: relative;
            display: block;
        }

        .div_registro_container  {

            position: relative;
            display: block;
            width: 99%;
            /*background-color: blue;*/
            min-height: 20em;
            margin-left: 0.5em;
        }

        ._registroMenu{

            position: relative;
            height: 100%;
            margin-bottom: 10px;
            display: block;
            top: 0;
            width: 40%;
            color: var(--textColorPrimary);  
        }

        .registroMenuBtn{
            /*background-color: white;*/

            position: relative;
            width: 10%;
            height: 100%;
            display: inline-block;
            /*background-color: red;*/
            padding : 20px; 
            text-align: center;
            /*box-shadow: 0 0px 4px rgba(36,37,38,0.2);*/
            margin-left: 0.5em;
            border-radius: 0.5em;
        }

        .registroMenuBtn:hover {
            background-color: var(--backgroundControlPrimary);  
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
            /*background-color: #eaeaea;*/  
            background-color: var(--backgroundControlPrimary);  
            position: relative;
            width: 10%;
            height: 100%;
            display: inline-block;
            /*background-color: red;*/
            padding : 20px; 
            text-align: center;
            border-radius: 0.5em;
            box-shadow: 0 0px 10px rgba(36,37,38,0.2);
        }

        .div_registro_fan, .div_registro_local{

            display: none;
            min-width: 20em;
            min-height: 20em;
        }

        .div_registro_container .form-control .form-control-label{

            float: left;
            width:10%;
            text-align:left;
            top: 0.5em;
            position: relative;
        }

        .div_registro_container .form-control-btn {

            margin-top: 0.8em;
        }

        .registrarseBtn{

            margin-left: 3em;
        }

        .jqueryValidatorMessage{

            position: relative;
            margin-left: 1em;
            font-size: 0.8em;
            color: var(--textColorPrimaryShine);
            display: inline-block;
        }
    </style>
    <body>
        <div class="_childContainer">
            <div class="registroContainer">
                <div class="top">
                    <div class="_registroMenu centeredElementHorizontal">
                        <div class="registroMenuBtn registroMenuBtn_selected clickableElement" data-regid="registro_musico" data-formid="#musico_form" >
                            <label class="clickableElement">Músico</label>
                        </div>
                        <div class="registroMenuBtn clickableElement" data-regid="registro_local" data-formid="#local_form">
                            <label class="clickableElement">Local</label>
                        </div>
                        <div class="registroMenuBtn clickableElement" data-regid="registro_fan" data-formid="#fan_form">
                            <label class="clickableElement">Fan</label>
                        </div>
                    </div>
                </div>
                <!--<h1 class="tituloH1 tituloH1-Grey registro_h1">Registro</h1>-->

                <div class="div_registro_container">
                    <div class="div_registro_musico  registro-div-active divPadding10" id="registro_musico">
                        <form id="musico_form">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="form-control-label">Usuario </label> <input name="input_musico_usuario"  class="form-control-textfield" type="text" id="input_musico_usuario" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Contraseña </label> <input name="input_musico_pass"  class="form-control-textfield" type="text" id="input_musico_pass" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Nombre </label> <input name="input_musico_nombre" class="form-control-textfield"  type="text" id="input_musico_nombre" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Apellidos</label> <input name="input_musico_apellidos" class="form-control-textfield"  type="text" id="input_musico_apellidos" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Teléfono</label> <input name="input_musico_telefono" class="form-control-textfield"  type="text" id="input_musico_telefono" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Email </label> <input name="input_musico_email"  class="form-control-textfield" type="text" id="input_musico_email" value="">
                                </div>

                                <div class="form-control">
                                    <label class="form-control-label">Web </label> <input name="input_musico_web" type="text" class="form-control-textfield" id="input_musico_web" value="">
                                </div>

                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Nombre artístico </label> <input name="input_musico_artistico"  class="form-control-textfield" type="text" id="input_musico_artistico" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Componentes del grupo </label> <input name="input_musico_componentes" class="form-control-textfield" type="text" id="input_musico_componentes" value="">
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Género </label> 
                                <select id="genero" name="input_musico_genero">
                                </select>
                                <br>
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Comunidad </label>
                                <select id="comunidad_musico">

                                </select>
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Provincias </label>
                                <select id="provincia_musico">

                                </select>
                            </div>
                            <div class="form-control">
                                <label class="form-control-label">Municipio </label>
                                <select id="municipio_musico">

                                </select>
                                <div class="form-control">
                                    <button id="registrarMusico" class="form-control-btn registrarseBtn">Registrarse</label> 
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="div_registro_fan  divPadding10" id="registro_fan">
                        <form id="fan_form">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="form-control-label">Usuario </label> <input name="input_fan_usuario" class="form-control-textfield" type="text" id="input_fan_usuario" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Contraseña </label> <input name="input_fan_pass"  class="form-control-textfield" type="text" id="input_fan_pass" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Nombre</label> <input name="input_fan_nombre"  class="form-control-textfield"  type="text" id="input_fan_nombre" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Apellidos</label> <input name="input_fan_apellidos" class="form-control-textfield" type="text" id="input_fan_apellidos" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Email </label> <input name="input_fan_email" class="form-control-textfield" type="text" id="input_fan_email" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Telefono </label> <input name="input_fan_telefono" class="form-control-textfield" type="text" id="input_fan_telefono" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Direccion </label> <input name="input_fan_direccion" class="form-control-textfield" type="text" id="input_fan_direccion" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Comunidad </label>
                                    <select id="comunidad_fan">

                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Provincias </label>
                                    <select id="provincia_fan">

                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Municipio </label>
                                    <select id="municipio_fan">

                                    </select>
                                </div>
                                <div class="form-control">
                                    <button id="registrarFan" class="form-control-btn registrarseBtn">Registrarse</label> 
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="div_registro_local  divPadding10" id="registro_local">
                        <form id="local_form">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="form-control-label">Usuario </label> <input name="input_local_usuario" class="form-control-textfield" type="text" id="input_local_usuario" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Contraseña </label> <input name="input_local_pass" class="form-control-textfield" type="text" id="input_local_pass" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Nombre</label> <input name="input_local_nombre" class="form-control-textfield" type="text" id="input_local_nombre" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Email </label> <input name="input_local_email" class="form-control-textfield" type="text" id="input_local_email" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Ubicacion </label> <input name="input_local_ubicacion" class="form-control-textfield" type="text" id="input_local_ubicacion" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Aforo </label> <input name="input_local_aforo" class="form-control-textfield" type="text" id="input_local_aforo" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Comunidad </label>
                                    <select id="comunidad_local">

                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Provincias </label>
                                    <select id="provincia_local">

                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Municipio </label>
                                    <select id="municipio_local">

                                    </select>
                                </div>
                                <div class="form-control">
                                    <button id="registrarLocal" class="form-control-btn registrarseBtn">Registrarse</label> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
