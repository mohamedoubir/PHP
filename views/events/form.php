<?php $editing = !empty($event);
$pageTitle = $editing ? 'Modifier événement' : 'Ajouter événement';
require __DIR__ . '/../layout/header.php'; ?>
<h1><?= $editing ? 'Modifier' : 'Ajouter' ?> un événement</h1>
<form class="form-card" method="post" action="index.php?page=event-save">
    <input type="hidden" name="id" value="<?= (int)($event['id'] ?? 0) ?>">
    <label>Titre</label>
    <input name="titre" required maxlength="150" value="<?= htmlspecialchars($event['titre'] ?? '') ?>">
    <label>Description</label>
    <textarea name="description" rows="3"><?= htmlspecialchars($event['description'] ?? '') ?></textarea>
    <label>Date et heure</label>
    <input type="datetime-local" name="date_evenement" required value="<?= !empty($event['date_evenement']) ? date('Y-m-d\\TH:i', strtotime($event['date_evenement'])) : '' ?>">
    <label>Lieu</label>
    <input name="lieu" required value="<?= htmlspecialchars($event['lieu'] ?? '') ?>">
    <label>Nombre de places</label>
    <input type="number" name="nombre_places" min="1" required value="<?= (int)($event['nombre_places'] ?? 20) ?>">
    <label>Catégorie</label>
    <select name="categorie_id" required>
        <?php foreach ($categories as $c): ?>
            <option value="<?= (int)$c['id'] ?>" <?= (int)($event['categorie_id'] ?? 0) === (int)$c['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['libelle']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <div class="form-actions">
        <button class="btn">Enregistrer</button>
        <a class="btn secondary" href="index.php?page=events">Annuler</a>
    </div>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>