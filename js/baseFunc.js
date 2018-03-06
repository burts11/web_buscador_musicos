$.fn.popup = function () {
    this.each(function () {
        if (true === $(this).hasClass("vPopupTrigger")) {

            var self = this;

            var targetId = $(self).attr("data-popup-container");
            var $targetId = "#" + targetId;

            $('html').off().focusin(function (e) {
                if (e.target.id !== $targetId) {

                    $($targetId).fadeOut();
                }
            });

            $($targetId + " .vPopupMenuItem").off().click(function () {

                $($targetId).fadeOut("fast");
                var id = $(this).prop("id");
                callJqueryWindowEvent(VMessage.PAGINA_POPUP_MENU_ITEM_CLICKED, {id: id});
            });

            console.log("VPopup Target Id -> " + targetId);

            var top = $(this).offset().top;
            top += $(this).height();
            var left = $(this).offset().left;
            left += 0;
            $("#" + targetId).css({
                top: top,
                left: left
            });

            $("#" + targetId).fadeIn();
        }

        return $(this); // support chaining
    });
};
