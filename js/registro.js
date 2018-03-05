onJqueryReady(function () {

    console.log("Registro!");
Registrar();
    $("._registroMenu .registroMenuBtn").click(function (e) {

        $(".registro-div-active").hide().removeClass("registro-div-active");

        var id = $(this).attr("data-regid");
        $('._registroMenu .registroMenuBtn').removeClass("registroMenuBtn_selected");
        $(this).addClass("registroMenuBtn_selected");

        $("#" + id).fadeIn();
        $("#" + id).addClass("registro-div-active");
        console.log(e);
    });
});

function Registrar() {
    $("#registro_musico .registrarseBtn").click(function () {

        alert("hola");

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
            error:function(json){
                console.log(json);
            }
        });
    });
}
