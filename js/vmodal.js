var VModal = {

    dom: function (identifier) {

        var k = $(identifier);
        return k;
    },
    close: function (e) {

        $("#__modal_close_btn").click();
    },
    closeWithId: function (id) {

        $("#" + id + " #__modal_close_btn").click();
        $("#" + id).remove();
    },
    show: function (contentHREF, modalTriggerDom, params, func) {

        loadPage(contentHREF, {

            success: function (data) {

                agregarVModalCSS();

                var modalId = $(modalTriggerDom).attr("data-modal");
                var modalEffect = "md-effect-5";

                if (params !== null) {

                    modalId = asignarJsonValueSiExiste("VModalId", params);
                    modalEffect = asignarJsonValueSiExiste("modalEffect", params);
                }

                var modalOverlayId = "_main_overlay_" + modalId;

                $("#_mainDiv").find("#" + modalOverlayId).hide().remove();
                $("#_mainDiv").find("#" + modalId).hide().remove();

                var modalMainDiv = '<div class="md-modal ' + modalEffect + '" style="display:none;" id="' + modalId + '">' +
                        '<div class="md-modal-closeDiv md-close" id="__modal_close_btn">' +
                        '<img class="md-closeBtn fade-in centeredElement clickableElement" src="img/btn-close.png">' +
                        '</div>' +
                        '<div class="md-content md-content_v2">' +
                        '</div>' +
                        '</div>'
                        + ' <div class="md-overlay" id="' + modalOverlayId + '"></div>';

                var modalInlineCSS = "#__modal_close_btn { display: none;}  #_main_overlay{background:transparent;background-color:rgba(0,0,0,0.1)}.md-closeBtn{display:block;width:100%;height:100%;position:relative}.md-content_v2{margin-top:4px;display:block;position:relative;z-index:1000;margin-top:20px !important}.md-modal-closeDiv{position:relative;display:block;width:32px;height:32px;float:right;right:-0.5em;top:0.5em;z-index:2000}";
                modalInlineCSS = modalInlineCSS.replace("_main_overlay", modalOverlayId);
                appendCSSInline("vmodal_inline_style", modalInlineCSS, "head");

                $("#_mainDiv").append(modalMainDiv);

                var modalCloseBtn = $("#" + modalId).find("#__modal_close_btn");
                $(modalCloseBtn).unbind("click").bind("click", function (e) {

                    if (isFunctionDefined(func.onDialogClose)) {
                        func.onDialogClose(e.currentTarget);
                    }

                    $("#" + modalId).removeClass("md-show");
                    setTimeout(
                            function ()
                            {
                                $("#" + modalId).remove();
                                $("#" + modalOverlayId).remove();
                            }, 50);
                });

// esconder el boton de cerrar para mostrarlo con una animación
                $("#" + modalId + " #__modal_close_btn").hide();

                var modalContentHTTML = removerScriptYCSS(data);
                $("#" + modalId + " > .md-content").append(modalContentHTTML);

                setTimeout(
                        function ()
                        {
                            $("#" + modalId).show();
                            $("#" + modalId).addClass("md-show");

                            $("#" + modalId + " .md-content").off().one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {

                                console.log("VModal transition finalizada");
                                $("#" + modalId + " #__modal_close_btn").show("slow");
                                callJqueryWindowEvent(VModalMessage.READY, {modalId: modalId});

                                if (isFunctionDefined(func.onDialogShow)) {
                                    func.onDialogShow({modalId: modalId});
                                }

                                $(this).off();
                            });
                        }, 10);
            },
            error: function (err) {
                alert("VMODAL -> " + err);
            }
        });
    }
};

function asignarJsonValueSiExiste(jsonValue, params) {

    if (params[jsonValue] !== null) {

        return params[jsonValue];
    }
}

function removerScriptYCSS(data) {

    var temp = $('<div>').append($(data));
    $(temp).find('script').each(function () {

        var jsLink = $(this).attr('src');
        if (jsLink !== null) {

            try {
                jsLink = jsLink.replace('../', '');
                appendScript(jsLink);
                $(this).remove();
            } catch (err) {
                console.log("Load Page JS -> " + err.message);
            }
        }
    });
    $(temp).find('style').each(function () {
        try {
            var cssLink = $(this).attr('href');
            cssLink = cssLink.replace('../', '');
            appendCSS(cssLink);
            $(this).remove();
        } catch (err) {
            console.log("Load Page CSS -> " + err.message);
        }
    });

    return temp;
}

function agregarVModalCSS() {

//    appendScript("js/modalEffects.js");
//    appendScript("js/modernizr.custom.js");
    appendCSS("css/component.css");
}