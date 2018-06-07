iniciar();
cargarLocales();
//cargarConciertos();
cargarPorGeneros();
masVotados();
cargarConciertosPaginados();

var paginaContador = 0;
var filasPorPagina = 5;
var filasTotal = 0;

function iniciar() {

    $("#pp_conciertosPaginados").empty();
    $("#pp_masVotados").empty();
    $("#pp_divGeneros").empty();
    $("#pp_divMusicos").empty();
    $("#pp_divLocales").empty();
    $(".slickConciertos").empty();
    agregarBotones();

    recargarConciertos(function (result) {
        var cuenta = result.data[0].todos;
        filasTotal = cuenta;

        if (paginaContador <= 0) {
            $("#btnAnteriorConcierto").hide();
        }

        handleButtons();
    });
}

function agregarBotones() {
    var Siguiente = $("<button type='button' id='btnSiguienteConcierto' display='none' class='form-control-btn' onclick='Siguiente()'>Siguiente</button>");
    var Anterior = $("<button type='button' id='btnAnteriorConcierto' display='none' class='form-control-btn' onclick='Anterior()'>Anterior</button>");
    $("#pp_conciertosPaginados").append(Siguiente);
    $("#pp_conciertosPaginados").append(Anterior);
}

function cargarConciertosPaginados() {
    $("#pp_conciertosPaginados").find(".conciertosTable").empty();
    var conciertos = `select usuario.nombre as Local,concierto.fecha,concierto.hora,genero.nombre as genero,concierto.valoreconomico,comunidades.provincia,comunidades.munucipio
from concierto join genero on concierto.genero = genero.idgenero
join usuario on usuario.idusuario = concierto.idlocal
join comunidades on concierto.ciudad = comunidades.idciudad where concierto.estado = 1 and fecha >now() limit ${paginaContador},${filasPorPagina}`;

    callAjaxBBDD(
            {
                action: "RawQueryRet",
                query: conciertos
            }, function (result) {

        $("#pp_conciertosPaginados").empty();

        var divpadre = $("<table class='conciertosTable'></table>");
        $(divpadre).addClass("paginado");
        $(divpadre).append("<tr><th>Local</th><th>Fecha</th><th>Hora</th><th>Genero</th><th>Valor Economico</th><th>Provincia</th><th>Municipio</th></tr>");

        $.each(result.data, function (i, item) {

            $(divpadre).append("<tr><th>" + item.Local + "</th><th>" + item.fecha + "</th><th>" + item.hora + "</th><th>" + item.genero + "</th><th>" + item.valoreconomico + "</th><th>" + item.provincia + "</th><th>" + item.munucipio + "</th></tr>");
//            $(divpadre).append("<tr>Local: " + item.Local + " Fecha: " + item.fecha + " Hora: " + item.hora + " Genero: " + item.genero + " Valor economico: " + item.valoreconomico + " Provincia: " + item.provincia + " Municipio: " + item.munucipio + "</tr>");
            $("#pp_conciertosPaginados").append(divpadre);
        });

        if (filasTotal > 0) {
            agregarBotones();
        }
        handleButtons();
    });
}

function recargarConciertos(eventCallback) {

    var query = `select count(*) as todos from concierto where estado = 1`;
    callAjaxBBDD(
            {
                action: "RawQueryRet",
                query: query
            }, function (result) {

        eventCallback(result);
        handleButtons();
        cargarConciertosPaginados();
    });
}

function Siguiente() {
    paginaContador = paginaContador + filasPorPagina;

    recargarConciertos(function (result) {
        filasTotal = result.data[0].todos;
    });
}

function handleButtons() {

    var contadorFilas = paginaContador;

    console.log("Pagina + filas -> " + contadorFilas);
    console.log("Pagina contador -> " + paginaContador);

    if (contadorFilas < filasTotal) {
        $("#btnSiguienteConcierto").show();

    } else {
        $("#btnAnteriorConcierto").show();
        $("#btnSiguienteConcierto").hide();
    }

    if (contadorFilas + filasPorPagina >= filasTotal) {
        $("#btnSiguienteConcierto").hide();
    }

    if (paginaContador === 0 || contadorFilas === 0)
    {
        $("#btnSiguienteConcierto").show();
        $("#btnAnteriorConcierto").hide();
        console.log("llega");
    } else {
        $("#btnAnteriorConcierto").show();
    }
}

function Anterior() {

    paginaContador = paginaContador - filasPorPagina;
//    filasPorPagina = filasPorPagina - 5;

    if (paginaContador <= 0) {
        paginaContador = 0;
        filasPorPagina = 5;
    }

    recargarConciertos(function (result) {
        filasTotal = result.data[0].todos;
    });
}

function masVotados() {
    $("#pp_masVotados").empty();
    
    var query = `select usuario.usuario,musico.nombreartistico,genero.nombre,count(votacionmusico.idmusico) as votos from musico 
join votacionmusico on votacionmusico.idmusico = musico.idmusico join usuario on musico.idmusico = usuario.idusuario join genero on musico.generoID = genero.idgenero  group by votacionmusico.idmusico order by votos desc limit 10`;
    callAjaxBBDD(
            {
                action: "RawQueryRet",
                query: query
            }, function (result) {
        $("#pp_masVotados").append("<h2 class='blockLabel colorPrimary padding10' style='margin-left: 0.5em'>Músicos mas votados</h2>");

        $.each(result.data, function (i, item) {
            var template = "<div class='votosWrapperContainer'>";
            template += "<div class='votosWrapperImage'> <img class='votosImage' src='" + Main.obtenerUserDataPath(item.usuario) + "img/portada.jpg" + "' > </div>";
            template += `<div class='votosWrapperInfo'> <label class='blockLabel colorPrimary'>${item.nombreartistico}</label><label class='blockLabel colorPrimary'>Genero: ${item.nombre}</label><label class=''>Numero de votos: ${item.votos}</label></div>`;
            template += "</div>";
            $("#pp_masVotados").append(template);
        });
    });
}
function cargarPorGeneros() {

    var selectGeneros = 'SELECT musico.idmusico, musico.generoId, genero.nombre, musico.nombreartistico from musico inner join genero on genero.idgenero = musico.generoId order by genero.nombre;';
    callAjaxBBDD(
            {
                action: "RawQueryRet",
                query: selectGeneros
            }, function (result) {

        $.each(result.data, function (i, item) {

            var genero = item["nombre"];
            var generoSlide = $("<div>").addClass("musicoGeneroSlider");
            var slider = $("#pp_divGeneros .musicoGeneroSlider[data-generoNombre='" + genero + "']");
            if (slider.length > 0) {

                generoSlide = slider;
            } else {
                $(generoSlide).attr("data-generoNombre", genero);
                $(generoSlide).append(`<label class='blockLabel clickableElement musicoGeneroTitulo'>${genero}</label>`).addClass("colorPrimary");
            }

            var generoSlideContent = $("<div>").addClass("musicoGeneroSliderContent");
            $(generoSlide).append(generoSlideContent);
            $(generoSlide).find(".musicoGeneroTitulo").click(function () {

                $(generoSlideContent).slideToggle();
            });
            var selectMusicoInfo = `Select * from musico inner join usuario on musico.idmusico = usuario.idusuario where generoId = ${item["generoId"]} and idmusico = ${ item["idmusico"] }`;
            callAjaxBBDD(
                    {
                        action: "RawQueryOne",
                        query: selectMusicoInfo
                    }, function (json) {

//                VLog.log(json);
                var musico = $("<div>").addClass("musicoGeneroWrapperContainer");
                $(musico).unbind("click").bind("click", function () {

                    cambiarHash("musico_info_v2");
                    queueEvent(VInfo.MUSICO_INFO_V2, {data: json});
                });
                var fullPath = Main.obtenerUserDataPath(json["usuario"]) + "img/portada.jpg";
                var img = $('<img>').prop("src", fullPath);
                $(img).addClass("musicoGeneroWrapperImage clickableElement");
                var musicoGeneroWrapperInfo = $("<div class='musicoGeneroWrapperInfo centeredElementHorizontal' ></div>");
                var musicoLabel = $("<label>").addClass("blockLabel whiteText divPadding10");
                $(musicoLabel).text(json["nombreartistico"]);
                $(musicoGeneroWrapperInfo).append(musicoLabel);
                $(musico).append(img);
                $(musico).append(musicoGeneroWrapperInfo);
                $(generoSlideContent).append(musico);
            });
            $("#pp_divGeneros").append(generoSlide);
        });
//        console.log(result);
    });
}

function cargarConciertos()
{
    var selectNovedades = 'SELECT \nusuario.idusuario,\nusuario.nombre as usuarioNombre,\nusuario.usuario,\n    musico.idmusico,\n    musico.apellidos,\n    musico.telefono,\n    musico.web,\n    musico.nombreartistico,\n    genero.idgenero,\n    genero.nombre as generoNombre,\n    votacionmusico.idmusico as musicoLikeado,\n    votacionmusico.idfan as fanThatLiked\nFROM\n    musico\n        INNER JOIN\n    genero ON musico.generoId = genero.idgenero\n        INNER JOIN\n    votacionmusico ON votacionmusico.idmusico = musico.idmusico\n    INNER JOIN usuario on usuario.idusuario = musico.idmusico\n    \n ORDER BY genero.nombre LIMIT 3;';
    callAjaxBBDD(
            {
                action: "RawQueryRet",
                query: selectNovedades
            }, function (result) {
        $.each(result.data, function (i, item) {

            var usuario = item;
            var conciertoNovedadContainer = $("<div>").addClass("conciertoNovedadContainer");
            var conciertoBody = $("<div>").addClass("conciertoBody clickableElement ");
            var conciertoFooter = $("<div>").addClass("conciertoFooter clickableElement centeredElementHorizontal");
            $(conciertoBody).click(function () {

            });
//            console.log(item);

            var fullPath = Main.obtenerUserDataPath(usuario["usuario"]) + "img/concierto.jpg";
            var img = $('<img>').prop("src", fullPath);
            $(img).addClass("conciertoImageArt");
            var conciertoMusico = $("<div>").addClass("conciertoInfo");
            $(conciertoMusico).add("<label>").addClass("textoUpperCase divPadding10").text(usuario["usuario"]);
            var conciertoGenero = $("<div>").addClass("conciertoInfo");
            $(conciertoGenero).add("<label>").addClass("textoUpperCase divPadding10").text(usuario["usuario"]);
            $(conciertoFooter).append(conciertoMusico);
            $(conciertoBody).append(img);
            $(conciertoNovedadContainer).append(conciertoBody);
            $(conciertoNovedadContainer).append(conciertoFooter);
            $(".slickConciertos").append(conciertoNovedadContainer);
        });
        inicializarSlickNovedades();
    });
}

function cargarLocales() {

    $("#pp_divLocales").empty();
    $("#pp_divLocales").append("<label class='blockLabel colorPrimary padding10' style='margin-left: 0.5em'>Locales</label>");
    var selectGeneros = 'SELECT usuario.idusuario, usuario.usuario, usuario.nombre, usuario.tipo, local.aforo, local.portada, usuario.email, comunidades.munucipio from usuario inner join local on local.idlocal = usuario.idusuario inner join comunidades on comunidades.idciudad = usuario.ciudad order by comunidades.munucipio;';
    callAjaxBBDD(
            {
                action: "RawQueryRet",
                query: selectGeneros
            }, function (result) {
        console.log(result);

        $.each(result.data, function (i, item) {

            var fullPath = Main.obtenerUserDataPath(item["usuario"]) + "img/portada.jpg";

            var template = "<div class='localWrapperContainer'>";
            template += "<div class='localWrapperImage'> <img class='localImage' src='" + fullPath + "' > </div>";
            template += `<div class='localWrapperInfo'> <label class='blockLabel colorPrimary'>${ item.nombre}</label><label class=''>Lugar: ${item.munucipio}</label></div>`;
            template += "</div>";

            $("#pp_divLocales").append(template);
        });
    });
}

function inicializarSlickNovedades() {
    $('#divConciertosNovedad').slick({
        autoplay: false,
        autoplaySpeed: 1200,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick_boton_atras"><img class="botonImg" src="img/back.png" ></button>',
        nextArrow: '<button type="button" class="slick_boton_siguiente"><img class="botonImg" src="img/next.png" ></button>',
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrows: false
                }
            }
        ]
    });
}
