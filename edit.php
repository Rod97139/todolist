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



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
            /*********Vérification*********** */
    
        try {
            $stmt = $pdo->prepare("UPDATE task SET `task_name` = :new_title, `to_do_at`= :new_content WHERE id = :id");
            $stmt->execute([
                'new_title' => $_POST['task_name'],
                'new_content' => $_POST['task_date'],
                'id' => $id_to_edit
            ]);
        } catch (PDOException $th) {
            var_dump($th);
        }
            
        header('Location: index.php');
    }


$stmt = $pdo->prepare("SELECT * FROM task WHERE id = :id");
$stmt->execute([
    'id' => $id_to_edit
]);

$task = $stmt->fetch(PDO::FETCH_OBJ);

unset($pdo);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <a class='btn btn-warning' href="logout.php">Se déconnecter</a>
        <div class="row mt-5">
            <div class="col-12">
                <h1>Modifier une tâche</h1>
            </div>
        </div>
    
        <!-- Formulaire de recherche d'un article par son nom -->
    
        <div class="row mt-5">
            <div class="col-12">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="task_name">titre de l'article</label>
                        <input type="text" name="task_name" id="task_name" class="form-control" value="<?= $task->task_name ?>" >
                    </div>
                    <div class="form-group">
                        <label for="task_date">date de l'article</label>
                        <input type="text" name="task_date" id="task_date" class="form-control" value="<?= $task->to_do_at ?>" >
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier</button>

                </form>
            </div>
        </div>
        <!-- Tableau qui affiche la liste des articles -->
        

    
        </div>


<script src="index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>