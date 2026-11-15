<?php
class InscriptionController
{
    public static function index()
    {
        $model = new InscriptionModel();
        $events = $model->allEvents();
        $selected = (int)($_GET['event_id'] ?? ($events[0]['id'] ?? 0));
        $participants = $model->participants();
        $inscrits = $selected ? $model->listForEvent($selected) : [];
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['participant_id'])) {
            try {
                $model->add((int)$_POST['participant_id'], (int)$_POST['event_id']);
                header('Location: index.php?page=inscriptions&event_id=' . (int)$_POST['event_id']);
                exit;
            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        }
        require __DIR__ . '/../views/inscriptions/index.php';
    }
    public static function add()
    {
        header('Location: index.php?page=inscriptions');
        exit;
    }
    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new InscriptionModel())->delete((int)($_POST['id'] ?? 0));
        header('Location: index.php?page=inscriptions');
        exit;
    }
}
