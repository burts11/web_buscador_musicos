<?php

function util_delayMensaje($mensaje, $paginaURL) {

    util_mostrarMensaje($mensaje);
    header("Refresh:2; URL=$paginaURL");
}

function util_mostrarMensaje($texto) {
    echo "<script type='text/javascript'>texto('$texto');</script>";
}

function util_mostrar_texto($texto) {
    echo "<script type='text/javascript'>texto('$texto');</script>";
}

function util_mostrar_info($texto) {
    echo "<script type='text/javascript'>success('$texto');</script>";
}

function util_mostrar_error($error) {
    echo "<script type='text/javascript'>error('$error');</script>";
}

function print_array($array) {

    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
