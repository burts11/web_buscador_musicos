onJqueryWindowCallbackEventOne(VInfo.REGISTRAR_INFO, {

    callback: function (e) {

        e.json.vparams.onDialogContentLoaded();

        inicializar();
        cargarFanComunidades();
        cargarLocalComunidades();


        $("#comunidad_fan").change(function () {

            cargarFanProvincias();
        });

        $("#provincia_fan").change(function () {

            cargarFanMunicipios();
        });
        $("#comunidad_local").change(function () {

            cargarLocalProvincias();
        });

        $("#provincia_local").change(function () {

            cargarLocalMunicipios();
        });

        function cargarFanComunidades() {
            var query = `select comunidad from comunidades group by comunidad`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $.each(result.data, function (i, item) {
                        $("#comunidad_fan").append("<option>" + item.comunidad + "</option>");
                    });
                    console.log(result);
                    cargarFanProvincias();
                }
            });
        }

        function cargarFanProvincias() {
            var comunidad = $("#comunidad_fan").val();
            var query = `select provincia from comunidades where comunidad='${comunidad}' group by provincia`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $("#provincia_fan").empty();
                    $.each(result.data, function (i, item) {
                        $("#provincia_fan").append("<option>" + item.provincia + "</option>");
                    });
                    console.log(result);
                    cargarFanMunicipios();
                }
            });
        }

        function cargarFanMunicipios()
        {
            var provincia = $("#provincia_fan").val();
            var query = `select munucipio from comunidades where provincia='${provincia}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $("#municipio_fan").empty();
                    $.each(result.data, function (i, item) {
                        $("#municipio_fan").append("<option>" + item.munucipio + "</option>");
                    });
                }
            });
        }

        function registrarFan() {

            console.log("Registrando fan!");
            var id_municipio_fan = $("#municipio_fan").val();
            var query = `select idciudad from comunidades where munucipio='${id_municipio_fan}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    var idmunicipio = result.data[0].idciudad;
                    var form = $("#fan_form").serialize();
                    form += "&action=RegistrarFan&input_fan_ciudad=" + idmunicipio;
                    callAjaxBBDD(form, function (result) {
                        console.log(result);
                        return false;
                    });
                } else {
                    console.log(result);
                }
            });
            return false;
        }
        function cargarLocalComunidades() {
            var query = `select comunidad from comunidades group by comunidad`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $.each(result.data, function (i, item) {
                        $("#comunidad_local").append("<option>" + item.comunidad + "</option>");
                    });
                    console.log(result);
                    cargarLocalProvincias();
                }
            });
        }

        function cargarLocalProvincias() {
            var comunidad = $("#comunidad_local").val();
            var query = `select provincia from comunidades where comunidad='${comunidad}' group by provincia`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $("#provincia_local").empty();
                    $.each(result.data, function (i, item) {
                        $("#provincia_local").append("<option>" + item.provincia + "</option>");
                    });
                    console.log(result);
                    cargarLocalMunicipios();
                }
            });
        }

        function cargarLocalMunicipios()
        {
            var provincia = $("#provincia_local").val();
            var query = `select munucipio from comunidades where provincia='${provincia}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $("#municipio_local").empty();
                    $.each(result.data, function (i, item) {
                        $("#municipio_local").append("<option>" + item.munucipio + "</option>");
                    });
                }
            });
        }

        function registrarLocal() {

            console.log("Registrando local!");
            var id_municipio_local = $("#municipio_local").val();
            var query = `select idciudad from comunidades where munucipio='${id_municipio_local}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    var idmunicipio = result.data[0].idciudad;
                    var form = $("#local_form").serialize();
                    form += "&action=RegistrarLocal&input_local_ciudad=" + idmunicipio;
                    callAjaxBBDD(form, function (result) {
                        console.log(result);
                        return false;
                    });
                } else {
                    console.log(result);
                }
            });
            return false;
        }

        function inicializar() {
            $("#registrarFan").click(registrarFan);
            $("#registrarLocal").click(registrarLocal);
            inicializarJValidator();
        }

        function inicializarJValidator() {
            jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });

            $("#fan_form").validate({
                rules: {
                    input_fan_nombre: "required",
                    input_fan_usuario: "required",
                    input_fan_email: {
                        required: true,
                        email: true
                    },
                    input_fan_pass: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    input_fan_nombre: "<label class='jqueryValidatorMessage'>Escribe tu nombre</label>",
                    input_fan_usuario: "<label class='jqueryValidatorMessage'>Usuario requerido</label>",
                    input_fan_pass: {
                        required: "<label class='jqueryValidatorMessage'>Contraseña requerida</label>",
                        minlength: "<label class='jqueryValidatorMessage'>La contraseña tiene que tener 5 carácteres como mínimo</label>"
                    },
                    input_fan_email: "<label class='jqueryValidatorMessage'>Introduce un email válido</label>"
                }
            });
            $("#local_form").validate({
                rules: {
                    input_local_nombre: "required",
                    input_local_usuario: "required",
                    input_local_email: {
                        required: true,
                        email: true
                    },
                    input_local_pass: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    input_local_nombre: "<label class='jqueryValidatorMessage'>Escribe tu nombre</label>",
                    input_local_usuario: "<label class='jqueryValidatorMessage'>Usuario requerido</label>",
                    input_local_pass: {
                        required: "<label class='jqueryValidatorMessage'>Contraseña requerida</label>",
                        minlength: "<label class='jqueryValidatorMessage'>La contraseña tiene que tener 5 carácteres como mínimo</label>"
                    },
                    input_local_email: "<label class='jqueryValidatorMessage'>Introduce un email válido</label>"
                }
            });
        }

        $("._registroMenu .registroMenuBtn").click(function (e) {
            $(".registro-div-active").hide().removeClass("registro-div-active");
            var regId = $(this).attr("data-regid");
            $("._registroMenu .registroMenuBtn").not(this).removeClass("registroMenuBtn_selected");
            $(this).addClass("registroMenuBtn_selected");
            $("#" + regId).fadeIn();
            $("#" + regId).addClass("registro-div-active");

            var formId = $(this).attr("data-formid");
            $(formId).valid();
        });
    }
});


