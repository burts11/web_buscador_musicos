<?php

if (!$_POST['page']) {
    die("0");
}

$page = $_POST['page'];

if (file_exists('../html/' . $page . '.php')) {
    echo file_get_contents('../html/' . $page . '.php');
} else {
    echo 'La página no existe!';
}

//echo '../html/' . $page . '.php';
