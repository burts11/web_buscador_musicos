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

        #perfil_fan_info_logo {
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
        <div class="inputFileWrapper" style="display: none !important; opacity: 0 !important;">
            <input type="file" class="jfilestyle" data-theme="red"  id="loadUserPic" data-text="red" >
        </div>
        <div class="perfil_info_container">
            <div class="perfil_info_logo_container centeredElementHorizontal clickableElement">
                <img id="perfil_fan_info_logo">
            </div>
            <div class="perfil_info_detalles divPadding10">
                <form id="form_fan">
                    <div class="form-container">
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Fan_Nombre" class="form-control-label">Nombre</label> <input  class="form-control-textfield" name="input_fan_nombre"  type="text" id="input_fan_nombre" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Fan_Apellidos" class="form-control-label">Apellidos</label> <input class="form-control-textfield" type="text" name="input_fan_apellidos" id="input_fan_apellidos" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Fan_Direccion" class="form-control-label">Dirección </label> <input class="form-control-textfield" name="input_fan_direccion"  type="text" id="input_fan_direccion" value="">
                        </div>
                        <div class="form-control">
                            <label lang="es" data-lang-token="Perfil_Fan_Telefono" class="form-control-label">Teléfono </label> <input class="form-control-textfield"  name="input_fan_telefono" type="text" id="input_fan_telefono" value="">
                        </div>
                        <div class="form-control">
                            <button class="form-control-btn" id="btnActualizarFan">Actualizar</label> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            onJqueryWindowCallbackEventOne(VInfo.PERFIL_INFO_UNKNOWN, {

                callback: function (e) {
                    $('#loadUserPic').jfilestyle('theme', 'black');

                    var modalId = e.json.vparams.VModalId;

                    $("#loadUserPic").on("change", function () {

                        var url = $(this).prop("files")[0];
                        var tempUrl = URL.createObjectURL(url);
                        $("#perfil_fan_info_logo").prop("src", tempUrl);
                        console.log(url);
                        console.log(tempUrl);
                    });

                    $(".perfil_info_logo_container").click(function () {

                        $("#loadUserPic").click();
                    });

                    cargarInfo();

                    $("#btnActualizarFan").click(function () {

                        actualizarInfo();
                        VModal.closeWithId(modalId);
                        return false;
                    });

                    function cargarInfo() {

                        var id = Usuario.id;
                        var query = `SELECT * from fan inner join usuario on usuario.idusuario= fan.idfan where idfan= ${ id }`;
                        var params = {action: "RawQueryRet", query: query};

                        callAjaxBBDD(params, function (result) {

                            var data = result.data[0];

                            $("#input_fan_nombre").val(data["nombre"]);
                            $("#input_fan_apellidos").val(data["apellidos"]);
                            $("#input_fan_direccion").val(data["direccion"]);
                            $("#input_fan_telefono").val(data["telefono"]);
                        });
                    }

                    function actualizarInfo() {

                        var nombre = $("#input_fan_nombre").val();
                        var apellidos = $("#input_fan_apellidos").val();
                        var direccion = $("#input_fan_direccion").val();
                        var telefono = $("#input_fan_telefono").val();

                        var query = `UPDATE usuario set nombre='${nombre}' WHERE idusuario='${Usuario.id}'`;

                        var params = {
                            action: "RawQueryRet",
                            query: query};

                        callAjaxBBDD(params, function (result) {
                            params["query"] = `UPDATE fan set apellidos ='${apellidos}', direccion ='${direccion}', telefono ='${telefono}' WHERE idfan='${Usuario.id}'`;

                            callAjaxBBDD(params, function (result) {
                                VToast.mostrarMensaje("Perfil actualizado!");
                            });
                        });
                    }

                    function callAjaxTest(dataJSON, func) {

                        $.ajax({
                            type: METHOD.POST,
                            url: "bbdd/mybbdd.php",
                            dataType: "text",
                            data: dataJSON,
                            cache: false,
                            success: function (rawJson) {

                                func(rawJson);
                            },
                            error: function (err) {
                                func(err);
                            }
                        }
                        );
                    }
                }
            });
        </script>
    </body>
</html>
