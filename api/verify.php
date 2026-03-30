<?php
       header('Content-Type: application/json');
       require_once __DIR__.'/../database.php';


        $body = file_get_contents('php://input');
        $data = json_decode($body);
        $hasError = false;

       if(isset($data->email) && isset($data->token) && isset($data->otp) && isset($data->userEmail)){

        if(empty($data->email)){
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Veuillez entrez votre email"]);
            return;
        }
         if(empty($data->token)){
            http_response_code(400);
            echo  json_encode(["success" => false, "message" => "Veuillez entrez votre token"]);
            return;
        }
         if(empty($data->otp)){
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Veuillez spécifier le code OTP de l'utilisateur"]);
            return;
        }
         if(empty($data->userEmail)){
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Veuillez entrez l'email de l'utilisateur"]);
            return;
        }

        $token_hache = hash('sha256', $data->token);
        $sql = "SELECT token FROM applications WHERE email = :email  AND is_active = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $data->email
        ]);

        $tokenbase = $stmt->fetchColumn();

        if($tokenbase === false){
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Votre email n'est pas éligible"]);
            return;
        }else if($tokenbase == $token_hache){
 
            $sql2 = "SELECT user_email,otp, is_used  FROM otpCodes WHERE user_email = :userEmail AND otp = :otp";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute([
                ':userEmail' => $data->userEmail,
                ':otp' => $data->otp
            ]);


            $result = $stmt2->fetch();

            if($result){

                if($result['is_used'] == 1){
                    http_response_code(422);
                    echo json_encode(["success" => false, "message" => "Code déjà utilisé"]);
                    return;
                }
                else if ($result['is_used'] == 0){
                    $sql3 = "SELECT user_email,otp FROM otpCodes WHERE user_email = :userEmail AND otp = :otp AND expires_at < NOW()";
                    $stmt3 = $pdo->prepare($sql3);
                    $stmt3->execute([
                        ':userEmail' => $data->userEmail,
                        ':otp' => $data->otp
                    ]);

                    $result1 = $stmt3->fetch();

                    if($result1 !== false){
                        http_response_code(422);
                        echo json_encode(["success" => false, "message" => "Code expiré"]);
                        return;
                    }
                }
                
              

                $sql4 = "UPDATE otpCodes SET is_used = 1 WHERE user_email = :userEmail AND otp = :otp";
                $stmt4 = $pdo->prepare($sql4);
                $stmt4->execute([
                    ':userEmail' => $result['user_email'],
                    ':otp' => $result['otp']
                ]);

                http_response_code(200);
                echo json_encode(["success" => true, "message" => "Auth valide"]);

            }else{
                http_response_code(401);
                echo json_encode(["success" => false, "message" => "Code incorrect"]);
            }
        }else{
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Token incorrect"]);
        }

       }else{
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Veuillez renseigner correctement les clés"]);
    }