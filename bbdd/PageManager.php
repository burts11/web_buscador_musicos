<?php

if (!$_POST['page']) {
    die("0");
}

$page = $_POST['page'];

//echo '../html/' . $page . '.php';

if (file_exists('../html/' . $page . '.php')) {
    echo file_get_contents('../html/' . $page . '.php');
} else {
    echo 'There is no such page!';
}


