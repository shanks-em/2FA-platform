<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">

        <div class="brand">
            <div class="brand-dot">⚡</div>
            <span class="brand-name">OTP API</span>
        </div>

        <h1 class="card-title">Créer un compte</h1>
        <p class="card-subtitle">Rejoignez-nous pour accéder à l'API.</p>

        <?php if (!empty($_SESSION['compteExists'])): ?>
            <div class="alert alert-error"><?php echo $_SESSION['compteExists']; unset($_SESSION['compteExists']); ?></div>
        <?php endif; ?>

        <form method="POST" action="inscription.php">

            <div class="form-group">
                <label for="username">Nom</label>
                <input type="text" name="username" id="username" placeholder="John Doe">
                <?php if (!empty($_SESSION['errorUsername'])): ?>
                    <span class="field-error"><?php echo $_SESSION['errorUsername']; unset($_SESSION['errorUsername']); ?></span>
                <?php endif; ?>
            </div>

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

            <button type="submit" name="action" value="S'inscrire" class="btn btn-primary">
                Créer mon compte →
            </button>

        </form>

        <div class="card-footer">
            Déjà un compte ? <a href="login_view.php" class="link">Se connecter</a>
        </div>
    </div>
</body>
</html>
