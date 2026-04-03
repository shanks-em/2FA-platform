<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card card-wide">

        <div class="brand">
            <div class="brand-dot">⚡</div>
            <span class="brand-name">OTP API</span>
        </div>

        <h1 class="card-title">Tableau de bord</h1>
        <p class="card-subtitle">Gérez vos codes OTP et testez votre intégration.</p>

        <div class="divider"></div>

        <div class="nav-grid">
            <a href="sendOTP.php" class="nav-card">
                <div class="nav-card-icon">📤</div>
                <div class="nav-card-title">Envoyer un OTP</div>
                <div class="nav-card-desc">Générer et envoyer un code à un utilisateur</div>
            </a>

            <a href="verifyOTP.php" class="nav-card">
                <div class="nav-card-icon">✅</div>
                <div class="nav-card-title">Vérifier un OTP</div>
                <div class="nav-card-desc">Valider un code OTP reçu</div>
            </a>
        </div>

        <a href="deconnexion.php" class="btn-logout">
            ← Déconnexion
        </a>

    </div>
</body>
</html>
