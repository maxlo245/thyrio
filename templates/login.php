<?php
$title = 'Connexion';
ob_start();
?>
<h2>Connexion</h2>
<form method="post" action="">
    <label>Email
        <input type="email" name="email" required>
    </label>
    <label>Mot de passe
        <input type="password" name="password" required>
    </label>
    <button type="submit">Se connecter</button>
</form>
<p><a href="index.php?page=register">Créer un compte</a></p>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
