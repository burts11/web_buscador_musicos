
test();

function test(){
    
    callAjaxBBDDV2({action: "RawQueryRet", query: "SELECT * FROM usuario"}, function (result) {
        
        console.log(result);
    });
}


function callAjaxBBDDV2(dataJSON, func) {

    $.ajax({
        type: "post",
        url: "../bbdd/mybbddv2.php",
        dataType: "json",
        data: dataJSON,
        cache: false,
        success: function (rawJson) {

//            var json = $.parseJSON(rawJson);
            func(rawJson);
        },
        error: function (err) {

            var dataJSON = {
                resultado: "ERROR",
                errorResponse: err
            };
            func(dataJSON);
        }
    }
    );
}