<?php

require_once './MysqliDb.php';

function bbdd_inicializar() {
    $db = new MysqliDb('localhost', 'root', '', 'proyecto');
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

        case "RawQuery":
            $select = $_POST["query"];

            try {
                $array = $dataBase->rawQuery($select);

                echo jsonEncode($array);
            } catch (Exception $e) {

                $result = Array(
                    "resultado" => "error",
                    "Action" => "RawQuery",
                    "mensaje" => $dataBase->getLastError()
                );

                echo jsonEncode($result);
            }
            break;
        case "RawQueryOne":
            $select = $_POST["query"];

            try {
                $array = $dataBase->rawQueryOne($select);
                echo jsonEncode($array);
            } catch (Exception $e) {

                $result = Array(
                    "resultado" => "error",
                    "Action" => "RawQueryOne",
                    "mensaje" => $dataBase->getLastError()
                );

                echo jsonEncode($result);
            }

            break;
        case "ObtenerMusicos":
            $array = $dataBase->rawQuery("SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;");
            echo jsonEncode($array);
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
            $tipo = 1;
            $genero = $_POST["genero"];
            $apellidos = $_POST["apellidos"];
            $telefono = $_POST["telefono"];
            $web = $_POST["web"];
            $nombreartistico = $_POST["nombreartistico"];
            $numerocomponentes = $_POST["numerocomponentes"];

            $resultado = $dataBase->rawQuery("INSERT INTO usuario VALUES (default,'$nombre','$email','$usuario','$pass','$tipo')");
            if ($resultado) {
                $generoID = $dataBase->rawQueryOne("select idgenero from genero where nombre = $genero");
                $idusuario = $dataBase->rawQueryOne("SELECT idusuario from usuario where usuario = '$usuario'");
                $dataBase->rawQuery("INSERT INTO musico VALUES ('$idusuario','$generoID','$apellidos','$telefono','$web','$nombreartistico','$numerocomponentes')");

                $result = Array(
                    "resultado" => "Success",
                    "mensaje" => "Se ha registrado correctamente",
                );

                jsonEncode($result);

                return;
            }
            $result = Array(
                "resultado" => "Error",
                "mensaje" => "No se ha registrado",
            );

            jsonEncode($result);
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

//            $passCifrada = password_hash($pass, PASSWORD_DEFAULT);

            $dataBase->where("usuario", $user);
            $dataBase->where("pass", $pass);
            if ($dataBase->has("usuario")) {

                $userMatriz = $dataBase->rawQueryOne("SELECT CASE WHEN tipo = 0 THEN 'Administrador'
                WHEN tipo = 1 THEN 'Musico'
                WHEN tipo = 2 THEN 'Local'
                WHEN tipo = 3 THEN 'Fan' END as Privilegio, idusuario, nombre FROM usuario where usuario = ? AND pass = ?", Array($user, $pass));

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
