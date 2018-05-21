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
                <form id="form_local">
                    <div class="form-container">
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Local_Nombre" class="form-control-label">Nombre</label> <input class="form-control-textfield" type="text" id="input_local_nombre" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Local_Email" class="form-control-label">Email </label> <input class="form-control-textfield" type="text" id="input_local_email" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Local_Ubicacion" class="form-control-label">Ubicación </label> <input class="form-control-textfield" type="text" id="input_local_ubicacion" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Local_Aforo" class="form-control-label">Aforo </label> <input class="form-control-textfield" type="text" id="input_local_aforo" value="">
                        </div>
                        <div class="form-control">
                            <button class="form-control-btn" id="btnActualizarLocal" id="btnActualizarLocal">Actualizar</label> 
                        </div>
                    </div>
            </div>
        </div>
        <script>
            onJqueryWindowCallbackEventOne(VInfo.PERFIL_INFO_UNKNOWN, {

                callback: function (e) {
                    var modalId = e.json.vparams.VModalId;
                    cargarInfo();

                    $("#btnActualizarLocal").click(function () {

                        actualizarInfo();
                        VModal.closeWithId(modalId);
                        return false;
                    });

                    function cargarInfo() {

                        var id = Usuario.id;
                        var query = `SELECT * from local inner join usuario on usuario.idusuario= local.idlocal where idlocal= ${ id }`;
                        var params = {action: "RawQueryRet", query: query};

                        callAjaxBBDD(params, function (result) {

                            var data = result.data[0];
                            console.log(data);
                            $("#input_local_nombre").val(data["nombre"]);
                            $("#input_local_email").val(data["email"]);
                            $("#input_local_ubicacion").val(data["ubicacion"]);
                            $("#input_local_aforo").val(data["aforo"]);
                        });
                    }

                    function actualizarInfo() {
                        var nombre = $("#input_local_nombre").val();
                        var email = $("#input_local_email").val();
                        var ubicacion = $("#input_local_ubicacion").val();
                        var aforo = $("#input_local_aforo").val();

                        var query = `UPDATE usuario set nombre='${nombre}', email='${email}' WHERE idusuario='${Usuario.id}'`;

                        var params = {
                            action: "RawQueryRet",
                            query: query};

                        callAjaxBBDD(params, function (result) {

                            params["query"] = `UPDATE local set ubicacion = '${ubicacion}', aforo ='${aforo}' WHERE idlocal='${Usuario.id}'`;

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
