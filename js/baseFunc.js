$.fn.popup = function () {
    this.each(function () {
        if (true === $(this).hasClass("vPopupTrigger")) {

            var self = this;

            var targetId = $(self).attr("data-popup-container");
            var $targetId = "#" + targetId;

//            var jsonSettings = $.parseJSON($(self).attr("data-settings"));

            $($targetId + " .vPopupMenuItem").off().click(function () {

                $($targetId).fadeOut("fast");
                var id = $(this).prop("id");
                callJqueryWindowEvent(VMessage.PAGINA_DROP_DOWN_ITEM_CLICKED, {id: id});
            });

            console.log("Target id " + targetId);
//            console.log("JSON " + jsonSettings["position"]);

            var top = $(this).offset().top;
            top += $(this).height() + ($(this).height() / 2);
            var left = $(this).offset().left;
            left += 0;

            console.log("Top : " + top);

            $("#" + targetId).css({
                top: top,
                left: left
            });

            $("#" + targetId).fadeIn();
        }

        return $(this); // support chaining
    });
};
