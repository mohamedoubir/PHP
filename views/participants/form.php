<?php $editing = !empty($participant);
$pageTitle = $editing ? 'Modifier participant' : 'Ajouter participant';
require __DIR__ . '/../layout/header.php'; ?>
<h1><?= $editing ? 'Modifier' : 'Ajouter' ?> un participant</h1>
<form class="form-card" method="post" action="index.php?page=participant-save">
    <input type="hidden" name="id" value="<?= (int)($participant['id'] ?? 0) ?>">
    <label>Nom</label><input name="nom" required value="<?= htmlspecialchars($participant['nom'] ?? '') ?>">
    <label>Prénom</label><input name="prenom" required value="<?= htmlspecialchars($participant['prenom'] ?? '') ?>">
    <label>Email</label><input type="email" name="email" required value="<?= htmlspecialchars($participant['email'] ?? '') ?>">
    <label>Téléphone</label><input name="telephone" value="<?= htmlspecialchars($participant['telephone'] ?? '') ?>">
    <label>Ville</label><input name="ville" value="<?= htmlspecialchars($participant['ville'] ?? '') ?>">
    <div class="form-actions"><button class="btn">Enregistrer</button><a class="btn secondary" href="index.php?page=participants">Annuler</a></div>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>