<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        // put your code here

        require_once '../bbdd/mybbddv2.php';

//        $result = rawQuery("select * from usuario");

        $result = rawQueryOneField("select [idusuario] from usuario where usuario = 'muse'");

        echo "<pre>";

//        print_r($result);

        echo "Result: " . querySucceeded() . "\n";

        $result = rawQueryOneField("select [idusuario] from usuario where usuario = 'musedfdsfd'");

        echo "Result: " . querySucceeded() . "\n";

        if (!querySucceeded()){
            
            echo " fallo";
        }
        
        echo "</pre>";
        ?>
    </body>
    <script src="test.js" type="text/javascript"></script>
</html>
