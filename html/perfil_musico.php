<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
        }

        .perfil_info_detalles{

            display: inline-block;
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        #perfil_actualizar_detalles {

            margin-top: 2em;
        }
    </style>
    <body>
        <div class="perfil_info_container">
            <div class="perfil_info_logo_container centeredElementHorizontal">
                <img id="perfil_info_logo">
            </div>
            <div class="perfil_info_detalles divPadding10">
                <form id="form_musico">
                    <div class="form-container">
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Nombre" class="form-control-label">Nombre</label> <input  class="form-control-textfield" type="text" id="input_fan_nombre" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_NombreArtistico" class="form-control-label">Nombre artístico</label> <input  class="form-control-textfield" type="text" id="input_fan_nombre" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Apellidos" class="form-control-label">Apellidos</label> <input class="form-control-textfield" type="text" id="input_fan_apellidos" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Email" class="form-control-label">Email </label> <input class="form-control-textfield" type="text" id="input_fan_email" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Web" class="form-control-label">Web </label> <input class="form-control-textfield" type="text" id="input_fan_email" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Telefono" class="form-control-label">Teléfono </label> <input class="form-control-textfield" type="text" id="input_fan_email" value="">
                        </div>
                        <div class="form-control">
                            <button class="form-control-btn" id="btnActualizarMusico">Actualizar</label> 
                        </div>
                    </div>
            </div>
        </div>
        <script>

//            $("#perfil_info_logo").prop("src", e.json.logo).fadeIn();
        </script>
    </body>
</html>
