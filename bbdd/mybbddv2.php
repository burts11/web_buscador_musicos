<?php

$lastQueryCount = 0;
$lastQueryInfo = "";
$lastQueryError = "";
$lastQuery = "";

function onAction2($action) {

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
                    "data" => $resultRet,
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
    $GLOBALS['lastQuery'] = $query;

    if (mysqli_affected_rows($c) >= 1) {

        $GLOBALS['lastQueryCount'] = 1;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);

        if (!is_bool($result)) {
            $resultRet = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $resultRet = array();
        }
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
    $GLOBALS['lastQuery'] = $query;

    if (mysqli_affected_rows($c) >= 1) {

        $resultRet = mysqli_fetch_assoc($result);
        $GLOBALS['lastQueryCount'] = 1;
        $GLOBALS['lastQueryInfo'] = mysqli_info($c);
    } else {
        $resultRet = null;
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
    $GLOBALS['lastQuery'] = $finalQuery;

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

function getLastQuery() {

    return $GLOBALS['lastQuery'];
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

//function jsonEncode($array) {
//
//    return json_encode($array);
//}
//
//function is_ajax() {
//    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
//}

function bbdd_conectar() {
    $conexion = mysqli_connect("localhost", "root", "", "dam1tgrupo4_proyecto");

//    $conexion = mysqli_connect("localhost", "grupo4", "grupo4", "dam1tgrupo4_proyecto");
    $GLOBALS['lastQueryCount'] = 0;
    mysqli_set_charset($conexion, "utf8");

    if (!$conexion) {
        die("No se ha podido establecer la conexión con el servidor");
    }
    return $conexion;
}

function bbdd_desconectar($conexion) {
    mysqli_close($conexion);
}
