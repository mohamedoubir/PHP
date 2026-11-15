<?php if (!isset($pageTitle)) $pageTitle = 'Association Culturelle'; ?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <header class="topbar">
    <div class="brand">Culture<span>Tanger</span></div>
    <?php if (!empty($_SESSION['responsable'])): ?>
      <nav>
        <a href="index.php?page=dashboard">Accueil</a>
        <a href="index.php?page=events">Événements</a>
        <a href="index.php?page=participants">Participants</a>
        <a href="index.php?page=inscriptions">Inscriptions</a>
        <a class="logout" href="index.php?page=logout">Déconnexion</a>
      </nav>
    <?php endif; ?>
  </header>
  <main class="container">