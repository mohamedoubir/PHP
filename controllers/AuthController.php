<?php
class AuthController
{
    public static function login()
    {
        if (empty($_SESSION['responsable'])) {

            $error = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $db = Database::connect();
                $s = $db->prepare('SELECT * FROM responsables WHERE username=?');
                $s->execute([trim($_POST['username'] ?? '')]);
                $user = $s->fetch();
                if ($user && password_verify($_POST['password'] ?? '', $user['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['responsable'] = $user['username'];
                    header('Location: index.php?page=dashboard');
                    exit;
                }
                $error = 'Nom d’utilisateur ou mot de passe incorrect.';
            }
            require __DIR__ . '/../views/login.php';
        } else {
            header("location: index.php?page=dashboard");
        }
    }
    public static function protect()
    {
        if (empty($_SESSION['responsable'])) {
            header('Location: index.php?page=login');
            exit;
        }
    }
    public static function logout()
    {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
