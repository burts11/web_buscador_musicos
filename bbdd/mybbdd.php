<?php

require_once './bbdd.php';
require_once './MysqliDb.php';

if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) {
        $action = $_POST["action"];
        onAction($action);
    }
}

function onAction($action) {

    bbdd_inicializar();
    $dataBase = MysqliDb::getInstance();

    switch ($action) {

        case "DirectSelect":

            $select = $_POST["select"];
            $array = $dataBase->rawQuery($select);
            echo encode($array);
            break;
        case "DirectSelectOne":
            $array = $dataBase->rawQuery("SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;");

            break;
        case "ObtenerMusicos":
            $array = $dataBase->rawQuery("SELECT * FROM usuario INNER JOIN musico ON usuario.idusuario = musico.idmusico;");
            echo encode($array);
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

            echo encode($result);
            break;
        case "MostrarSesion":
            session_start();
            echo encode($_SESSION);
            break;
        case "UsuarioLogueado":
            session_start();

            if (isset($_SESSION[Session::Logueado])) {
                if ($_SESSION[Session::Logueado] === "true") {
                    $result = Array(
                        "resultado" => "Success",
                        "mensaje" => "Usuario logueado!",
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

            echo encode($result);
            break;
        case "IniciarSesion":
            session_start();

            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $dataBase->where("usuario", $user);
            $dataBase->where("pass", $pass);
            if ($dataBase->has("usuario")) {

                $pri = $dataBase->rawQueryOne("SELECT tipo, CASE WHEN tipo = 0 THEN 'Administrador'
                WHEN tipo = 1 THEN 'Musico'
                WHEN tipo = 2 THEN 'Local'
                WHEN tipo = 3 THEN 'Fan' END as Privilegio FROM usuario where usuario = ? AND pass = ?", Array($user, $pass));

                $_SESSION[Session::UserName] = $user;
                $_SESSION[Session::UserPassword] = $pass;
                $_SESSION[Session::Logueado] = "true";
                $_SESSION[Session::Privilegio] = $pri["Privilegio"];

                $result = Array(
                    "resultado" => "Success",
                    "mensaje" => "You are logged",
                    "user" => $user,
                    "pass" => $pass,
                    "privilegio" => $pri["Privilegio"]
                );
            } else {
                $result = Array("resultado" => "Error", "mensaje" => "Wrong user/password");
            }

            echo encode($result);
            break;
    }
}

function encode($array) {

    return json_encode(json_encode($array));
}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

interface Session {

    const UserName = "session_user_name";
    const UserPassword = "session_user_pass";
    const Logueado = "session_user_logged";
    const Privilegio = "session_user_privilege";

}

interface Privilegio {

    const Administrador = "0";
    const Musico = "1";
    const Local = "2";
    const Fan = "3";

}
