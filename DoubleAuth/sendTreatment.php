<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$hasError = false;

if(isset($_POST['email']) && isset($_POST['token']) && isset($_POST['whatsapp']) && isset($_POST['userEmail'])){

    if(trim($_POST['email']) == ''){
        $_SESSION['errorEmail'] = "veuillez entrer votre mail d'inscription";
        $hasError = true;
    }
    if(trim($_POST['token']) == ''){
        $_SESSION['errorToken'] = "veuillez entrer un token";
        $hasError = true;
    }
    if(trim($_POST['whatsapp']) == ''){
        $_SESSION['errorWhatsapp'] = "veuillez entrer un numéro whatsapp";
        $hasError = true;
    }
    if(trim($_POST['userEmail']) == ''){
        $_SESSION['errorUserEmail'] = "veuillez entrer le mail de l'utilisateur";
        $hasError = true;
    }

    if($hasError){
        header('Location: sendOTP.php');
        exit();
    }

    $data = [
        "email"     => $_POST['email'],
        "token"     => $_POST['token'],
        "whatsapp"  => $_POST['whatsapp'],
        "userEmail" => $_POST['userEmail'],
    ];

    // ✅ Injection des données pour send.php
    $GLOBALS['mock_input'] = json_encode($data);

    // ✅ Capture la sortie de send.php
    ob_start();
    require __DIR__ . '/api/send.php';
    $response = ob_get_clean();

    $result = json_decode($response, true);

    if(isset($result['success']) && $result['success']){
        echo "OTP envoyé avec succès !";
    } else {
        echo "Erreur : " . ($result['message'] ?? 'Réponse invalide du serveur');
        echo "<br><pre>" . $response . "</pre>"; // debug temporaire
    }
}
?>