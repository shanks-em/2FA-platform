<?php
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $hasError = false;

    if(isset($_POST['email']) && isset($_POST['token']) && isset($_POST['whatsapp']) && isset($_POST['userEmail'])){

        if(trim($_POST['email']) == ''){
            $_SESSION['errorEmail']  = "veuillez entrer votre mail d'inscription";
            $hasError = true;
            
        }

        if(trim($_POST['token']) == ''){
            $_SESSION['errorToken']  =  "veuillez entrer un token";
            $hasError = true;
            
        }

        if(trim($_POST['whatsapp']) == ''){
            $_SESSION['errorWhatsapp']  =  "veuillez entrer un numéro whatsapp";
            $hasError = true;
        }

         if(trim($_POST['userEmail']) == ''){
            $_SESSION['errorUserEmail']  =  "veuillez entrer le mail de l'utilisateur";
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

        $ch = curl_init("http://localhost:81/DoubleAuth/api/send.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = json_decode($response, true);

        if ($httpCode === 200 && $result['success']) {
            echo "OTP envoyé avec succès !";
        } else {
            echo "Erreur : " . $result['message'];
        }
    }
    

?>