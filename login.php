<?php


session_start();

if (isset($_SESSION['auth']) && $_SESSION['auth']) {      
    header('Location: index.php');
    exit();
}


if(isset($_POST)){
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = $_POST['email'];

        $pdo = new PDO(
            'mysql:host=localhost;dbname=to_do_list_db',
            'root',
            '',
            [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        
        // try catch
        
        try {
            $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([
        'email' => $email
        ]);
        
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $th) {
            echo 'Veuiller entrer un identifiant valide';
        }
        

        if (($email == $user->email) && (password_verify($_POST['password'], $user->password))) {
            
            $_SESSION['auth'] = true;
            header('Location: index.php');
        
        }else{
            $error = 'Veuiller entrer un identifiant valide';
        }
    }
}

require_once 'login_view.php';