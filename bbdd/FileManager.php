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

function getUserDataPath() {
    $dir = '../userdata/';
    return $dir;
}

function onAction($action) {

    switch ($action) {

        case "SubirArchivo":
            $output_dir = "../test/";
            if (isset($_FILES["myfile"])) {
                $ret = array();

                $error = $_FILES["myfile"]["error"];

                if (!is_array($_FILES["myfile"]["name"])) { //single file
                    $fileName = $_FILES["myfile"]["name"];
                    move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
                    $ret[] = $fileName;
                } else {  //Multiple files, file[]
                    $fileCount = count($_FILES["myfile"]["name"]);
                    for ($i = 0; $i < $fileCount; $i++) {
                        $fileName = $_FILES["myfile"]["name"][$i];
                        move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
                        $ret[] = $fileName;
                    }
                }
                echo json_encode($ret);
            }

            echo "Test subir";
            break;
        case "ListarArchivos":

            $pathToList = $_POST["path"];
            $realPath = getUserDataPath() . $pathToList;

            try {
                $listado = array();

                foreach (new DirectoryIterator($realPath) as $file) {
                    if ($file->isFile()) {

                        array_push($listado, $file->getFilename());
                    }
                }

                if (!empty($listado)) {

                    $resultado = array("resultado" => "Success",
                        "mensaje" => "Archivos listados correctamente!", "data" => $listado, "path" => $realPath);
                } else {
                    $resultado = array("resultado" => "Error",
                        "mensaje" => "0 archivos listados", "data" => $listado, "path" => $realPath);
                }
            } catch (Exception $exc) {
                $resultado = array("resultado" => "Error",
                    "mensaje" => "El directorio no existe?", "data" => $listado, "path" => $realPath);
            }

            echo jsonEncode($resultado);
            break;
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
        case "CopiarImagen":
            print_r($_POST);
            print_r($_FILES);

            $temp = $_FILES['imagen_data']["tmp_name"];
            $name = $_FILES['imagen_data']['name'];

            $nombreUsuario = $_POST["nombreUsuario"];

            $path = '../userdata/' . $nombreUsuario . "/img";

            if (!mkdir($path, 0777, true)) {
                die('Fallo al crear las carpetas...');
            }

            if (move_uploaded_file($temp, $path . "/user_logo.png")) {

                echo json_encode(Array("Resultado" => "Success"));
            }
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

    return json_encode($array);
}
