<?php
session_start();

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/EventModel.php';
require_once __DIR__ . '/models/ParticipantModel.php';
require_once __DIR__ . '/models/InscriptionModel.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/EventController.php';
require_once __DIR__ . '/controllers/ParticipantController.php';
require_once __DIR__ . '/controllers/InscriptionController.php';

$page = $_GET['page'] ?? (isset($_SESSION['responsable']) ? 'dashboard' : 'login');

switch ($page) {
    case 'login':
        AuthController::login();
        break;
    case 'logout':
        AuthController::logout();
        break;
    case 'dashboard':
        AuthController::protect();
        require __DIR__ . '/views/dashboard.php';
        break;
    case 'events':
        AuthController::protect();
        EventController::index();
        break;
    case 'event-form':
        AuthController::protect();
        EventController::form();
        break;
    case 'event-save':
        AuthController::protect();
        EventController::save();
        break;
    case 'event-delete':
        AuthController::protect();
        EventController::delete();
        break;
    case 'participants':
        AuthController::protect();
        ParticipantController::index();
        break;
    case 'participant-form':
        AuthController::protect();
        ParticipantController::form();
        break;
    case 'participant-save':
        AuthController::protect();
        ParticipantController::save();
        break;
    case 'participant-delete':
        AuthController::protect();
        ParticipantController::delete();
        break;
    case 'inscriptions':
        AuthController::protect();
        InscriptionController::index();
        break;
    case 'inscription-add':
        AuthController::protect();
        InscriptionController::add();
        break;
    case 'inscription-delete':
        AuthController::protect();
        InscriptionController::delete();
        break;
    default:
        http_response_code(404);
        echo 'Page introuvable.';
}
