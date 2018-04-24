var METHOD = {
    POST: "POST",
    GET: "GET"
};

var BBDD = {

    LOGIN: "LOGIN_SUCCESS",
    LOGIN_ERROR: "LOGIN_ERROR",
    LOGUEADO: "LOGUEADO",
    SESION_CERRADA_SUCCESS: "SESION_CERRADA",
    SESION_CERRADA_ERROR: "SESION_CERRADA_ERROR",
    USER: "LOGIN_USER",
    PASS: "LOGIN_PASS"
};

var VModalMessage = {

    READY: "vmodal.READY",
    BEFORE_SHOW: "vmodal.before.show",
    CLOSING: "vmodal.CLOSING"
};

var VMessage = {

    PAGINA_SESION_INICIADA: "page.logchecked",
    PAGINA_POPUP_MENU_ITEM_CLICKED: "page.popupmenu.item.clicked"
};

var VInfo = {

    MUSICO_INFO: "MUSICO_INFO",
    PERFIL_INFO: "PERFIL_INFO",
    CONCIERTO_INFO: "CONCIERTO_INFO",
    LOGIN_INFO: "LOGIN_INFO",
    MUSICO_INFO_V2: "MUSICO_INFO_V2",
    REGISTRAR_INFO: "REGISTRAR_INFO",
    PERFIL_INFO_UNKNOWN: "PERFIL_INFO_UNKNOWN"
};

function onJqueryReady(func) {

    $(document).ready(func());
}

function onJqueryCallbackEvent(event, func) {

    $(document).on(event, function (e)
    {
        func.callback(e);
        unbindJqueryEvent(event);
    });
}

function onJqueryWindowCallbackEventOne(event, func) {

    $(window).one(event, function (e)
    {
        func.callback(e);
        $(window).off("'" + event + "'");
    });
}

function onJqueryWindowCallbackEvent(event, func) {

    $(window).on(event, function (e)
    {
        func.callback(e);
//        $(window).off(event);
    });
}

function unbindJqueryEvent(event) {

    $(document).off(event);
}

function callJqueryWindowEvent(event, data) {

    $(window).trigger({
        type: event,
        json: data
    });
}

function callJqueryCustomEvent(event, data) {

    $.event.trigger({
        type: event,
        json: data
    });
}

function callJqueryEvent(data) {

    $.event.trigger({
        type: "modalDialogEvent",
        json: data
    });
}

function generateUniqueId() {

    var uniqueId = Math.random().toString(36).substring(2)
            + (new Date()).getTime().toString(36);

    return uniqueId;
}

function isFunctionDefined(func) {
    if (typeof func === "function") {
        return true;
    }

    return false;
}

function jsonEmpty(json) {
    if (jQuery.isEmptyObject(json))
    {
        return true;
    }
    return false;
}

