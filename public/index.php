<?php
// public/index.php

require '../config/Database.php';
require '../controllers/AuthController.php';
require '../controllers/DonationController.php';
require '../controllers/EventController.php';
require '../controllers/TaskController.php';

// Check if user is logged in

// error_log(!isset($_SESSION['user_id']));
// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['user_id'] = 100000000; // You can assign null or redirect to login page
// }

$authController = new AuthController();
$model = new EventModel(Database::getInstance()->getConnection());
$userModel= new User(Database::getInstance()->getConnection());
$donationController = new DonationController();
if (isset($_SESSION['user_id'])) {
$eventController = new EventController($model, $_SESSION['user_id']);
$taskModel = new TaskModel(Database::getInstance()->getConnection());
$taskController = new TaskController($taskModel, $_SESSION['user_id'], $userModel);
}
// $taskController = new TaskController();

// Get the requested URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

// Route GET requests to views and POST requests to controller actions
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if($uri === '' || $uri === 'index.php' || $uri === 'login.php'){
        include '../views/homePage/home.php';    
    }
    elseif ($uri === 'signup') {
        include '../views/auth/signup.php';
    }
    elseif ($uri === 'logout') {
        include '../views/auth/logout.php';
    } elseif ($uri === 'login') {
        include '../views/auth/login.php';
    } elseif ($uri === 'create_donation') {
        // $donationController->showDonationForm();
        include '../views/donation/create.php';
    } elseif ($uri === 'events/list') {
        // Show list of events
        include '../views/events/list.php';
    } elseif ($uri === 'events/add') {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_name'])) {
            echo json_encode(['message' => 'Please login to proceed with your donation.']);
            exit;
        }
        // Show add event form
        include '../views/events/add.php';
    } elseif (preg_match('/^events\/edit\/\d+$/', $uri)) {
        // Extract the event ID from the route and show edit form
        $id = explode('/', $uri)[2];
        $_GET['id'] = $id;
        include '../views/events/edit.php';
    } elseif ($uri === 'events/undo') {
        $eventController->undo();
        header('Location: /events/list');
    }    elseif ($uri === 'tasks/list') {
        include '../views/tasks/list.php';
    } elseif ($uri === 'tasks/add') {
        include '../views/tasks/add.php';
    } elseif ($uri === 'tasks/edit') {
        include '../views/tasks/edit.php';
    } elseif ($uri === 'tasks/undo') {
        $taskController->undo();
        header('Location: /tasks/list');
    }elseif ($uri === 'tasks/available') {
        $availableTasks = $taskController->getAvailableTasks();
        include '../views/tasks/available.php';
    }
     else {
        echo "Page not found.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($uri === 'signup') {
        echo $authController->signup($_POST);
    } elseif ($uri === 'login') {
        echo $authController->login($_POST);
    } elseif ($uri === 'submit_donation') {
                // Start session if not started already
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
        
                // Check if the session token exists (assuming it's stored as 'session_token')
                if (!isset($_SESSION['user_name'])) {
                    echo json_encode(['message' => 'Please login to proceed with your donation.']);
                    exit;
                }

        if($_POST['donorName']==""){
            $_POST['donorName'] = $_SESSION['user_name'];
            $_POST['donorId'] = $_SESSION['user_id'];
        }else{
            $_POST['donorId'] = Null;

        }
        
        $donationController->generateReceiptAndProcessPayment($_POST);
    } elseif ($uri === 'generate_receipt') {
        
    }elseif ($uri === 'events/create') {
        $eventController->addEvent($_POST);
        header('Location: /events/list');
    } elseif ($uri === 'events/update') {
        $eventController->editEvent($_POST['id'], $_POST);
        header('Location: /events/list');
    } elseif ($uri === 'events/delete') {
        $eventController->deleteEvent($_POST['id']);
        header('Location: /events/list');
    }    elseif ($uri === 'tasks/create') {
        $taskController->addTask($_POST);
        header('Location: /tasks/list');
    } elseif ($uri === 'tasks/update') {
        $taskController->editTask($_POST['id'], $_POST);
        header('Location: /tasks/list');
    } elseif ($uri === 'tasks/delete') {
        $taskController->deleteTask($_POST['id']);
        header('Location: /tasks/list');
    }elseif ($uri === 'tasks/assign') {
        $response = $taskController->assignTask($_POST['task_id']);
        echo json_encode(['message' => $response]);
    }
    else {
        echo "Invalid action.";
    }
}

