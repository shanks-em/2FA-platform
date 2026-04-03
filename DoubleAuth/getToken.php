<?php
session_start();
$token = $_SESSION['tokenBrut'] ?? null;
unset($_SESSION['tokenBrut']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Token API</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">

        <div class="brand">
            <div class="brand-dot">⚡</div>
            <span class="brand-name">OTP API</span>
        </div>

        <h1 class="card-title">Votre token API</h1>
        <p class="card-subtitle">Compte créé avec succès. Voici votre clé d'accès.</p>

        <?php if ($token): ?>
            <div class="token-box" id="tokenValue"><?php echo htmlspecialchars($token); ?></div>

            <button class="btn-copy" onclick="copyToken()">
                <span id="copyIcon">📋</span>
                <span id="copyText">Copier le token</span>
            </button>

            <p class="copy-hint">Ce token ne sera affiché qu'une seule fois. Conservez-le en lieu sûr.</p>

            <div class="token-warning">
                🔐 Une fois cette page quittée, vous ne pourrez plus consulter ce token. Copiez-le maintenant et stockez-le dans un endroit sécurisé (gestionnaire de mots de passe, fichier .env…).
            </div>
        <?php else: ?>
            <div class="alert alert-error">Aucun token disponible. Ce lien a peut-être déjà été utilisé.</div>
        <?php endif; ?>

        <div class="card-footer" style="margin-top: 2rem;">
            <a href="home.php" class="link">Aller au tableau de bord →</a>
        </div>
    </div>

    <script>
    function copyToken() {
        const text = document.getElementById('tokenValue').innerText;
        navigator.clipboard.writeText(text).then(() => {
            document.getElementById('copyIcon').textContent = '✅';
            document.getElementById('copyText').textContent = 'Copié !';
            setTimeout(() => {
                document.getElementById('copyIcon').textContent = '📋';
                document.getElementById('copyText').textContent = 'Copier le token';
            }, 2500);
        });
    }
    </script>
</body>
</html>
