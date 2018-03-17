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

//                var $mainDiv = "#_mainDiv";

//                $($mainDiv).addClass("blurred__");

                agregarVModalCSS();

                var modalId = $(modalTriggerDom).attr("data-modal");
                var modalEffect = "md-effect-5";

                if (params !== null) {

                    modalId = asignarJsonValueSiExiste("VModalId", params);
                    modalEffect = asignarJsonValueSiExiste("modalEffect", params);
                }

                var $modalId = "#" + modalId;

//                params["modalEffect"] = modalEffect;

                var modalOverlayId = "_main_overlay_" + modalId;

                $("#_mainDiv").find("#" + modalOverlayId).hide().remove();
                $("#_mainDiv").find("#" + modalId).hide().remove();

                var modalMainDiv = '<div class="md-modal ' + modalEffect + ' " style="display:none;" id="' + modalId + '">' +
                        '<div class="md-modal-closeDiv md-close" id="__modal_close_btn">' +
                        '<img class="md-closeBtn fade-in centeredElement clickableElement" src="img/btn-close.png">' +
                        '</div>' +
                        '<div class="md-content md-content_v2">' +
                        '</div>' +
                        '</div>'
                        + ' <div class="md-overlay" id="' + modalOverlayId + '"></div>';

                var modalInlineCSS = "#__modal_close_btn { display: none;}  .md-overlay {background:transparent;background-color:rgba(0,0,0,0.5)}.md-closeBtn{display:block;width:100%;height:100%;position:relative}.md-content_v2{ height:0px; margin-top:4px;display:block;position:relative;z-index:1000;margin-top:20px !important; padding-right:20px !important}.md-modal-closeDiv{position:relative;display:block;width:32px;height:32px;float:right;right:-0.5em;top:0.5em;z-index:2000}";
                modalInlineCSS = modalInlineCSS.replace("_main_overlay", modalOverlayId);

                appendCSSInline("vmodal_inline_style", modalInlineCSS, "head");

                $("#_mainDiv").append(modalMainDiv);

                var $modalObject = $("#_mainDiv").find("#" + modalId);

                if (params.hasOwnProperty("FullSize")) {

                    console.log("full size not null");
                    $($modalId).addClass("md-modal-full-size");
                }

                if (params.hasOwnProperty("CustomSize")) {

                    $($modalId).addClass("md-modal-custom-size");
                    $($modalId).find(".md-content").addClass("md-modal-custom-size");

                    var customSize = params["CustomSize"];
//                    console.log(customSize);
                    if (customSize === "true") {

//                        console.log($("#_mainDiv").find("#" + modalId));
                        var width = params["modalWidth"];
                        var height = params["modalHeight"];

                        var minifySize = `.md-modal-custom-size{width:${width} !important;max-width:none!important;max-height:none!important;height:${height} !important} ${ $modalId } .md-content_v2 { padding-right:0px !important} `;
                        appendCSSInline("minifyCustomSize", minifySize, $modalObject);
                    }
                }

                if (params.hasOwnProperty("CustomPadding")) {

                    var paddingSettings = params["padding"];
                    var minifyPadding = `${  $modalId } .__root_modal_content { padding: ${paddingSettings } !important}`;

                    appendCSSInline("minifyCustomPadding", minifyPadding, $modalObject);
                }

                var modalCloseBtn = $("#" + modalId).find("#__modal_close_btn");
                $(modalCloseBtn).unbind("click").bind("click", function (e) {

                    if (isFunctionDefined(func.onDialogClose)) {
                        func.onDialogClose(e.currentTarget);
                    }

                    $("#" + modalId).removeClass("md-show");
//                    $($mainDiv).removeClass("blurred__");
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
//                var childContainer = $(modalContentHTTML).find("._childContainer");

                $("#" + modalId + " > .md-content").append(modalContentHTTML);

                setTimeout(
                        function ()
                        {
                            $("#" + modalId).show();

                            params["close"] = function () {
                                VModal.closeWithId(modalId);
                            };

                            params["onDialogContentLoaded"] = function () {

                                console.log("< - Modal Id: " + modalId + " ->");
                                console.log({vparams: params});

                                $("#" + modalId + " .md-content_v2").css({height: "auto"});
                                $("#" + modalId).addClass("md-show");

                                if (params["modalEffect"] === "md-effect-13") {
                                    $("#" + modalId + " #__modal_close_btn").show("slow");

                                    console.log("Animación finalizada");
                                    console.log("< - Modal Id: " + modalId + " -/>");
                                }

                                $("#" + modalId + " .md-content").off().one('OAnimation WebkitAnimation msAnimationEnd webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {

                                    $("#" + modalId + " #__modal_close_btn").show("slow");

                                    console.log("Animación finalizada");
                                    console.log("< - Modal Id: " + modalId + " -/>");

                                    if (isFunctionDefined(func.onDialogDomAnimation)) {
                                        func.onDialogDomAnimation({vparams: params});
                                    }

                                    $(this).off();
                                });
                                
//                                callJqueryWindowEvent(modalId )
                            };

                            if (isFunctionDefined(func.onDialogShow)) {
                                func.onDialogShow({vparams: params});
                            }
                        }, 10);
            },
            error: function (err) {
                alert("VMODAL -> " + err);
            }
        });
    }
};

function asignarJsonValueSiExiste(jsonValue, params) {

    if (params.hasOwnProperty(jsonValue)) {

        return params[jsonValue];
    }
}

function removerScriptYCSS(data) {

    var temp = $('<div class="__root_modal_content">').html(data);
    $(temp).find('script').each(function () {

        var jsLink = $(this).attr('src');
        if (jsLink !== null && jsLink !== undefined) {
            console.log("JSLINK -> " + jsLink);

            try {
                jsLink = jsLink.replace('../', '');
                appendScript(jsLink);
                $(this).remove();
            } catch (err) {
                console.log("VModal Load JS -> " + err.message);
            }
        }
    });

    $(temp).find('link').each(function () {
        try {
            var cssLink = $(this).attr('href');
            cssLink = cssLink.replace('../', '');
            appendCSS(cssLink);
//            console.log("style -> " + cssLink);
            $(this).remove();
        } catch (err) {
            console.log("VModal Load CSS -> " + err.message);
        }
    });

    return temp;
}

function agregarVModalCSS() {

//    appendScript("js/modalEffects.js");
//    appendScript("js/modernizr.custom.js");
    appendCSS("css/component.css");
}