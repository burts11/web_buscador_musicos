<?php

require_once 'MysqliDb.php';
require_once 'util.php';

function bbdd_inicializar() {
    $db = new MysqliDb('localhost', 'root', '', 'dam1tgrupo4_proyecto');
    return $db;
}

if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) {
        $action = $_POST["action"];
        onAction($action);
    } else {
        $result = Array(
            "resultado" => "Error",
            "mensaje" => "Action está vacía"
        );

        echo jsonEncode($result);
    }
}

function onAction($action) {

    bbdd_inicializar();
    $dataBase = MysqliDb::getInstance();

    switch ($action) {

        case "RegistrarFan":
            $nombre = $_POST["input_fan_nombre"];
            $apellidos = $_POST["input_fan_apellidos"];
            $email = $_POST["input_fan_email"];
            $usuario = $_POST["input_fan_usuario"];
            $pass = $_POST["input_fan_pass"];
            $ciudad = $_POST["input_fan_ciudad"];
            $telefono = $_POST["input_fan_telefono"];
            $direccion = $_POST["input_fan_direccion"];
            $tipo = 3;

            $passCifrada = password_hash($pass, PASSWORD_DEFAULT);

            $dataBase->rawQuery("INSERT INTO usuario values (default,'$nombre','$email','$usuario','$passCifrada',$tipo,'$ciudad')");

            if ($dataBase->querySucceeded()) {
                $id = $dataBase->rawQueryValue("select idusuario from usuario where usuario = '$usuario' limit 1");
                if ($dataBase->querySucceeded()) {
                    $dataBase->rawQuery("INSERT INTO fan values ('$id','$apellidos','$telefono','$direccion','')");
                    if ($dataBase->querySucceeded()) {
                        $result = Array(
                            "resultado" => "Success",
                            "mensaje" => "Se ha registrado al fan '$usuario' correctamente!"
                        );
                    } else {
                        $result = Array(
                            "resultado" => "error",
                            "mensaje" => $dataBase->getLastError()
                        );
                    }
                }
            } else {
                $result = Array(
                    "resultado" => "error",
                    "mensaje" => $dataBase->getLastError()
                );
            }
            echo jsonEncode($result);
            break;
        case "RegistrarLocal":
            $nombre = $_POST["input_local_nombre"];
            $email = $_POST["input_local_email"];
            $usuario = $_POST["input_local_usuario"];
            $pass = $_POST["input_local_pass"];
            $ubicacion = $_POST["input_local_ubicacion"];
            $aforo = $_POST["input_local_aforo"];
            $tipo = 2;
            $ciudad = $_POST["input_local_ciudad"];

            $passCifrada = password_hash($pass, PASSWORD_DEFAULT);

            $dataBase->rawQuery("INSERT INTO usuario values (default,'$nombre','$email','$usuario','$passCifrada','$tipo','$ciudad')");
            if ($dataBase->querySucceeded()) {
                $id = $dataBase->rawQueryValue("select idusuario from usuario where usuario = '$usuario' limit 1");
                if ($dataBase->querySucceeded()) {
                    $dataBase->rawQuery("INSERT INTO local values ('$id','$ubicacion','$aforo','')");
                    if ($dataBase->querySucceeded()) {
                        $result = Array(
                            "resultado" => "Success",
                            "mensaje" => "Se ha registrado al local '$usuario' correctamente!"
                        );
                    } else {
                        $result = Array(
                            "resultado" => "error",
                            "mensaje" => $dataBase->getLastError()
                        );
                    }
                }
            } else {
                $result = Array(
                    "resultado" => "error",
                    "mensaje" => $dataBase->getLastError()
                );
            }
            echo jsonEncode($result);
            break;
        case "RegistrarMusico":
            $nombre = $_POST["input_musico_nombre"];
            $apellidos = $_POST["input_musico_apellidos"];
            $telefono = $_POST["input_musico_telefono"];
            $web = $_POST["input_musico_web"];
            $nombreartistico = $_POST["input_musico_artistico"];
            $componentes = $_POST["input_musico_componentes"];
            $email = $_POST["input_musico_email"];
            $usuario = $_POST["input_musico_usuario"];
            $pass = $_POST["input_musico_pass"];
            $generoid = $_POST["input_musico_genero"];
            $tipo = 1;
            $ciudad = $_POST["input_musico_ciudad"];

            $passCifrada = password_hash($pass, PASSWORD_DEFAULT);

            $dataBase->rawQuery("INSERT INTO usuario values (default,'$nombre','$email','$usuario','$passCifrada','$tipo','$ciudad')");
            if ($dataBase->querySucceeded()) {
                $id = $dataBase->rawQueryValue("select idusuario from usuario where usuario = '$usuario' limit 1");
                if ($dataBase->querySucceeded()) {
                    $dataBase->rawQuery("INSERT INTO musico values ('$id','$apellidos','$telefono','$web','$nombreartistico','$componentes','$generoid')");
                    if ($dataBase->querySucceeded()) {
                        $result = Array(
                            "resultado" => "Success",
                            "mensaje" => "Se ha registrado al músico '$usuario' correctamente!"
                        );
                    } else {
                        $result = Array(
                            "resultado" => "error",
                            "mensaje" => $dataBase->getLastError()
                        );
                    }
                }
            } else {
                $result = Array(
                    "resultado" => "error",
                    "mensaje" => $dataBase->getLastError()
                );
            }
            echo jsonEncode($result);
            break;
        case "Test":

            $serialized = $_POST["serialized"];
            print_array($serialized);
            break;
        case "RawQueryRet":
            $query = $_POST["query"];

            try {
                $result = $dataBase->rawQuery($query);

//                echo "<p><- Filas afectadas -></p>";
//                echo "<p><Count -> " . $dataBase->count . "</p>";
//                echo "<p><- Filas afectadas -/></p>";
//
//                echo "<p><- Resultado -></p>";
//                print_array($result);
//                echo "<p><- Resultado -/></p>";

                if ($dataBase->querySucceeded()) {

                    $result = Array(
                        "resultado" => "Success",
                        "data" => $result,
                        "action" => "RawQueryRet",
                        "lastQuery" => $dataBase->getLastQuery(),
                        "mensaje" => "El query ha sido ejecutado con éxito!",
                        "queryStr" => $query,
                        "queryInfo" => $dataBase->mysqli()->info
                    );

                    echo jsonEncode($result);
                } else {
                    $result = Array(
                        "resultado" => "Error",
                        "action" => "RawQueryRet",
                        "lastQuery" => $dataBase->getLastQuery(),
                        "mensaje" => $dataBase->getLastError(),
                        "queryStr" => $query,
                        "queryInfo" => $dataBase->mysqli()->info
                    );
                    echo jsonEncode($result);
                }
            } catch (Exception $e) {

                $result = Array(
                    "resultado" => "Error",
                    "action" => "RawQueryRet",
                    "lastQuery" => $dataBase->getLastQuery(),
                    "mensaje" => $dataBase->getLastError(),
                    "queryStr" => $query,
                    "queryInfo" => $dataBase->mysqli()->info
                );
                echo jsonEncode($result);
            }

            break;
        case "Insert":
            $tabla = $_POST["tabla"];
            $data = $_POST["data"];

            try {
                $result = $dataBase->insert($tabla, $data);

                if ($result) {

                    $result = Array(
                        "resultado" => "Success",
                        "action" => "Insert",
                        "mensaje" => "Insert en la tabla -> " . $tabla,
                        "insertData" => $data,
                        "lastQuery" => $dataBase->getLastQuery()
                    );

                    echo jsonEncode($result);
                } else {
                    $result = Array(
                        "resultado" => "error",
                        "action" => "Insert",
                        "mensaje" => $dataBase->getLastError(),
                        "insertData" => $data
                    );
                }
            } catch (Exception $e) {

                $result = Array(
                    "resultado" => "error",
                    "action" => "Insert",
                    "mensaje" => $dataBase->getLastError()
                );

                echo jsonEncode($result);
            }
            break;
        case "RawQuery":
            $query = $_POST["query"];

            try {
                $array = $dataBase->rawQuery($query);
                echo jsonEncode($array);
            } catch (Exception $e) {

                $result = Array(
                    "resultado" => "error",
                    "action" => "RawQuery",
                    "lastQuery" => $dataBase->getLastQuery(),
                    "mensaje" => $dataBase->getLastError()
                );

                echo jsonEncode($result);
            }
            break;
        case "RawQueryOne":
            $query = $_POST["query"];

            try {
                $array = $dataBase->rawQueryOne($query);
                echo jsonEncode($array);
            } catch (Exception $e) {

                $result = Array(
                    "resultado" => "error",
                    "action" => "RawQueryOne",
                    "mensaje" => $dataBase->getLastError()
                );

                echo jsonEncode($result);
            }

            break;
        case "CerrarSesion":
            session_start();

            if (session_status() == PHP_SESSION_ACTIVE) {

                session_destroy();
                $result = Array(
                    "resultado" => "Success",
                    "mensaje" => "La sesión ha sido terminada!"
                );
            } else {
                $result = Array(
                    "resultado" => "Error",
                    "mensaje" => "La sesión no existe!"
                );
            }

            echo jsonEncode($result);
            break;
        case "RegistrarMusico":
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $usuario = $_POST["usuario"];
            $pass = $_POST["pass"];
            $tipo = $_POST["tipo"];
            $genero = $_POST["genero"];
            $apellidos = $_POST["apellidos"];
            $telefono = $_POST["telefono"];
            $web = $_POST["web"];
            $nombreartistico = $_POST["nombreartistico"];
            $numerocomponentes = $_POST["numerocomponentes"];
            $ciudad = $_POST["ciudad"];

            $resultado = $dataBase->rawQuery("INSERT INTO usuario VALUES (default, '$nombre','$email','$usuario','$pass','$tipo', '$ciudad')");

            if ($dataBase->querySucceeded()) {

                $idGenero = $dataBase->rawQueryValue("select idgenero from genero where nombre = '$genero' limit 1");
                $idUsuario = $dataBase->rawQueryValue("Select idusuario from usuario where usuario = '$usuario' limit 1");
                $resultInsertMusico = $dataBase->rawQuery("INSERT INTO musico VALUES ('$idUsuario','$genero','$apellidos','$telefono','$web','$nombreartistico','$numerocomponentes', '$idGenero')");

                if ($dataBase->querySucceeded()) {

                    $result = Array(
                        "resultado" => "Success",
                        "mensaje" => "Usuario y músico creado!",
                    );
                }
            } else {

                $result = Array(
                    "resultado" => "Error",
                    "mensaje" => $dataBase->getLastError()
                );
            }

            echo jsonEncode($result);
            break;
        case "MostrarSesion":
            session_start();
            echo jsonEncode($_SESSION);
            break;
        case "UsuarioLogueado":
            session_start();

            if (isset($_SESSION[Session::Logueado])) {
                if ($_SESSION[Session::Logueado] === "true") {
                    $result = Array(
                        "resultado" => "Success",
                        "mensaje" => "Hay un usuario que está logueado actualmente!",
                        "id" => $_SESSION[Session::UserId],
                        "nombre" => $_SESSION[Session::UserRealName],
                        "user" => $_SESSION[Session::UserName],
                        "pass" => $_SESSION[Session::UserPassword],
                        "privilegio" => $_SESSION[Session::Privilegio],
                        "logueado" => $_SESSION[Session::Logueado]
                    );
                } else {
                    $result = Array(
                        "resultado" => "Error",
                        "mensaje" => "No hay un usuario logueado!"
                    );
                }
            } else {
                $result = Array(
                    "resultado" => "Error",
                    "mensaje" => "No hay un usuario logueado!"
                );
            }

            echo jsonEncode($result);
            break;
        case "IniciarSesion":
            session_start();

            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $dataBase->where("usuario", $user);
            if ($dataBase->has("usuario")) {

                $passCifrada = $dataBase->rawQueryValue("select pass from usuario where usuario = '$user' limit 1");

                if (password_verify($pass, $passCifrada)) {

                    $userMatriz = $dataBase->rawQueryOne("SELECT CASE WHEN tipo = 0 THEN 'Administrador'
                WHEN tipo = 1 THEN 'Musico'
                WHEN tipo = 2 THEN 'Local'
                WHEN tipo = 3 THEN 'Fan' END as Privilegio, idusuario, nombre FROM usuario where usuario = ? AND pass = ?", Array($user, $passCifrada));

                    $privilegio = $userMatriz["Privilegio"];

                    $_SESSION[Session::UserName] = $user;
                    $_SESSION[Session::UserPassword] = $pass;
                    $_SESSION[Session::Logueado] = "true";
                    $_SESSION[Session::Privilegio] = $privilegio;
                    $_SESSION[Session::UserId] = $userMatriz["idusuario"];
                    $_SESSION[Session::UserRealName] = $userMatriz["nombre"];

                    $result = Array(
                        "resultado" => "Success",
                        "mensaje" => "Usuario Logueado!",
                        "id" => $userMatriz["idusuario"],
                        "nombre" => $userMatriz["nombre"],
                        "user" => $user,
                        "pass" => $pass,
                        "privilegio" => $privilegio,
                    );
                } else {
                    $result = Array("resultado" => "Error", "mensaje" => "Wrong user/password");
                }
            } else {
                $result = Array("resultado" => "Error", "mensaje" => "Wrong user/password");
            }

            echo jsonEncode($result);
            break;
    }
}

function jsonEncode($array) {

    return json_encode(json_encode($array));
}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

interface Session {

    const UserRealName = "session_user_real_name";
    const UserName = "session_user_name";
    const UserPassword = "session_user_pass";
    const UserId = "session_user_id";
    const Logueado = "session_user_logged";
    const Privilegio = "session_user_privilege";

}

interface Privilegio {

    const Administrador = "0";
    const Musico = "1";
    const Local = "2";
    const Fan = "3";

}
