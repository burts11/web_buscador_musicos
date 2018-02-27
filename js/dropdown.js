var VDropDown = {

    init: function () {
        $(".dropDown_Trigger").click(function () {

            $(".dropDown_container").hide().fadeIn();

            var top = $(this).offset().top;
            top += $(this).height();
            top += 10;
            var left = $(this).offset().left;
            left -= 50;

            $(".dropDown_container").css({
                top: top,
                left: left
            });
        });

        $(".dropDown_Item").click(function () {

            $(".dropDown_container").fadeOut();
            var id = $(this).prop("id");
            callJqueryWindowEvent(VMessage.PAGINA_DROP_DOWN_ITEM_CLICKED, {id: id});
        });

        $(".dropDown_container").focusout(function () {
            $(this).fadeOut();
        });
    }
};


onJqueryReady(function () {

    VDropDown.init();
});