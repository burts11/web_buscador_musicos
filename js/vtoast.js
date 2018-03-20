var VToast = {

    mostrarMensaje: function (mensaje) {

        VToast.toast("", mensaje, "info");
        console.log(mensaje);
    },
    mostrarError: function (mensaje) {
        VToast.toast("", mensaje, "error");
        console.log(mensaje);
    },
    mostrarAdvertencia: function (mensaje) {
        VToast.toast("", mensaje, "warning");
        console.log(mensaje);
    },
    mostrarNotice: function (mensaje) {
        VToast.toast("", mensaje, "notice");
        console.log(mensaje);
    },
    log: function (mensaje) {
        console.log(mensaje);
    },
    logS: function (mensaje) {
        console.log("<- " + mensaje + " ->");
    },
    logF: function (mensaje) {
        console.log("<- " + mensaje + " -/>");
    },
    toast: function (titulo, texto, tipo) {
        var options = {

            // append to body
            appendTo: "body",

            // is stackable?
            stack: true,

            // 'toast-top-left'
            // 'toast-top-right'
            // 'toast-top-center'
            // 'toast-bottom-left'
            // 'toast-bottom-right'
            // 'toast-bottom-center'
            position_class: "toast-bottom-right",

            // true = snackbar
            fullscreen: false,

            // width
            width: 250,

            // space between toasts
            spacing: 10,

            // in milliseconds
            timeout: 4000,

            // has close button
            has_close_btn: true,

            // has icon
            has_icon: false,

            // is sticky
            sticky: false,

            // border radius in pixels
            border_radius: 6,

            // has progress bar
            has_progress: true,

            // RTL support
            rtl: false
        };

        $.Toast(titulo, texto, tipo, options);
    }
};


