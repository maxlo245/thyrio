<?php
$title = 'Inscription';
ob_start();
?>
<h2>Inscription</h2>
<form method="post" action="">
    <label>Email
        <input type="email" name="email" required>
    </label>
    <label>Mot de passe
        <input type="password" name="password" required>
    </label>
    <label>Confirmer le mot de passe
        <input type="password" name="password_confirm" required>
    </label>
    <button type="submit">Créer mon compte</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
