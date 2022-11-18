<?php

//htmlspecialcars pour inserer


session_start();
if(!$_SESSION['auth']){
    header('Location: login.php');
    exit();
}

define('PER_PAGE', 20);

$pdo = new PDO(
    "mysql:host=localhost;dbname=to_do_list_db",  // data source name
    "root", // username
    "", // password
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ] // options 
);

if(
    isset($_POST['task_name']) && isset($_POST['task_date'])
    && !empty($_POST['task_name']) && !empty($_POST['task_date'])
    )
    {// pas de variable avec query
        $stmt3 = $pdo->query("INSERT INTO `task` (`task_name`, `to_do_at`, `is_done`, `id_user`) VALUES ('".$_POST['task_name']."' , '".$_POST['task_date']."', '0', '1')");

        
    var_dump($_POST);

    header('Location: index.php');
    }


try{
    $sql_query = 'SELECT COUNT(*) AS total FROM task';
    $stmt = $pdo->query($sql_query);

    $nbre_articles = $stmt->fetch();
}catch(PDOException $e){
    echo "Nous avons eu un problème de récupération de données";
}

$nbre_pages = ceil($nbre_articles->total / PER_PAGE);

// limite d'affichage et numéro de la page
if(
    array_key_exists('page', $_GET)
    && (int)$_GET['page'] > 0
    && (int)$_GET['page'] <= $nbre_pages
    )
{
    $current_page = $_GET['page'];
}else{
    $current_page = 1;
}

$offset  = ($current_page - 1 ) *  PER_PAGE;

// trier les éléments par prix 
$order_request = null;

if(isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc']))
{
    $order_request = 'ORDER BY to_do_at '.$_GET['order'];
}



try{

        
    $sql_query = '
    SELECT *  
    FROM task 
    '.$order_request.'
    LIMIT '.PER_PAGE.'
    OFFSET '. $offset;
    $stmt = $pdo->query($sql_query);

    $articles = $stmt->fetchAll();
}catch(PDOException $e){
    
    echo "Nous avons eu un problème de récupération de données";
}


$pdo = null;
//unset($pdo)


require_once 'index_view.php';