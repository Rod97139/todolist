<?php

session_start();
if(!$_SESSION['auth']){
    header('Location: login.php');
    exit();
}

$id_to_edit = $_GET['id'];


 $pdo = new PDO(
        'mysql:host=localhost;dbname=to_do_list_db',
        'root',
        '',
        [
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );


    
$stmt = $pdo->prepare("SELECT * FROM task WHERE id = :id");
$stmt->execute([
    'id' => $id_to_edit
]);

$task = $stmt->fetch(PDO::FETCH_OBJ);



    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
            /*********Vérification*********** */

        if ($task->is_done == 1) {
            try {
                $stmt = $pdo->prepare("UPDATE task SET `is_done` = :new_title WHERE id = :id");
                $stmt->execute([
                    'new_title' => 0,
                    
                    'id' => $id_to_edit
                ]);
            } catch (PDOException $th) {
                var_dump($th);
            }
        } else {
            try {
                $stmt = $pdo->prepare("UPDATE task SET `is_done` = :new_title WHERE id = :id");
                $stmt->execute([
                    'new_title' => 1,
                    
                    'id' => $id_to_edit
                ]);
            } catch (PDOException $th) {
                var_dump($th);
            }
        }
    

        unset($pdo);

        header('Location: index.php');
    }





