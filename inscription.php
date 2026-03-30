<?php
    session_start();
    require_once __DIR__.'/database.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $hasError = false;

    if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){

        if(trim($_POST['email']) == ''){
            $_SESSION['errorEmail']  = "veuillez entrer un email";
            $hasError = true;
            
        }

        if(trim($_POST['username']) == ''){
            $_SESSION['errorUsername']  =  "veuillez entrer un nom d'utilisateur";
            $hasError = true;
            
        }

        if(trim($_POST['password']) == ''){
            $_SESSION['errorPassword']  =  "veuillez entrer un mot de passe";
            $hasError = true;
        }

        if($hasError){
            header('Location: index.php');
            exit();
        }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
        
    $password = hash('sha256', $password);
    $tokenBrut = bin2hex(random_bytes(32));
    $tokenHache = hash('sha256', $tokenBrut);

    $_SESSION['tokenBrut'] = $tokenBrut;

    $verifyEmail = "SELECT COUNT(email) FROM applications WHERE email= :email";
    $stmt_0 = $pdo->prepare($verifyEmail);
    $stmt_0->execute([
        ':email' => $email
    ]);

    $count = $stmt_0->fetchColumn();

    if($count > 0){
        $_SESSION['compteExists'] = "Ce compte existe déjà";
        header('Location: index.php');
        exit();
    }else{
        $sql="INSERT INTO applications (username,email,password,token) VALUES (:username, :email, :password, :token)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':token' => $tokenHache
        ]);


        header('Location: getToken.php');
        exit();
    }

    }

