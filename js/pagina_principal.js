iniciar();
cargarLocales();
cargarConciertos();
cargarPorGeneros();

function iniciar() {

    $("#pp_divGeneros").empty();
    $("#pp_divMusicos").empty();
    $("#pp_divLocales").empty();
    $(".slickConciertos").empty();
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

                var fullPath = Main.obtenerUserDataPath(json["usuario"]) + "img/album_art.jpg";
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
    $("#pp_divLocales").append("<h2 class='colorPrimary padding10' style='margin-left: 0.5em'>Locales</h2>");

    var selectGeneros = 'SELECT usuario.idusuario, usuario.nombre, usuario.tipo, local.aforo, local.imagen, usuario.email from usuario inner join local on local.idlocal = usuario.idusuario order by usuario.nombre;';

    callAjaxBBDD(
            {
                action: "RawQueryRet",
                query: selectGeneros
            }, function (result) {
        $.each(result.data, function (i, item) {

            var template = "<div class='localWrapperContainer'>";
            template += "<div class='localWrapperImage'> <img class='localImage' > </div>";
            template += `<div class='localWrapperInfo'> <label class='blockLabel colorPrimary centeredElement'> ${ item.nombre} </label></div>`;
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
