<?php 
        header('Content-Type: application/json');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $env = parse_ini_file(__DIR__ . '/../.env');

        $username = $env['MAIL_USER'];
        $password = $env['MAIL_PASS'];
        

        require_once __DIR__.'/../database.php';
        require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
        require_once __DIR__ . '/../PHPMailer/src/Exception.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        $body = $GLOBALS['mock_input'] ?? file_get_contents('php://input');
        $data = json_decode($body);
        $hasError = false;
     if(isset($data->email) && isset($data->token) && isset($data->whatsapp) && isset($data->userEmail)){

        if(empty($data->email)){
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Veuillez entrez votre email"]);
            return;
        }
         if(empty($data->token)){
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Veuillez entrez votre token"]) ;
            return;
        }
         if(empty($data->whatsapp)){
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Veuillez spécifier le whatsapp de l'utilisateur"]) ;
            return;
        }
         if(empty($data->userEmail)){
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Veuillez entrez l'email de l'utilisateur"]) ;
            return;
        }


        $token_hache = hash('sha256', $data->token);
        $sql = "SELECT token,id FROM applications WHERE email = :email  AND is_active = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $data->email
        ]);

        $result = $stmt->fetch();

            if($result === false){
                http_response_code(401);
                echo json_encode(["success" => false, "message" => "Cette adresse mail n'est pas éligible "]);
            }
            else if($result['token'] == $token_hache){
                $code = random_int(100000,999999);
                //$expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

                $sql2 ="INSERT INTO  otpcodes (whatsapp, user_email,otp, expires_at, app_id) VALUES (:whatsapp, :user_email, :otp, DATE_ADD(NOW(), INTERVAL 10 MINUTE), :app_id)";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute([
                    ":whatsapp" =>  $data->whatsapp,
                    ":user_email" => $data->userEmail,
                    ":otp" => $code,
                     ":app_id" => $result['id']
                ]);


                    $emailSent = false;
                    $whatsappSent = false;
                    $errors = [];

                    // Envoi Email
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = $username;
                        $mail->Password = $password;
                        $mail->SMTPSecure = 'ssl'; 
                        $mail->Port = 465; 
                        $mail->SMTPOptions = [
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ];
                        $mail->setFrom($username, 'Double Auth');
                        $mail->addAddress($data->userEmail);
                        $mail->isHTML(true);
                        $mail->Subject = 'Votre code OTP';
                        $mail->Body = "<h2>Votre code de vérification est : <strong>$code</strong></h2><p>Ce code expire dans 10 minutes.</p>";
                        $mail->send();
                        $emailSent = true;
                    } catch (Exception $e) {
                         $errors[]= "Email : " . $e->getMessage();
                    }

                    // Envoi WhatsApp via Whapi
                    $url = "https://gate.whapi.cloud/messages/text";
                    $payload = json_encode([
                        "to" => $data->whatsapp,
                        "body" => "Votre code OTP est : $code\nCe code expire dans 10 minutes."
                    ]);

                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $env['WHAPI_TOKEN']
                    ]);

                    $response = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                    $whapiResult = json_decode($response, true);
                    if($httpCode === 200 || $httpCode === 201){
                        $whatsappSent = true;
                    } else {
                        $errors[] = "WhatsApp : " . ($whapiResult['message'] ?? 'Erreur inconnue');
                    }

                     if($emailSent || $whatsappSent){
                        http_response_code(200);
                        echo json_encode([
                            'success' => true,
                            'message' => 'Code OTP envoyé',
                            'email' => $emailSent,
                            'whatsapp' => $whatsappSent,
                            'errors' => $errors
                        ]);
                    } else {
                        http_response_code(500);
                        echo json_encode([
                            'success' => false,
                            'message' => 'Échec de l\'envoi',
                            'errors' => $errors
                        ]);
                    }
                //echo $code;
            }else{
                http_response_code(401);
                echo json_encode(["success" => false, "message" => "Token incorrect"]);
            }
       
    }else{
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Veuillez renseigner correctement les clés"]);
    }
 