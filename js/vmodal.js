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
    show: function (contentHREF, modalTriggerDom, func) {

        loadPage(contentHREF, {

            success: function (data) {
                agregarArchivosNesesarios();

                var k = modalTriggerDom;
                var modalId = $(k).attr("data-modal");

                $("#_mainDiv").find("#_main_overlay").hide().remove();
                $("#_mainDiv").find("#" + modalId).hide().remove();
                var modalMainDiv = '<div class="md-modal md-effect-5" style="display:none;" id="' + modalId + '">' +
                        '           <div class="md-modal-closeDiv md-close" id="__modal_close_btn">' +
                        '           <img class="md-closeBtn fade-in centeredElement clickableElement" src="img/btn-close.png">' +
                        '            </div>' +
                        '            <div class="md-content md-content_v2">' +
                        '            </div>' +
                        '           </div>'
                        + ' <div class="md-overlay" id="_main_overlay"></div>';
                var modalDialogLayoutCSS = "#__modal_close_btn { display: none;}  #_main_overlay{background:transparent;background-color:rgba(0,0,0,0.1)}.md-closeBtn{display:block;width:100%;height:100%;position:relative}.md-content_v2{margin-top:4px;display:block;position:relative;z-index:1000;margin-top:20px !important}.md-modal-closeDiv{position:relative;display:block;width:32px;height:32px;float:right;right:-0.5em;top:0.5em;z-index:2000}";
                appendCSSInline("modal_dialog_inline", modalDialogLayoutCSS, "head");
                $("#_mainDiv").append(modalMainDiv);

                var modalCloseBtn = $("#" + modalId).find("#__modal_close_btn");
                $(modalCloseBtn).unbind("click").bind("click", function (e) {

                    if (typeof func.onDialogClose === "function") {
                        func.onDialogClose(e.currentTarget);
                    }

                    $("#" + modalId).removeClass("md-show");
                    setTimeout(
                            function ()
                            {
                                $("#" + modalId).remove();
                                $("#" + "_main_overlay").remove();
                            }, 500);
                });

                $("#" + modalId + " #__modal_close_btn").hide();

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
                $("#" + modalId + " > .md-content").append(temp);

//                ModalEffect.init();

                setTimeout(
                        function ()
                        {
                            $("#" + modalId).show();
                            $("#" + modalId).addClass("md-show");

                            $("#" + modalId + " .md-content").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                                $("#" + modalId + " #__modal_close_btn").show("slow");

                                callJqueryWindowEvent(VModalMessage.READY, {modalId: modalId});

                                if (typeof func.onDialogShow === "function") {
                                    func.onDialogShow({modalId: modalId});
                                }
                            });
                        }, 10);
            },
            error: function (err) {
                alert("VMODAL " + err);
            }
        });
    }
};

function agregarArchivosNesesarios() {

//    appendScript("js/modalEffects.js");
    appendScript("js/modernizr.custom.js");
    appendScript("js/classie.js");
    appendCSS("css/component.css");
}