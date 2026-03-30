<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoyer un OTP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">

        <div class="brand">
            <div class="brand-dot">📤</div>
            <span class="brand-name">OTP API</span>
        </div>

        <h1 class="card-title">Envoyer un OTP</h1>
        <p class="card-subtitle">Générez et envoyez un code à usage unique.</p>

       

        <form method="POST" action="sendTreatment.php">

            <div class="form-group">
                <label for="email">Votre email</label>
                <input type="text" id="email" name="email" placeholder="vous@exemple.com">
                <?php if (!empty($_SESSION['errorEmail'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorEmail']; unset($_SESSION['errorEmail']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="token">Token API</label>
                <input type="text" name="token" id="token" placeholder="Votre clé d'API">
                <?php if (!empty($_SESSION['errorToken'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorToken']; unset($_SESSION['errorToken']); ?></span>
                <?php endif; ?>
            </div>

            <div class="divider"></div>

            <div class="form-group">
                <label for="whatsapp">Numéro WhatsApp destinataire</label>
                <input type="number" id="whatsapp" name="whatsapp" placeholder="Ex: 22958635421">
                <?php if (!empty($_SESSION['errorWhatsapp'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorWhatsapp']; unset($_SESSION['errorWhatsapp']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="userEmail">Email destinataire</label>
                <input type="text" id="userEmail" name="userEmail" placeholder="destinataire@exemple.com">
                <?php if (!empty($_SESSION['errorUserEmail'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorUserEmail']; unset($_SESSION['errorUserEmail']); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" name="action" value="Envoyer OTP" class="btn btn-primary">
                Envoyer le code OTP →
            </button>

        </form>

        <div class="card-footer">
            <a href="home.php" class="link">← Retour au tableau de bord</a>
        </div>
    </div>
</body>
</html>
