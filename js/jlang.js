var lang = new Lang();
lang.dynamic('en', 'langpack/en.json');
lang.dynamic('es', 'langpack/es.json');

lang.init({
    defaultLang: "es",
    currentLang: "es"
});

var JLang = {

    obtenerIdioma: function () {
        var idiomaId = localStorage.getItem("idiomaId");
        if (idiomaId === null) {
            return "es";
        }
        return localStorage.getItem("idiomaId");
    }
    ,
    guardarIdioma: function (idioma) {

        var idiomaId = localStorage.getItem("idiomaId");
        if (idiomaId === null) {
            localStorage.setItem("idiomaId", "");
        }

        localStorage.setItem("idiomaId", idioma);
    },
    cambiarIdioma: function (idiomaId) {
        console.log("Cambiar idioma!" + idiomaId);
        _cambiarIdioma(idiomaId, function (idiomaId) {

        });
    },
    cargarIdiomaDefault: function (func) {

        var id = JLang.obtenerIdioma();
        _cambiarIdioma(id, function (idiomaId) {
            func(idiomaId);
        });
    }
};

function _cambiarIdioma(idiomaId, func) {

    window.lang.change(idiomaId, "", function (e, v, i) {
        window.lang.change(idiomaId);
        func(idiomaId);
        JLang.guardarIdioma(idiomaId);
    });
}




