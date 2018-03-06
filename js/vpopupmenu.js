var VPopupMenu = {
    vInit() {
        $(".vPopupTrigger").click(function () {
            $(this).popup();
        });
    }
};

onJqueryReady(function () {
    VPopupMenu.vInit();
});