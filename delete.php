<?php

session_start();
if(!$_SESSION['auth']){
    header('Location: login.php');
    exit();
}

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=to_do_list_db",
        "root",
        "",
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $th) {
    echo "Nous avons rencontré un problème lors de la récuparation des données";
}

$id_to_delete = $_GET['id'];

try {
    $stmt1 = $pdo->prepare("SELECT COUNT(*) AS total FROM task WHERE id =:id");
    $stmt1->execute([
        'id' => $id_to_delete
    ]);
    $result = $stmt1->fetch(PDO::FETCH_OBJ);
    if ($result->total == 0) {
        session_start();
        $_SESSION['error'] = "Cet article n'existe pas";

        exit;
    } else {
        $stmt2 = $pdo->prepare('DELETE FROM task WHERE id= :id');
        $stmt2->bindParam(':id', $id_to_delete);
        $result = $stmt2->execute([
            'id' => $id_to_delete
        ]);
    }
} catch (PDOException $e) {

    echo "Nous avons rencontré un problème lors de la récuparation des données";
};
unset($pdo);

header('Location: index.php');
exit;