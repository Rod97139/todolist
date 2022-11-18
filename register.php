<?php

$pdo = new PDO(
    "mysql:host=localhost;dbname=to_do_list_db",  // data source name
    "root", // username
    "", // password
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ] // options 
);
///PUT au lieu de POST
if(
    isset($_POST['email']) && isset($_POST['password'])
    && !empty($_POST['email']) && !empty($_POST['password'])
    )
    {

        $password =  password_hash($_POST['password'], PASSWORD_ARGON2I);
        $stmt = $pdo->query("INSERT INTO `user` (`email`, `password`) VALUES ('".$_POST['email']."' , '".$password."')");

        
    var_dump($_POST);

    header('Location: index.php');
    }

    require_once 'register_view.php';