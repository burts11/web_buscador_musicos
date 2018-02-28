onJqueryReady(function () {

    console.log("Registro!");

    var kkk = $(".registroMenuBtn");

    $("._registroMenu .registroMenuBtn").click(function (e) {

        $(".registro-div-active").hide().removeClass("registro-div-active");

        var id = $(this).attr("data-regid");
        $('._registroMenu .registroMenuBtn').removeClass("registroMenuBtn_selected");
        $(this).addClass("registroMenuBtn_selected");

        $("#" + id).fadeIn();
        $("#" + id).addClass("registro-div-active");
        console.log(e);
    });
});
