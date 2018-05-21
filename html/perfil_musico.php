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
                            <label lang="es" data-lang-token="Perfil_Musico_Nombre" class="form-control-label">Nombre</label> <input  class="form-control-textfield" type="text" id="input_musico_nombre" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_NombreArtistico" class="form-control-label">Nombre artístico</label> <input  class="form-control-textfield" type="text" id="input_musico_artistico" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Apellidos" class="form-control-label">Apellidos</label> <input class="form-control-textfield" type="text" id="input_musico_apellidos" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Email" class="form-control-label">Email </label> <input class="form-control-textfield" type="text" id="input_musico_email" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Web" class="form-control-label">Web </label> <input class="form-control-textfield" type="text" id="input_musico_web" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Musico_Telefono" class="form-control-label">Teléfono </label> <input class="form-control-textfield" type="text" id="input_musico_telefono" value="">
                        </div>
                        <div class="form-control">
                            <button class="form-control-btn" id="btnActualizarMusico">Actualizar</label> 
                        </div>
                    </div>
            </div>
        </div>
        <script>
            onJqueryWindowCallbackEventOne(VInfo.PERFIL_INFO_UNKNOWN, {

                callback: function (e) {

                    console.log("Perfil musico");
                    console.log(e);
                    cargarInfo();

                    var modalId = e.json.vparams.VModalId;

                    $("#btnActualizarMusico").click(function () {

                        actualizarInfo();
                        VModal.closeWithId(modalId);
                        return false;
                    });

                    function cargarInfo() {

                        var id = Usuario.id;
                        var query = `SELECT * from musico inner join usuario on usuario.idusuario= musico.idmusico where idmusico= ${ id }`;
                        var params = {action: "RawQueryRet", query: query};

                        callAjaxBBDD(params, function (result) {

                            var data = result.data[0];
                            console.log(data);
                            $("#input_musico_nombre").val(data["nombre"]);
                            $("#input_musico_artistico").val(data["nombreartistico"]);
                            $("#input_musico_apellidos").val(data["apellidos"]);
                            $("#input_musico_email").val(data["email"]);
                            $("#input_musico_web").val(data["web"]);
                            $("#input_fan_telefono").val(data["telefono"]);
                        });
                    }

                    function actualizarInfo() {
//                alert('madrepol');
                        var nombre = $("#input_musico_nombre").val();
                        var apellidos = $("#input_musico_apellidos").val();
                        var web = $("#input_musico_web").val();
                        var telefono = $("#input_musico_telefono").val();
                        var email = $("#input_musico_email").val();
                        var artistico = $("#input_musico_artistico").val();

                        var query = `UPDATE usuario set nombre='${nombre}', email='${email}' WHERE idusuario='${Usuario.id}'`;

                        var params = {
                            action: "RawQueryRet",
                            query: query};

                        callAjaxBBDD(params, function (result) {

                            params["query"] = `UPDATE musico set apellidos ='${apellidos}', nombreartistico ='${artistico}', telefono ='${telefono}', web ='${web}' WHERE idmusico='${Usuario.id}'`;

                            callAjaxBBDD(params, function (result) {

                                VToast.mostrarMensaje("Perfil actualizado!");
                            });

                            return false;
                        });

                        return false;
                    }
                }
            });
        </script>
    </body>
</html>
