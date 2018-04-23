<?php

$lastQueryCount = 0;
$lastQueryInfo = "";
$lastQueryError = "";

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

    switch ($action) {

        case "RawQueryRet":
            $query = $_POST["query"];
            $resultRet = rawQuery($query);

            if (querySucceeded()) {

                $result = Array(
                    "resultado" => "Success",
                    "data" => $resultRet,
                    "action" => "RawQueryRet",
                    "lastQuery" => $query,
                    "mensaje" => "El query ha sido ejecutado con éxito!",
                    "queryStr" => $query,
                    "queryInfo" => getQueryInfo()
                );
            } else {
                $result = Array(
                    "resultado" => "Error",
                    "action" => "RawQueryRet",
                    "lastQuery" => $query,
                    "mensaje" => getQueryLastError(),
                    "queryStr" => $query,
                    "queryInfo" => getQueryInfo()
                );
            }

            echo jsonEncode($result);
            break;
        case "RawQueryOneField":
            $query = $_POST["query"];
            $result = rawQueryOneField($query);
            echo jsonEncode($result);
            break;
    }
}

function rawQuery($query) {

    $c = bbdd_conectar();
    $result = mysqli_query($c, $query);

    if (mysqli_affected_rows($c) >= 1) {

        $resultRet = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $GLOBALS['lastQueryCount'] = 1;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);
    } else {
        $resultRet = array();
        $GLOBALS['lastQueryCount'] = 0;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);
        $GLOBALS['lastQueryError'] = mysqli_error($c);
    }

    bbdd_desconectar($c);

    return $resultRet;
}

function rawQueryOneRow($query) {
    $c = bbdd_conectar();
    $result = mysqli_query($c, $query);

    if (mysqli_affected_rows($c) >= 1) {

        $resultRet = mysqli_fetch_assoc($result);
        $GLOBALS['lastQueryCount'] = 1;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);
    } else {
        $resultRet = array();
        $GLOBALS['lastQueryCount'] = 0;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);
        $GLOBALS['lastQueryError'] = mysqli_error($c);
    }

    bbdd_desconectar($c);

    return $resultRet;
}

function rawQueryOneField($query) {
    $c = bbdd_conectar();

    $field = getStringBetween($query, '[', ']');
    $finalQuery = str_replace(Array("[", "]"), Array('', ''), $query);
    $result = mysqli_query($c, $finalQuery);

    if (mysqli_affected_rows($c) >= 1) {

        $resultRet = mysqli_fetch_assoc($result);
        $GLOBALS['lastQueryCount'] = 1;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);
        bbdd_desconectar($c);
        return $resultRet[$field];
    } else {
        $resultRet = array();
        $GLOBALS['lastQueryCount'] = 0;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);
        $GLOBALS['lastQueryError'] = mysqli_error($c);
        bbdd_desconectar($c);
        return $resultRet;
    }
}

function getStringBetween($str, $from, $to) {
    $sub = substr($str, strpos($str, $from) + strlen($from), strlen($str));
    return substr($sub, 0, strpos($sub, $to));
}

function getQueryLastError() {

    return $GLOBALS["lastQueryError"];
}

function getQueryInfo() {
    return $GLOBALS["lastQueryInfo"];
}

function querySucceeded() {
    return $GLOBALS['lastQueryCount'] >= 1;
}

function jsonEncode($array) {

    return json_encode($array);
}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function bbdd_conectar() {
    $conexion = mysqli_connect("localhost", "root", "", "proyecto");
    if (!$conexion) {
        die("No se ha podido establecer la conexión con el servidor");
    }
    return $conexion;
}

function bbdd_desconectar($conexion) {
    mysqli_close($conexion);
}
