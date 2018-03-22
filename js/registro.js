onJqueryWindowCallbackEventOne(VInfo.REGISTRAR_INFO, {

    callback: function (e) {

        e.json.vparams.onDialogContentLoaded();

        var musicoSelects = {comunidad: "#comunidad_musico", provincia: "#provincia_musico", municipio: "#municipio_musico"};
        var localSelects = {comunidad: "#comunidad_local", provincia: "#provincia_local", municipio: "#municipio_local"};
        var fanSelects = {comunidad: "#comunidad_fan", provincia: "#provincia_fan", municipio: "#municipio_fan"};

        inicializar();
        cargarComunidades(musicoSelects);
        cargarComunidades(localSelects);
        cargarComunidades(fanSelects);

        cargarGeneros();

        $("#comunidad_fan").change(function () {

            cargarProvincias(fanSelects);
        });
        $("#provincia_fan").change(function () {

            cargarMunicipios(fanSelects);
        });
        $("#comunidad_local").change(function () {

            cargarProvincias(localSelects);
        });
        $("#provincia_local").change(function () {
            cargarMunicipios(localSelects);
        });

        $("#comunidad_musico").change(function () {
            cargarProvincias(musicoSelects);
        });
        $("#provincia_musico").change(function () {
            cargarMunicipios(musicoSelects);
        });

        function cargarComunidades(targetParams) {

            var query = `select comunidad from comunidades group by comunidad`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $.each(result.data, function (i, item) {
                        $(targetParams.comunidad).append("<option>" + item.comunidad + "</option>");
                    });
                    cargarProvincias(targetParams);
                }
            });
        }

        function cargarProvincias(targetParams) {

            var comunidad = $(targetParams.comunidad).val();
            var query = `select provincia from comunidades where comunidad='${comunidad}' group by provincia`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                console.log(result);
                if (success(result)) {

                    $(targetParams.provincia).empty();
                    $.each(result.data, function (i, item) {
                        $(targetParams.provincia).append("<option>" + item.provincia + "</option>");
                    });
                    cargarMunicipios(targetParams);
                }
            });
        }

        function cargarMunicipios(targetParams)
        {
            var provincia = $(targetParams.provincia).val();

            var query = `select munucipio from comunidades where provincia='${provincia}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                console.log(result);
                if (success(result)) {
                    $(targetParams.municipio).empty();
                    $.each(result.data, function (i, item) {
                        $(targetParams.municipio).append("<option>" + item.munucipio + "</option>");
                    });
                }
            });
        }

        function registrarFan() {
            if (!$("#fan_form").valid()) {
                VToast.mostrarError("Faltan campos por rellenar o no se cumplen los requisitos!");
                return;
            }

            var id_municipio_fan = $(fanSelects.municipio).val();
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
                        if (success(result)) {

                            VToast.mostrarMensaje(result.mensaje);
                        } else {
                            VToast.mostrarError(`Error al registrar el fan -> ${result.mensaje}`);
                        }
                        return false;
                    });
                } else {
                    VToast.mostrarError(`Error al registrar el fan -> ${result.mensaje}`);
                }
            });
            return false;
        }

        function registrarLocal() {

            if (!$("#local_form").valid()) {
                VToast.mostrarError("Faltan campos por rellenar o no se cumplen los requisitos!");
                return;
            }

            var id_municipio_local = $(musicoSelects.municipio).val();
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
                        if (success(result)) {

                            VToast.mostrarMensaje(result.mensaje);
                        } else {
                            VToast.mostrarError(`Error al registrar el local -> ${result.mensaje}`);
                        }
                        return false;
                    });
                } else {
                    VToast.mostrarError(`Error al registrar el local -> ${result.mensaje}`);
                }
            });
            return false;
        }

        function registrarMusico() {

            if (!$("#musico_form").valid()) {
                VToast.mostrarError("Faltan campos por rellenar o no se cumplen los requisitos!");
                return;
            }

            var id_municipio_musico = $(musicoSelects.municipio).val();
            var query = `select idciudad from comunidades where munucipio='${id_municipio_musico}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    var idmunicipio = result.data[0].idciudad;
                    var form = $("#musico_form").serialize();
                    var generoId = $("#genero option:selected").attr("data-musico-generoid");
                    form += "&action=RegistrarMusico&input_musico_ciudad=" + idmunicipio + "&input_musico_genero=" + generoId;
                    callAjaxBBDD(form, function (result) {

                        if (success(result)) {

                            VToast.mostrarMensaje(result.mensaje);
                        } else {
                            VToast.mostrarError(`Error al registrar el músico -> ${result.mensaje}`);
                        }

                        return false;
                    });
                } else {
                    VToast.mostrarError(`Error al registrar el músico -> ${result.mensaje}`);
                }
            });
            return false;
        }

        function cargarGeneros() {

            var query = `select * from genero`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $("#genero").empty();
                    $.each(result.data, function (i, item) {

                        var option = $("<option>" + item.nombre + "</option>");
                        $(option).attr("data-musico-generoId", item.idgenero);
                        $("#genero").append(option);
                    });
                }
            });
        }

        function inicializar() {
            $("#registrarFan").click(registrarFan);
            $("#registrarLocal").click(registrarLocal);
            $("#registrarMusico").click(registrarMusico);
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
                        minlength: 3
                    }
                },
                messages: {
                    input_fan_nombre: "<label class='jqueryValidatorMessage'>Escribe tu nombre</label>",
                    input_fan_usuario: "<label class='jqueryValidatorMessage'>Usuario requerido</label>",
                    input_fan_pass: {
                        required: "<label class='jqueryValidatorMessage'>Contraseña requerida</label>",
                        minlength: "<label class='jqueryValidatorMessage'>La contraseña tiene que tener 3 carácteres como mínimo</label>"
                    },
                    input_fan_email: "<label class='jqueryValidatorMessage'>Introduce un email válido</label>"
                }
            });
            $("#local_form").validate({
                rules: {
                    input_local_nombre: "required",
                    input_local_usuario: "required",
                    input_local_aforo: "required",
                    input_local_email: {
                        required: true,
                        email: true
                    },
                    input_local_pass: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    input_local_nombre: "<label class='jqueryValidatorMessage'>Escribe tu nombre</label>",
                    input_local_usuario: "<label class='jqueryValidatorMessage'>Usuario requerido</label>",
                    input_local_aforo: "<label class='jqueryValidatorMessage'>Escribe el aforo máximo</label>",
                    input_local_pass: {
                        required: "<label class='jqueryValidatorMessage'>Contraseña requerida</label>",
                        minlength: "<label class='jqueryValidatorMessage'>La contraseña tiene que tener 3 carácteres como mínimo</label>"
                    },
                    input_local_email: "<label class='jqueryValidatorMessage'>Introduce un email válido</label>"
                }
            });
            $("#musico_form").validate({
                rules: {
                    input_musico_nombre: "required",
                    input_musico_usuario: "required",
                    input_musico_artistico: "required",
                    input_musico_componentes: "required",
                    input_musico_email: {
                        required: true,
                        email: true
                    },
                    input_musico_pass: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    input_musico_artistico: "<label class='jqueryValidatorMessage'>Escribe el nombre artístico</label>",
                    input_musico_componentes: "<label class='jqueryValidatorMessage'>Escribe el número de componentes</label>",
                    input_musico_nombre: "<label class='jqueryValidatorMessage'>Escribe tu nombre</label>",
                    input_musico_usuario: "<label class='jqueryValidatorMessage'>Usuario requerido</label>",
                    input_musico_pass: {
                        required: "<label class='jqueryValidatorMessage'>Contraseña requerida</label>",
                        minlength: "<label class='jqueryValidatorMessage'>La contraseña tiene que tener 3 carácteres como mínimo</label>"
                    },
                    input_musico_email: "<label class='jqueryValidatorMessage'>Introduce un email válido</label>"
                }
            });
            $("#musico_form").valid();
        }

        function onTabChanged(formId) {
            if (formId === "#musico_form") {
                cargarGeneros();
            }
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

            onTabChanged(formId);
        });
    }
});


