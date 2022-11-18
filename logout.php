<?php

session_start();

if (!$_SESSION['auth']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if(array_key_exists('oui', $_POST)){
        session_destroy();
        header('Location: login.php');
    }elseif(array_key_exists('non', $_POST )){
        header('Location: '.$_SESSION['last_page']);
        session_unset('last_page');
    }
    exit();

}
$_SESSION['last_page'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';

require_once 'logout_view.php';