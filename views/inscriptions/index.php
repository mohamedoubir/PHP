<?php $pageTitle = 'Inscriptions';
require __DIR__ . '/../layout/header.php'; ?>
<h1>Inscriptions</h1>
<p class="muted">Choisissez un événement pour voir ses participants et les places restantes.</p>
<form class="filter-form" method="get"><input type="hidden" name="page" value="inscriptions"><label>Événement</label><select name="event_id" onchange="this.form.submit()"><?php foreach ($events as $e): ?><option value="<?= (int)$e['id'] ?>" <?= $selected === (int)$e['id'] ? 'selected' : '' ?>><?= htmlspecialchars($e['titre']) ?></option><?php endforeach; ?></select></form>
<?php $chosen = null;
foreach ($events as $e) if ((int)$e['id'] === $selected) $chosen = $e;
if ($chosen): ?>
    <div class="notice">Places restantes : <strong><?= max(0, (int)$chosen['nombre_places'] - (int)$chosen['inscrits']) ?></strong> sur <?= (int)$chosen['nombre_places'] ?></div>
<?php endif; ?>
<?php if ($message): ?><div class="alert"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<section class="form-card">
    <h2>Inscrire un participant</h2>
    <form method="post" action="index.php?page=inscriptions&event_id=<?= $selected ?>">
        <input type="hidden" name="event_id" value="<?= $selected ?>"><label>Participant</label><select name="participant_id" required><?php foreach ($participants as $p): ?><option value="<?= (int)$p['id'] ?>"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom'] . ' — ' . $p['email']) ?></option><?php endforeach; ?></select>
        <button class="btn" <?= (!$chosen || (int)$chosen['inscrits'] >= (int)$chosen['nombre_places'] || !$participants) ? 'disabled' : '' ?>>Inscrire</button>
    </form>
</section>
<h2>Liste des inscrits</h2>
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Ville</th>
                <th>Date d’inscription</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inscrits as $p): ?><tr>
                    <td><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></td>
                    <td><?= htmlspecialchars($p['email']) ?></td>
                    <td><?= htmlspecialchars($p['ville'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['date_inscription']) ?></td>
                    <td>
                        <form method="post" action="index.php?page=inscription-delete" onsubmit="return confirm('Retirer cette inscription ?')"><input type="hidden" name="id" value="<?= (int)$p['inscription_id'] ?>"><button class="link danger">Retirer</button></form>
                    </td>
                </tr><?php endforeach;
                    if (!$inscrits): ?><tr>
                    <td colspan="5">Aucun inscrit pour cet événement.</td>
                </tr><?php endif; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>