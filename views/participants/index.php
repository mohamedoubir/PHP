<?php $pageTitle = 'Participants';
require __DIR__ . '/../layout/header.php'; ?>
<div class="page-heading">
    <div>
        <h1>Participants</h1>
        <p class="muted">Liste des personnes inscrites.</p>
    </div><a class="btn" href="index.php?page=participant-form">+ Ajouter</a>
</div>
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Ville</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participants as $p): ?><tr>
                    <td><?= htmlspecialchars($p['nom']) ?></td>
                    <td><?= htmlspecialchars($p['prenom']) ?></td>
                    <td><?= htmlspecialchars($p['email']) ?></td>
                    <td><?= htmlspecialchars($p['telephone'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['ville'] ?? '') ?></td>
                    <td class="actions"><a class="link" href="index.php?page=participant-form&id=<?= (int)$p['id'] ?>">Modifier</a>
                        <form method="post" action="index.php?page=participant-delete" onsubmit="return confirm('Supprimer ce participant ?')"><input type="hidden" name="id" value="<?= (int)$p['id'] ?>"><button class="link danger">Supprimer</button></form>
                    </td>
                </tr>
                <?php endforeach;
                    if (!$participants): ?>
                    <tr>
                        <td colspan="6">Aucun participant. right now</td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>