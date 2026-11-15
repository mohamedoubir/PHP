<?php $pageTitle = 'Tableau de bord';
require __DIR__ . '/layout/header.php';
$events = (new EventModel())->all();
$participants = (new ParticipantModel())->all();
$db = Database::connect();
$inscriptions = (int)$db->query('SELECT COUNT(*) FROM inscriptions')->fetchColumn(); ?>
<h1>Tableau de bord</h1>
<p class="muted">Bienvenue dans l’espace de gestion de votre association.</p>
<div class="stats">
  <div class="stat"><span>Événements</span><strong><?= count($events) ?></strong></div>
  <div class="stat"><span>Participants</span><strong><?= count($participants) ?></strong></div>
  <div class="stat"><span>Inscriptions</span><strong><?= $inscriptions ?></strong></div>
</div>
<div class="quick-links">
  <a class="btn" href="index.php?page=event-form">+ Ajouter un événement</a>
  <a class="btn secondary" href="index.php?page=participant-form">+ Ajouter un participant</a>
  <a class="btn secondary" href="index.php?page=inscriptions">Gérer les inscriptions</a>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>