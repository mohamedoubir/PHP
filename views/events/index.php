<?php $pageTitle = 'Événements';
require __DIR__ . '/../layout/header.php'; ?>
<div class="page-heading">
    <div>
        <h1>Événements</h1>
        <p class="muted">Gérez les activités de l’association.</p>
    </div><a class="btn" href="index.php?page=event-form">+ Ajouter</a>
</div>
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Catégorie</th>
                <th>Places restantes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $e): $restantes = max(0, (int)$e['nombre_places'] - (int)$e['inscrits']); ?>
                <tr>
                    <td><strong><?= htmlspecialchars($e['titre']) ?></strong></td>
                    <td><?= htmlspecialchars($e['date_evenement']) ?></td>
                    <td><?= htmlspecialchars($e['lieu']) ?></td>
                    <td><span class="pill"><?= htmlspecialchars($e['categorie']) ?></span></td>
                    <td><?= $restantes ?> / <?= (int)$e['nombre_places'] ?></td>
                    <td class="actions"><a class="link" href="index.php?page=event-form&id=<?= (int)$e['id'] ?>">Modifier</a>
                        <form method="post" action="index.php?page=event-delete" onsubmit="return confirm('Supprimer cet événement ?')"><input type="hidden" name="id" value="<?= (int)$e['id'] ?>"><button class="link danger" type="submit">Supprimer</button></form>
                        <a class="link" href="index.php?page=inscriptions&event_id=<?= (int)$e['id'] ?>">Inscrits</a>
                    </td>
                </tr>
            <?php endforeach;
            if (!$events): ?><tr>
                    <td colspan="6">Aucun événement pour le moment.</td>
                </tr><?php endif; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>