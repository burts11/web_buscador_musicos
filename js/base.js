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
    CLOSING: "vmodal.CLOSING"
};

var VMessage = {

    PAGINA_SESION_INICIADA: "page.logchecked",
    PAGINA_DROP_DOWN_ITEM_CLICKED: "page.dropdown.item.clicked"
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
        console.log("jeventw " + event);
        func.callback(e);
        $(window).off("'" + event + "'");
    });
}

function onJqueryWindowCallbackEvent(event, func) {

    $(window).on(event, function (e)
    {
        console.log("jevent " + event);
        func.callback(e);
        $(window).off("'" + event + "'");
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

function isFunctionDefined(func) {
    if (typeof func === "function") {
        return true;
    }
    
    return false;
}