onJqueryWindowCallbackEventOne(VInfo.REGISTRAR_INFO, {

    callback: function (e) {

        e.json.vparams.onDialogContentLoaded();

        inicializar();
        cargarComunidades();

        $("#comunidad_fan").change(function () {

            cargarProvincias();
        });

        $("#provincia_fan").change(function () {

            cargarMunicipios();
        });

        function cargarComunidades() {
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
                    cargarProvincias();
                }
            });
        }

        function cargarProvincias() {
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
                    cargarMunicipios();
                }
            });
        }

        function cargarMunicipios()
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

        function inicializar() {
            $("#registrarFan").click(registrarFan);
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


