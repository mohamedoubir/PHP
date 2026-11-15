<?php
require_once __DIR__ . '/config/Database.php';
$db = Database::connect();
$username = 'oubir';
$password = password_hash('oubir1234', PASSWORD_DEFAULT);
$stmt = $db->prepare('INSERT INTO responsables (username, password) VALUES (?, ?) ON DUPLICATE KEY UPDATE password = VALUES(password)');
$stmt->execute([$username, $password]);
echo 'Compte créé : admin / password. Supprime setup_admin.php après utilisation.';
