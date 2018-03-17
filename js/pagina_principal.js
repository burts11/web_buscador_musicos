iniciar();
cargarConciertos();
cargarPorGeneros();

function iniciar() {

    $("#divGeneros").empty();
    $("#divMusicos").empty();
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
            var slider = $("#divGeneros .musicoGeneroSlider[data-generoNombre='" + genero + "']");

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

                var fullPath = Main.obtenerUserDataPath(json["usuario"]) + "img/album_art.jpg";
                var img = $('<img>').prop("src", fullPath);
                $(img).addClass("musicoGeneroWrapperImage clickableElement");

                var musicoGeneroWrapperInfo = $("<div class=' musicoGeneroWrapperInfo centeredElementHorizontal' ></div>");

                var musicoLabel = $("<label>").addClass("blockLabel whiteText divPadding10");
                $(musicoLabel).text(json["nombreartistico"]);
                $(musicoGeneroWrapperInfo).append(musicoLabel);

                $(musico).append(img);
                $(musico).append(musicoGeneroWrapperInfo);

                $(generoSlideContent).append(musico);
            });

            $("#divGeneros").append(generoSlide);
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
            
            console.log(item);

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

function inicializarSlickNovedades() {

    $('#divConciertosNovedad').slick({
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

function cargarMusicos() {
    $("#divMusicos").empty();

    var select = "SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;";

    callAjaxBBDD(
            {
                action: "RawQuery",
                query: select
            }, function (result) {

        $("#divMusicos").empty();

        for (var i = 0; i < 1; i++) {

            $.each(result, function (i, item) {

                var usuario = item;
//            var nombre = usuario ["nombre"];
                var nombreartistico = usuario ["nombreartistico"];
                var genero = usuario ["genero"];

                var div = $("<div>").addClass("musicoContainer");

                var musicoBody = $("<div>").addClass("musicoBody clickableElement");
                var musicoFooter = $("<div>").addClass("musicoFooter");

                $(musicoBody).append($("<div>").addClass("musicoAlbumArtContainer"));
                $(musicoBody).append("<div class='musicoBodyOver'>");

                var fullPath = Main.obtenerUserDataPath(usuario["usuario"]) + "img/album_art.jpg";
                $(musicoBody).find(".musicoAlbumArtContainer").append("<img>").find("img").addClass("musicoAlbumArtImg").prop("src", fullPath);

                $(musicoFooter).append($("<div>").addClass("musicoInfo"));

                var nombreArtisticoDiv = $("<div>").addClass("blockDiv");
                var nombreArtisticoLang = $("<label lang='es' data-lang-token='MusicoInfoNombreArtistico'></>")
                        .addClass("musicoInfoTexto").text("Nombre artístico: ");
                var nombreArtisticoReal = $("<label>").addClass("musicoInfoTexto ").text(nombreartistico);

                $(nombreArtisticoDiv).append(nombreArtisticoLang).append(nombreArtisticoReal);

                var generoDiv = $("<div>").addClass("blockDiv");
                var generoLang = $("<label lang='es' data-lang-token='MusicoInfoGenero'></>")
                        .addClass("musicoInfoTexto").text("Género : ");
                var generoReal = $("<label>").addClass("musicoInfoTexto ").text(genero);

                $(generoDiv).append(generoLang).append(generoReal);

                $(musicoFooter).find(".musicoInfo").append(nombreArtisticoDiv);
                $(musicoFooter).find(".musicoInfo").append(generoDiv);

                $(div).append(musicoBody);
                $(div).append(musicoFooter);

                $(musicoBody).bind("click", function () {

                    VModal.show("musico_info", item, {modalEffect: "md-effect-8", VModalId: generateUniqueId()}, {
                        onDialogShow: function (ev) {

                            var usuarioId = usuario["idusuario"];
                            ev["usuarioId"] = usuarioId;
                            ev["vparams"]["sender"] = "musico_info_principal";

                            callJqueryWindowEvent(VInfo.MUSICO_INFO, ev);
                        },
                        onDialogClose: function (ev) {
                        }
                    });
                });

                $(musicoBody).mouseenter(function () {
                    $(musicoBody).find(".musicoBodyOver").stop(true, true).show().addClass("fade-in-musico");
                    $(musicoBody).find(".musicoAlbumArtImg").addClass("zoomMusicoIn");
                });

                $(musicoBody).mouseleave(function () {
                    $(musicoBody).find(".musicoBodyOver").removeClass("fade-in-musico").stop(true, true).fadeOut();
                    $(musicoBody).find(".musicoAlbumArtImg").removeClass("zoomMusicoIn").addClass("zoomMusicoOut");
                });

                $("#divMusicos").append(div);

                $(div).addClass("musicoAnimIn");

                setTimeout(function () {

                    $(div).addClass("musicoAnimIn2");

                }, 20);
            });
        }
    });
}
