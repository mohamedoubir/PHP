<?php
class EventController
{
    public static function index()
    {
        $model = new EventModel();
        $events = $model->all();
        require __DIR__ . '/../views/events/index.php';
    }
    public static function form()
    {
        $model = new EventModel();
        $event = isset($_GET['id']) ? $model->find((int)$_GET['id']) : null;
        $categories = $model->categories();
        require __DIR__ . '/../views/events/form.php';
    }
    public static function save()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=events');
            exit;
        }
        $d = $_POST;
        $d['id'] = (int)($d['id'] ?? 0);
        $d['nombre_places'] = max(1, (int)($d['nombre_places'] ?? 1));
        (new EventModel())->save($d);
        header('Location: index.php?page=events');
        exit;
    }
    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new EventModel())->delete((int)($_POST['id'] ?? 0));
        header('Location: index.php?page=events');
        exit;
    }
}
