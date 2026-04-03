<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier un OTP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">

        <div class="brand">
            <div class="brand-dot">✅</div>
            <span class="brand-name">OTP API</span>
        </div>

        <h1 class="card-title">Vérifier un OTP</h1>
        <p class="card-subtitle">Validez le code à usage unique reçu par l'utilisateur.</p>

        <?php if (!empty($_SESSION['info'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['info']; unset($_SESSION['info']); ?></div>
        <?php endif; ?>

        <form method="POST" action="verifyTreatment.php">

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
                <label for="userEmail">Email de l'utilisateur</label>
                <input type="text" id="userEmail" name="userEmail" placeholder="utilisateur@exemple.com">
                <?php if (!empty($_SESSION['errorUserEmail'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorUserEmail']; unset($_SESSION['errorUserEmail']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="otp">Code OTP</label>
                <input type="number" id="otp" name="otp" placeholder="123456">
                <?php if (!empty($_SESSION['errorOTP'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorOTP']; unset($_SESSION['errorOTP']); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" name="action" value="Vérifier OTP" class="btn btn-primary">
                Vérifier le code →
            </button>

        </form>

        <div class="card-footer">
            <a href="home.php" class="link">← Retour au tableau de bord</a>
        </div>
    </div>
</body>
</html>
