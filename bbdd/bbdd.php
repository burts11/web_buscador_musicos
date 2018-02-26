<?php

function bbdd_inicializar() {
    $db = new MysqliDb('localhost', 'root', '', 'proyecto');
    return $db;
}

function desconectar($conexion) {
    mysqli_close($conexion);
}

function conectar() {

    $conexion = mysqli_connect("localhost", "root", "", "proyecto");

    if (!$conexion) {
        die("No se ha podido establecer conexion con el servidor");
    }
    return $conexion;
}

function insertar_datoslocal($usuarioid, $ubicacion, $aforo, $imagen) {

    $c = conectar();

    $insert = "insert into local values ('$usuarioid','$ubicacion',$aforo,'$imagen')";

    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }

    desconectar($c);

    return $resultado;
}

function insertar_localusuario($nombre, $email, $usuario, $password) {

    $c = conectar();

    $insert = "insert into usuario values ('','$nombre','$email','$usuario','$password')";

    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }

    desconectar($c);

    return $resultado;
}
