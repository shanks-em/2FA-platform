<?php
    session_start();
    require_once __DIR__.'/database.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $hasError = false;

    if(isset($_POST['email']) && isset($_POST['password'])){

        if(trim($_POST['email']) == ''){
            $_SESSION['errorEmail']  = "veuillez entrer un email";
            $hasError = true;
            
        }

        if(trim($_POST['password']) == ''){
            $_SESSION['errorPassword']  =  "veuillez entrer un mot de passe";
            $hasError = true;
        }

        if($hasError){
            header('Location: login_view.php');
            exit();
        }

    $email = $_POST['email'];
    $password = $_POST['password'];
        
    $password = hash('sha256', $password);

    $sql="SELECT username,email FROM applications WHERE email=:email AND password=:password";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email,
        ':password' => $password
    ]);

    $result = $stmt->fetch();

    if($result){
        $_SESSION['username'] = $result['username'];
        $_SESSION['email'] = $result['email'];
      header('Location: home.php');
        exit();
    }else{
        $_SESSION['connexionFailed'] = 'Identifiant ou Mot de passe incorrect';
        header('Location: login_view.php');
        exit();
    }
}

