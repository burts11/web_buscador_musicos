<?php

if (isset($_POST["action"]) && !empty($_POST["action"])) {
    $action = $_POST["action"];
    onAction($action);
} else {
    $result = Array(
        "resultado" => "Error",
        "mensaje" => "FileManager: Action está vacía"
    );

    echo jsonEncode($result);
}

function onAction($action) {

    switch ($action) {

        case "CrearCarpeta":

            $ruta = $_POST["ruta"];

            if (crearCarpeta($ruta)) {

                $result = Array("resultado" => "Success",
                    "mensaje" => "Carpeta/s creada/s correctamente!", "ruta" => $ruta);
            } else {
                $result = Array("resultado" => "Error", "mensaje" => "Error al crear la/s carpeta/s. Alguna carpeta ya existe?", "ruta" => $ruta);
            }

            echo jsonEncode($result);
            break;
        case "CopiarArchivo":

            break;
    }
}

function crearCarpeta($ruta) {
//    $ruta = "../uploads/RS/2014/BOI/002";   // full path 

    try {

        $tags = explode('/', "../" . $ruta);            // explode the full path
        $mkDir = "";

        $result = false;
        foreach ($tags as $folder) {
            $mkDir = $mkDir . $folder . "/";   // make one directory join one other for the nest directory to make
//
//            echo '"' . $mkDir . '"<br/>';         // this will show the directory created each time
            if (!is_dir($mkDir)) {             // check if directory exist or not
                if (mkdir($mkDir, 0777)) {
//                    echo "Success -> $mkDir";
                    $result = true;
                } else {
                    $result = false;
//                    echo "Error -> $mkDir";
                }
            }
        }

        return $result;
    } catch (Exception $exc) {
//        echo $exc->getTraceAsString();
        return false;
    }
}

function jsonEncode($array) {

    return json_encode(json_encode($array));
}
