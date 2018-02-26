var default_content = "";
var lastURL = "";

$(document).ready(function () {

    asignarBotonesMenu();
    default_content = $('#_divMainContent').html();
});

function asignarBotonesMenu() {

    $('#_mainMenu div a').click(function (e) {

        setActive(e.currentTarget);

        var page = $(e.currentTarget).attr("data-href");
        cambiarPagina(page);
    });
}

function cambiarPagina(hash)
{
    if (!hash) {
        hash = window.location.hash;
    }

    if (hash !== lastURL)
    {
        lasturl = hash;

        // FIX - if we've used the history buttons to return to the homepage,
        // fill the pageContent with the default_content

        if (hash === "") {
            $('#_divMainContent').html(default_content);
        } else {
            loadHashPage(hash);
        }
    }
}

function loadHashPage(url) {

    loadPage(url, {
        success: function (data) {
            $('#_divMainContent').stop().empty().hide().html(data).fadeIn();
            $("#_divMainContent link").each(function () {

                try {
                    var cssLink = $(this).attr('href');
                    cssLink = cssLink.replace('../', '');
                    appendCSS(cssLink);
                    $(this).remove();
                } catch (err) {
                    console.log("Load Page CSS -> " + err.message);
                }
            });
            $("#_divMainContent script").each(function () {

                var jsLink = $(this).attr('src');
                if (jsLink !== null) {

                    try {
                        jsLink = jsLink.replace('../', '');
                        appendScript(jsLink);
                    } catch (err) {
                        console.log("Load Page JS -> " + err.message);
                    }

                    $(this).remove();
                }
            });
        },
        error: function (err) {

        }
    });
}

function loadPage(url, func)
{
//    url = url.replace('#', '');

//    $('#loading').css('visibility', 'visible');

    $.ajax({
        type: "POST",
        url: "bbdd/PageManager.php",
        data: 'page=' + url,
        dataType: "html",
        success: function (data) {

            func.success(data);
        },
        error: function (err) {
            func.error(err);
        }
    }
    );
}

function setActive(currentElement) {

    $("#_mainMenu > div").removeClass("menuItemContainer-Selected");
    $("#_mainMenu > div > a").removeAttr("data-active");

    var a = currentElement;
    $(a).attr('data-active', "true");

    var parentDiv = $(a).parent("div");
    $(parentDiv).addClass("menuItemContainer-Selected");
}

function appendScriptInline(id, javascript, where) {

    var loaded = isScriptLoadedById(id);
    if (loaded)
    {
        $('script[id="' + id + '"]').remove();
    }

    $("<script>").prop("type", "text/javascript").prop("id", id).html(javascript).appendTo(where);
}

function appendCSSInline(id, css, where) {

    var loaded = isCssLoadedById(id);
    if (loaded)
    {
        $('style[id="' + id + '"]').remove();
    }

    $("<style>").prop("type", "text/css").prop("id", id).html(css).appendTo(where);
}

function appendScript(url) {
    var loaded = isScriptLoaded(url);

    if (loaded)
    {
        $('script[src="' + url + '"]').remove();
    }

    $("head").append("<script src='" + url + "' type='text/javascript'></script> ");
}

function appendCSS(url) {

    var css = $('link[href="' + url + '"]');

    if (css.length > 0) {
        $(css).remove();
    }

    $("head").append("<link rel='stylesheet' href='" + url + "' type='text/css'/>");
}

function isScriptLoaded(lib) {
    return document.querySelectorAll('[src="' + lib + '"]').length > 0;
}

function isScriptLoadedById(lib) {
    var sel = $('script[id="' + lib + '"]');
    return sel.length > 0;
}

function isCssLoadedById(id) {

    var sel = $('style[id="' + id + '"]');
    return sel.length > 0;
}

