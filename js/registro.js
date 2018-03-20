onJqueryWindowCallbackEventOne(VInfo.REGISTRAR_INFO, {

    callback: function (e) {

        e.json.vparams.onDialogContentLoaded();

        inicializar();
        cargarFanComunidades();
        cargarLocalComunidades();
        cargarMusicoComunidades();
        cargarGeneros();

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
        $("#comunidad_musico").change(function () {

            cargarMusicoProvincias();
        });

        $("#provincia_musico").change(function () {

            cargarMusicoMunicipios();
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

            console.log("Registrando localaaasasa!");
            var id_municipio_local = $("#municipio_local").val();
            var query = `select idciudad from comunidades where munucipio='${id_municipio_local}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {
                if (success(result)) {
                                        console.log("succes local ");

                    console.log(result);
                    var idmunicipio = result.data[0].idciudad;
                    console.log(idmunicipio);
                    var form = $("#local_form").serialize();
                    form += "&action=RegistrarLocal&input_local_ciudad=" + idmunicipio;
                    callAjaxBBDD(form, function (result) {
                        console.log(result);
                        return false;
                    });
                } else {
                    console.log("Error al registrar el local");
                    console.log(result);
                }
            });
            return false;
        }
        function cargarMusicoComunidades() {
            var query = `select comunidad from comunidades group by comunidad`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $.each(result.data, function (i, item) {
                        $("#comunidad_musico").append("<option>" + item.comunidad + "</option>");
                    });
                    cargarMusicoProvincias();
                }
            });
        }

        function cargarMusicoProvincias() {
            var comunidad = $("#comunidad_musico").val();
            var query = `select provincia from comunidades where comunidad='${comunidad}' group by provincia`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $("#provincia_musico").empty();
                    $.each(result.data, function (i, item) {
                        $("#provincia_musico").append("<option>" + item.provincia + "</option>");
                    });
                    console.log(result);
                    cargarMusicoMunicipios();
                }
            });
        }

        function cargarMusicoMunicipios()
        {
            var provincia = $("#provincia_musico").val();
            var query = `select munucipio from comunidades where provincia='${provincia}'`;
            var params = {
                action: "RawQueryRet",
                query: query};
            callAjaxBBDD(params, function (result) {

                if (success(result)) {

                    $("#municipio_musico").empty();
                    $.each(result.data, function (i, item) {
                        $("#municipio_musico").append("<option>" + item.munucipio + "</option>");
                    });
                }
            });
        }

        function registrarMusico() {
            console.log("Registrando Musico!");
            var id_municipio_musico = $("#municipio_musico").val();
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
                        console.log(result);
                        return false;
                    });
                } else {
                    console.log(result);
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

                    registrarMusico();

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
            $("#musico_form").validate({
                rules: {
                    input_musico_nombre: "required",
                    input_musico_usuario: "required",
                    input_musico_email: {
                        required: true,
                        email: true
                    },
                    input_musico_pass: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    input_musico_nombre: "<label class='jqueryValidatorMessage'>Escribe tu nombre</label>",
                    input_musico_usuario: "<label class='jqueryValidatorMessage'>Usuario requerido</label>",
                    input_musico_pass: {
                        required: "<label class='jqueryValidatorMessage'>Contraseña requerida</label>",
                        minlength: "<label class='jqueryValidatorMessage'>La contraseña tiene que tener 5 carácteres como mínimo</label>"
                    },
                    input_musico_email: "<label class='jqueryValidatorMessage'>Introduce un email válido</label>"
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

            cargarGeneros();
        });
    }
});


