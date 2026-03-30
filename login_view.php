<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">

        <div class="brand">
            <div class="brand-dot">⚡</div>
            <span class="brand-name">OTP API</span>
        </div>

        <h1 class="card-title">Bon retour !</h1>
        <p class="card-subtitle">Connectez-vous pour accéder à votre espace.</p>

        <?php if (!empty($_SESSION['connexionFailed'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['connexionFailed']; unset($_SESSION['connexionFailed']); ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="johndoe@gmail.com">
                <?php if (!empty($_SESSION['errorEmail'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorEmail']; unset($_SESSION['errorEmail']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••">
                <?php if (!empty($_SESSION['errorPassword'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorPassword']; unset($_SESSION['errorPassword']); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" name="action" value="Se Connecter" class="btn btn-primary">
                Se connecter →
            </button>

        </form>

        <div class="card-footer">
            Pas encore de compte ? <a href="index.php" class="link">S'inscrire</a>
        </div>
    </div>
</body>
</html>
