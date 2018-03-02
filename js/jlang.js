//appendScript("js/js.cookie.js");
//appendScript("js/jquery-lang.js");

//onJqueryReady(function () {
//
//    load();
//});

var lang = new Lang();
lang.dynamic('en', 'langpack/en.json');
lang.dynamic('es', 'langpack/es.json');

lang.init({
    defaultLang: 'es',
    currentLang: 'es'
});

$(".mainButton").click(function () {
    window.lang.change("en", "", function (e, v, i) {
        console.log(e);
        console.log(v);
        console.log(i);

        window.lang.change("en");
    });

});



