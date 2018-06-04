cargarMusicos();
cargarConciertos();
agregarBotones();

function agregarBotones() {
    var Siguiente = $("<button type='button' id='btnSiguienteConcierto' class='form-control-btn' onclick='Siguiente()'>Siguiente</button>");
    var Anterior = $("<button type='button' id='btnAnteriorConcierto' class='form-control-btn' onclick='Anterior()'>Anterior</button>");
    $("#botones").empty();
    $("#botones").append(Siguiente);
    $("#botones").append(Anterior);
}

recargarConciertos(function (result) {
    var cuenta = result.data[0].todos;
    filasTotal = cuenta;

    if (paginaContador <= 0) {
        $("#btnAnteriorConcierto").hide();
    }
});
function cargarMusicos() {
    callAjaxBBDD({
        action: "RawQueryRet",
        query: "SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;"
    }, function (result) {

        $("#divMusicosFan").empty();

        $.each(result.data, function (i, item) {

            var usuario = item;
            var usuarioId = usuario["idusuario"];
            var nombre = usuario ["nombre"];
            var nombreartistico = usuario ["nombreartistico"];
            var genero = "";

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

            $(musicoFooter).append($("<div>").addClass("musicoVoteContainer clickableElement"));

            $(musicoFooter).find(".musicoVoteContainer").append("<img>");
            $(musicoFooter).find("img").addClass("musicoVoteBtn").prop("src", "img/btn_vote.png");

            callAjaxBBDD(
                    {
                        action: "RawQueryOne", query: `select * from votacionmusico where idfan = ${Usuario.id} and idmusico = ${usuarioId} `
                    }, function (json) {

                if (!jsonEmpty(json)) {

                    $(musicoFooter).find(".musicoVoteBtn").prop("src", "img/btn_liked.png");
                }
            });

            $(div).append(musicoBody);
            $(div).append(musicoFooter);

            $(musicoBody).unbind("click").bind("click", function () {

                VModal.show("musico_info", item, {modalEffect: "vModalFadeIn-show", VModalId: generateUniqueId(),
                    ContentPadding: "0px"}, {
                    onDialogShow: function (ev) {

                        ev["usuarioId"] = usuarioId;
                        ev["vparams"]["sender"] = "musico_info_fan";

//                        queueEvent(VInfo.MUSICO_INFO, ev);
                        callJqueryWindowEvent(VInfo.MUSICO_INFO, ev);
                    },
                    onDialogClose: function (ev) {
                    }
                });
            });

            $(musicoFooter).find(".musicoVoteContainer").unbind("click").bind("click", function () {

                callAjaxBBDD(
                        {
                            action: "RawQueryRet", query: `select * from votacionmusico where idfan = ${Usuario.id} and idmusico = ${usuario["idusuario"]} `
                        }, function (json) {

                    if (!jsonEmpty(json.data)) {

                        callAjaxBBDD({

                            action: "RawQueryRet",
                            query: `DELETE FROM votacionmusico where idfan = ${Usuario.id} and idmusico = ${usuarioId}`
                        }, function (json) {

                            VToast.log("Unliked " + nombre);

                            if (success(json)) {
                                $(musicoFooter).find(".musicoVoteBtn").prop("src", "img/btn_vote.png");
                            }
                        });
                    } else {
                        callAjaxBBDD({

                            action: "RawQueryRet",
                            query: `INSERT INTO votacionmusico VALUES(${usuarioId}, ${Usuario.id})`
                        }, function (json) {

                            if (success(json)) {
                                VToast.log("Liked " + nombre);
                                $(musicoFooter).find(".musicoVoteBtn").prop("src", "img/btn_liked.png");
                            }
                        });
                    }
                });
            });

            $(musicoBody).mouseenter(function () {
                $(musicoBody).find(".musicoAlbumArtImg").addClass("zoomMusicoIn");
                $(musicoBody).find(".musicoBodyOver").addClass("fade-in-musico").show();
            });

            $(musicoBody).mouseleave(function () {

                $(musicoBody).find(".musicoBodyOver").stop().animate({opacity: 0}, 200);
                $(musicoBody).find(".musicoBodyOver").removeClass("fade-in-musico");
                $(musicoBody).find(".musicoAlbumArtImg").removeClass("zoomMusicoIn").addClass("zoomMusicoOut");
            });

            $("#divMusicosFan").append(div);
            $(div).addClass("musicoAnimIn");
            setTimeout(function () {

                $(div).addClass("musicoAnimIn2");
            }, 20);
        });
    });
}

var paginaContador = 0;
var filasPorPagina = 5;
var filasTotal = 0;

function cargarConciertos() {
    callAjaxBBDD({
        action: "RawQueryRet",
        query: `SELECT concierto.idconcierto, concierto.fecha, usuario.usuario, usuario.nombre, genero.nombre as generoNombre FROM concierto INNER JOIN local on concierto.idlocal = local.idlocal INNER JOIN usuario on usuario.idusuario = concierto.idlocal INNER JOIN genero on genero.idgenero = concierto.genero where concierto.estado = 1 limit ${paginaContador},${filasPorPagina};`
    }, function (result) {

        $("#divConciertosFan").empty();

        $.each(result.data, function (i, item) {

            var div = $("<div>").addClass("conciertoContainer");

            var conciertoBody = $("<div>").addClass("conciertoBody clickableElement");
            var conciertoFooter = $("<div>").addClass("conciertoFooter");

            $(conciertoBody).append($("<div>").addClass("conciertoAlbumArtContainer"));
            $(conciertoBody).append("<div class='conciertoBodyOver'>");

            $(conciertoFooter).append($("<div>").addClass("conciertoInfo"));

            $(div).append(conciertoBody);
            $(div).append(conciertoFooter);

            var usuario = item.usuario;
            var nombre = item.nombre;
            var fecha = item.fecha;
            var genero = item.generoNombre;
            var conciertoId = item.idconcierto;

            var nombreLocalDiv = $("<div>").addClass("blockDiv");
            var nombreLocalLang = $("<label lang='es' data-lang-token='Concierto_Info_Usuario'></>")
                    .addClass("musicoInfoTexto").text("Nombre local: ");
            var nombreLocalReal = $("<label>").addClass("musicoInfoTexto").text(usuario);

            $(nombreLocalDiv).append(nombreLocalLang).append(nombreLocalReal);

            var fechaDiv = $("<div>").addClass("blockDiv");
            var fechaLang = $("<label lang='es' data-lang-token='Concierto_Info_Fecha'></>")
                    .addClass("musicoInfoTexto").text("Fecha : ");
            var fechaReal = $("<label>").addClass("musicoInfoTexto ").text(fecha);
            $(fechaDiv).append(fechaLang).append(fechaReal);

            var generoDiv = $("<div>").addClass("blockDiv");
            var generoLang = $("<label lang='es' data-lang-token='Concierto_Info_Genero'></>")
                    .addClass("musicoInfoTexto").text("Género : ");
            var generoReal = $("<label>").addClass("musicoInfoTexto ").text(genero);
            $(generoDiv).append(generoLang).append(generoReal);

            $(conciertoBody).append(nombreLocalDiv);
            $(conciertoBody).append(fechaDiv);
            $(conciertoBody).append(generoDiv);

            $(conciertoFooter).append($("<div>").addClass("conciertoVoteContainer clickableElement"));

            $(conciertoFooter).find(".conciertoVoteContainer").append("<img>");
            $(conciertoFooter).find("img").addClass("conciertoVoteBtn").prop("src", "img/btn_vote.png");

            callAjaxBBDD(
                    {
                        action: "RawQueryRet", query: `select * from votacionconcierto where idfan = ${Usuario.id} and idconcierto = ${conciertoId} `
                    }, function (json) {

                if (!jsonEmpty(json.data)) {
                    $(conciertoFooter).find(".conciertoVoteBtn").prop("src", "img/btn_liked.png");
                }
            });

            $(conciertoFooter).find(".conciertoVoteContainer").unbind("click").bind("click", function () {

                callAjaxBBDD(
                        {
                            action: "RawQueryRet", query: `select * from votacionconcierto where idfan = ${Usuario.id} and idconcierto = ${conciertoId} `
                        }, function (json) {
                    if (!jsonEmpty(json.data)) {

                        callAjaxBBDD({

                            action: "RawQueryRet",
                            query: `DELETE FROM votacionconcierto where idfan = ${Usuario.id} and idconcierto = ${conciertoId} `
                        }, function (json) {

                            VToast.log("Unliked " + nombre);
                            if (success(json)) {
                                $(conciertoFooter).find(".conciertoVoteBtn").prop("src", "img/btn_vote.png");
                            }
                        });
                    } else {

                        callAjaxBBDD({

                            action: "RawQueryRet",
                            query: `INSERT INTO votacionconcierto VALUES(${conciertoId}, ${Usuario.id})`
                        }, function (json) {

                            if (success(json)) {
                                VToast.log("Liked " + nombre);
                                $(conciertoFooter).find(".conciertoVoteBtn").prop("src", "img/btn_liked.png");
                            } else {
                                VToast.log("Error al darle like a " + nombre);
                            }
                        });
                    }
                });
            });

            $("#divConciertosFan").append(div);
            $(div).addClass("musicoAnimIn");
            setTimeout(function () {

                $(div).addClass("musicoAnimIn2");
            }, 20);
        });
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
        cargarConciertos();
    });
}

function Siguiente() {
    paginaContador = paginaContador + filasPorPagina;

//    if (paginaContador >= filasTotal) {
//        paginaContador = filasTotal - 5;
//        filasPorPagina = filasTotal;
//    }
    recargarConciertos(function (result) {
        filasTotal = result.data[0].todos;

        if ((paginaContador + filasPorPagina) < filasTotal) {
            $("#btnSiguienteConcierto").show();
        } else {
            $("#btnSiguienteConcierto").hide();
        }

        if (paginaContador >= 5) {
            $("#btnAnteriorConcierto").show();
        } else {
            $("#btnAnteriorConcierto").hide();
        }
    });
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

        console.log("Filas total -> " + filasTotal);
        console.log("Filas contador -> " + paginaContador);

        if (paginaContador >= 5) {
            $("#btnAnteriorConcierto").show();
        } else {
            $("#btnAnteriorConcierto").hide();
        }

        if ((paginaContador + filasPorPagina) < filasTotal) {
            $("#btnSiguienteConcierto").show();
        } else {
            $("#btnSiguienteConcierto").hide();
        }
    });
}