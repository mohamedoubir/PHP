<?php
class ParticipantController
{
    public static function index()
    {
        $participants = (new ParticipantModel())->all();
        require __DIR__ . '/../views/participants/index.php';
    }
    public static function form()
    {
        $model = new ParticipantModel();
        $participant = isset($_GET['id']) ? $model->find((int)$_GET['id']) : null;
        require __DIR__ . '/../views/participants/form.php';
    }
    public static function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=participants');
            exit;
        }
        (new ParticipantModel())->save($_POST);
        header('Location: index.php?page=participants');
        exit;
    }
    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ParticipantModel())->delete((int)($_POST['id'] ?? 0));
        header('Location: index.php?page=participants');
        exit;
    }
}
