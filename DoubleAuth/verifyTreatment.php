<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$hasError = false;

if(isset($_POST['email']) && isset($_POST['token']) && isset($_POST['otp']) && isset($_POST['userEmail'])){

    if(trim($_POST['email']) == ''){
        $_SESSION['errorEmail'] = "veuillez entrer votre mail d'inscription";
        $hasError = true;
    }
    if(trim($_POST['token']) == ''){
        $_SESSION['errorToken'] = "veuillez entrer un token";
        $hasError = true;
    }
    if(trim($_POST['otp']) == ''){
        $_SESSION['errorOtp'] = "veuillez entrer le code OTP";
        $hasError = true;
    }
    if(trim($_POST['userEmail']) == ''){
        $_SESSION['errorUserEmail'] = "veuillez entrer le mail de l'utilisateur";
        $hasError = true;
    }

    if($hasError){
        header('Location: verifyOTP.php');
        exit();
    }

    $data = [
        "email"     => $_POST['email'],
        "token"     => $_POST['token'],
        "otp"       => $_POST['otp'],
        "userEmail" => $_POST['userEmail'],
    ];

    // Injection des données pour verify.php
    $GLOBALS['mock_input'] = json_encode($data);

    ob_start();
    require __DIR__ . '/api/verify.php';
    $response = ob_get_clean();

    $result = json_decode($response, true);

    if(isset($result['success']) && $result['success']){
        echo "Code correct !";
    } else {
        echo "Erreur : " . ($result['message'] ?? 'Réponse invalide du serveur');
    }
}
?>