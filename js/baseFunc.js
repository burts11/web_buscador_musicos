$.fn.popup = function () {
    this.each(function () {
        if ($(this).hasClass("vPopupTrigger")) {

            var self = this;

            var targetId = $(self).attr("data-popup-container");
            var $targetId = "#" + targetId;

            document.onkeydown = function (evt) {
                evt = evt || window.event;
                if (evt.keyCode === 27) {

                    hide($targetId);
                }
            };

//            console.log("VPopup Target Id -> " + $targetId);

            $(self).unbind("clickoutside").bind('clickoutside', function (event) {

                $($targetId).fadeOut();
                $($targetId).unbind('clickoutside');
            });

            $($targetId + " .vPopupMenuItem").unbind("click").bind('click', function () {
                var id = $(this).prop("id");
                callJqueryWindowEvent(VMessage.PAGINA_POPUP_MENU_ITEM_CLICKED, {id: id});
                $($targetId).fadeOut();
            });

            var top = $(this).offset().top;
            top += $(this).height();
            var left = $(this).offset().left;
            left += 0;
            $("#" + targetId).css({
                top: top,
                left: left
            });

            $("#" + targetId).hide().fadeIn();
        }

        return $(this); // support chaining
    });
};

function hide(target) {
    $(target).fadeOut();
}
