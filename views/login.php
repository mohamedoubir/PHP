<?php $pageTitle = 'Connexion';
require __DIR__ . '/layout/header.php'; ?>
<section class="login-card">
  <h1>Connexion responsable</h1>
  <p class="muted">Connectez-vous pour gérer les événements.</p>
  <?php if (!empty($error)): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post" action="index.php?page=login">
    <label>Nom d’utilisateur</label><input name="username" required autocomplete="username">
    <label>Mot de passe</label><input type="password" name="password" required autocomplete="current-password">
    <button class="btn" type="submit">Se connecter</button>
  </form>
  <p class="muted small">username : oubir / password : oubir1234 </p>
</section>
<?php require __DIR__ . '/layout/footer.php'; ?>