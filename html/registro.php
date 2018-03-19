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
            width: 100%;
            height: 100%;
        }

        .top {

            width: 100%;
            height: 5%;
            /*background-color: orange;*/
            position: relative;
            display: block;
        }

        .div_registro_container  {

            position: relative;
            display: block;
            width: 100%;
            /*background-color: blue;*/
            min-height: 20em;
            top: 5%;
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
                        <form id="fan_form">
                            <div class="form-container">
                                <div class="form-control">
                                    <label class="form-control-label">Nombre</label> <input name="input_fan_nombre"  class="form-control-textfield" type="text" id="input_fan_nombre" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Apellidos</label> <input name="input_fan_apellidos" class="form-control-textfield" type="text" id="input_fan_apellidos" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Email </label> <input name="input_fan_email" class="form-control-textfield" type="text" id="input_fan_email" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Usuario </label> <input name="input_fan_usuario" class="form-control-textfield" type="text" id="input_fan_usuario" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Contraseña </label> <input name="input_fan_pass" class="form-control-textfield" type="text" id="input_fan_pass" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Ciudad </label> <input name="input_fan_ciudad" class="form-control-textfield" type="text" id="input_fan_ciudad" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Telefono </label> <input name="input_fan_telefono" class="form-control-textfield" type="text" id="input_fan_telefono" value="">
                                </div>
                                <div class="form-control">
                                    <label class="form-control-label">Direccion </label> <input name="input_fan_direccion" class="form-control-textfield" type="text" id="input_fan_direccion" value="">
                                </div>
                                <div class="form-control">
                                    <button id="registrarFan" class="form-control-btn registrarseBtn">Registrarse</label> 
                                </div>
                            </div>
                        </form>
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
        <script>

            $("#registrarFan").click(registrarFan);
            function registrarFan() {
                
                var form = $("#fan_form").serialize();
                form += "&action=RegistrarFan";
                console.log(form);
                callAjaxBBDD(form,function(result){
                    console.log(result);
                    return false;
                });
                return false;
            }


            function Registrar() {
                $("#registro_musico .registrarseBtn").click(function () {

//                    alert("hola");

                    var musico_nombre = $("#input_musico_nombre").val();
                    var musico_apellidos = $("#input_musico_apellidos").val();
                    var musico_telefono = $("#input_musico_telefono").val();
                    var musico_email = $("#input_musico_email").val();
                    var musico_web = $("#input_musico_web").val();
                    var musico_artistico = $("#input_musico_artistico").val();
                    var musico_componentes = $("#input_musico_componentes").val();
                    var musico_ausuario = $("#input_musico_ausuario").val();
                    var musico_pass = $("#input_musico_pass").val();
                    var json = {nombre: "Javi", email: "hola@hotmail.com", usuario: "Jeehvi", pass: "1234", tipo: "1", numerocomponentes: "4", genero: "Rock", apellidos: "Steven Marc", telefono: "673940549", web: "google.es", nombreartistico: "Lil PolMother"};
                    registrarMusico(json, {
                        success: function (json) {
                            console.log(json);
                        },
                        error: function (json) {
                            console.log(json);
                        }
                    });
                });
            }

            $("._registroMenu .registroMenuBtn").click(function (e) {
                $(".registro-div-active").hide().removeClass("registro-div-active");

                var id = $(this).attr("data-regid");

                $("._registroMenu .registroMenuBtn").not(this).removeClass("registroMenuBtn_selected");
                $(this).addClass("registroMenuBtn_selected");

                $("#" + id).fadeIn();
                $("#" + id).addClass("registro-div-active");
                console.log(e);
            });
        </script>
    </body>
</html>
