var VLog = {

    DEBUG_MODE: true,
    log: function (mensaje) {

        if (VLog.DEBUG_MODE) {
            console.log(mensaje);
        }
    },
    logS: function (mensaje) {

        if (VLog.DEBUG_MODE) {
            console.log("<- " + mensaje + " ->");
        }
    },
    logF: function (mensaje) {
        if (VLog.DEBUG_MODE) {
            console.log("<- " + mensaje + " -/>");
        }
    }
};


