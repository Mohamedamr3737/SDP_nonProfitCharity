<?php
// public/index.php

require '../config/Database.php';
require '../controllers/AuthController.php';
require '../controllers/DonationController.php';
require '../controllers/EventController.php';
require '../controllers/TaskController.php';
require '../controllers/BenefeciaryNeedsController.php';
require '../models/Proxy/AccessControlProxy.php';
require '../controllers/AdminDonationController.php';
require '../controllers/AdminController.php';
require '../controllers/AdminPaymentController.php';
require '../models/Iterator/EventIterator.php';

// Check if user is logged in

// error_log(!isset($_SESSION['user_id']));
// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['user_id'] = 100000000; // You can assign null or redirect to login page
// }

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_role'])) {
    $_SESSION['user_role'] = 'user';
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = null;
}

$authController = new AuthController();
$model = new EventModel(Database::getInstance()->getConnection());
$donationController = new DonationController();
$BenefeciaryNeedsController = new BenefeciaryNeedsController();
$AdminDonationController = new AdminDonationController();
$AdminController = new AdminController();
$adminProxy = new AccessControlProxy($AdminController, $_SESSION['user_role']);
$donationProxy = new AccessControlProxy($AdminDonationController, $_SESSION['user_role']);
$AdminPaymentController= new AdminPaymentController();
$paymentProxy = new AccessControlProxy($AdminPaymentController, $_SESSION['user_role']);

// if (isset($_SESSION['user_id'])) {
$eventController = new EventController($model, $_SESSION['user_id']);
$taskModel = new TaskModel(Database::getInstance()->getConnection());
$taskController = new TaskController($taskModel, $_SESSION['user_id']);
// }
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
        $adminProxy->handleRequest('super_admin', '../views/events/list.php', null, ['eventController' => $eventController]);
    }
    elseif ($uri === 'events/add') {
        $adminProxy->handleRequest('super_admin', '../views/events/add.php');
    } elseif (preg_match('/^events\/edit\/\d+$/', $uri)) {
        // Extract the event ID from the route and show edit form
        $id = explode('/', $uri)[2];
        $_GET['id'] = $id;
        include '../views/events/edit.php';
    } elseif ($uri === 'events/undo') {
        $adminProxy->handleRequest('super_admin', null, function() use ($eventController) {
            $eventController->undo();
            header('Location: /events/list');
            exit;
        });
    }   elseif ($uri === 'tasks/list') {
        $adminProxy->handleRequest('super_admin', '../views/tasks/list.php', null, ['taskController' => $taskController]);
    }
    elseif ($uri === 'tasks/add') {
        $adminProxy->handleRequest('super_admin', '../views/tasks/add.php', null, ['eventController' => $eventController]);
    } elseif ($uri === 'tasks/edit') {
        $adminProxy->handleRequest('super_admin', '../views/tasks/edit.php', null, ['taskController' => $taskController]);
    } elseif ($uri === 'tasks/undo') {
        $adminProxy->handleRequest('super_admin', null, function() use ($taskController) {
            $taskController->undo();
            header('Location: /tasks/list');
            exit;
            });
    }elseif ($uri === 'tasks/available') {
        $adminProxy->handleRequest('super_admin', null, function() use ($taskController) {
            $availableTasks = $taskController->getAvailableTasks();
            include '../views/tasks/available.php';
        });
    }elseif ($uri === 'tasks/generate_certificate') {
        $adminProxy->handleRequest('super_admin', null, function() use ($taskController) {
            $taskId = $_GET['task_id'];
            $userId = $_GET['user_id'];
        
            $filePath = $taskController->generateCertificate($taskId, $userId);
        
            if ($filePath) {
                $_SESSION['certificate_link'] = $filePath; // Store the link in the session
                header('Location: /tasks/list'); // Redirect back to the tasks list
                exit;
            } else {
                echo "Failed to generate certificate.";
            }
        });
    }    
    elseif ($uri === 'admin/add_needs') {
        $donationProxy->handleRequest('donations_admin', '../views/beneficiaries/addNeeds.php', null, [
            'beneficiariess' => $BenefeciaryNeedsController->getAllBeneficiaries()
        ]);
    }
    elseif ($uri === 'admin/add_beneficiary') {
        include '../views/beneficiaries/addBeneficiary.php';
    }elseif ($uri === 'admin/list_beneficiaries') {
        $beneficiaries = $BenefeciaryNeedsController->getAllBeneficiaries();
        include '../views/beneficiaries/listBeneficiaries.php';
    } elseif ($uri === 'admin/manage_needs') {
        $needs = $BenefeciaryNeedsController->getAllBeneficiaryNeeds();
        include '../views/beneficiaries/manageNeeds.php';
    }    
    elseif ($uri === 'admin/dashboard') {
        $adminProxy->handleRequest('Admin','../views/admin/dashboard.php');
    }
     elseif ($uri === 'admin/users') {
        $users = $adminProxy->handleRequest('super_admin', null, 'viewUsers');
        include '../views/admin/users.php';
    } elseif ($uri === 'admin/donations') {
        $donations = $donationProxy->handleRequest('donations_admin', null,'viewDonations' );
        include '../views/admin/donations.php';
    } elseif ($uri === 'admin/payments') {
        $payments = $paymentProxy->handleRequest('payment_admin', null,'viewPayments' );
        include '../views/admin/payments.php';
    } elseif ($uri === 'admin/event_registrations') {
        $adminProxy->handleRequest('super_admin', '../views/Ticketing/event_registrations.php', null, ['eventController' => $eventController]);
    }
     else {
        echo "Page not found.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($uri === 'signup') {
         $authController->signup($_POST);
    } elseif ($uri === 'login') {
         $authController->login($_POST);
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
            $_POST['donorEmail'] = $_SESSION['user_email'];
        }else{
            $_POST['donorId'] = Null;

        }
        
        $donationController->generateReceiptAndProcessPayment($_POST);
    } elseif ($uri === 'events/create') {
        $adminProxy->handleRequest('super_admin', null, function() use ($eventController) {
            $eventController->addEvent($_POST);
            header('Location: /events/list');
            exit;
        });
    } elseif ($uri === 'events/update') {
        $adminProxy->handleRequest('super_admin', null, function() use ($eventController) {
            $eventController->editEvent($_POST['id'], $_POST);
            header('Location: /events/list');
            exit;
        });
    } elseif ($uri === 'events/delete') {
        $adminProxy->handleRequest('super_admin', null, function() use ($eventController) {
            $eventController->deleteEvent($_POST['id']);
            header('Location: /events/list');
            exit;
        });
    } elseif ($uri === 'tasks/create') {
        $adminProxy->handleRequest('super_admin', null, function() use ($taskController) {
            $taskController->addTask($_POST);
            header('Location: /tasks/list');
            exit;
        });
    } elseif ($uri === 'tasks/update') {
        $adminProxy->handleRequest('super_admin', null, function() use ($taskController) {
            $taskController->editTask($_POST['id'], $_POST);
            header('Location: /tasks/list');
            exit;
        });
    } elseif ($uri === 'tasks/delete') {
        $adminProxy->handleRequest('super_admin', null, function() use ($taskController) {
            $taskController->deleteTask($_POST['id']);
            header('Location: /tasks/list');
            exit;
        });
    } elseif ($uri === 'tasks/assign') {
        $adminProxy->handleRequest('super_admin', null, function() use ($taskController) {
            $response = $taskController->assignTask($_POST['task_id']);
            echo json_encode(['message' => $response]);
            exit;
        });
    }
    
    elseif ($uri === 'admin/assign_needs') {
        $donationProxy->handleRequest('donations_admin', null, function() use ($BenefeciaryNeedsController) {
            $beneficiaryId = $_POST['beneficiary_id'];
            $selectedNeeds = [
                'vegetables' => $_POST['vegetables'] ?? null,
                'meat' => $_POST['meat'] ?? null,
                'money' => $_POST['money'] ?? null,
                'service' => $_POST['service'] ?? null,
            ];
            $message = $BenefeciaryNeedsController->assignNeeds($beneficiaryId, $selectedNeeds);
            echo $message;
            exit;
        });
    } elseif ($uri === 'beneficiaries/change_need_state') {
        $donationProxy->handleRequest('donations_admin', null, function() use ($BenefeciaryNeedsController) {
            error_log(json_encode($_POST));
            $response = $BenefeciaryNeedsController->changeNeedState($_POST['id'], $_POST['action']);
            header('Location: /admin/manage_needs');
            exit;
        });
    } elseif ($uri === 'beneficiaries/delete_need') {
        $donationProxy->handleRequest('donations_admin', null, function() use ($BenefeciaryNeedsController) {
            $response = $BenefeciaryNeedsController->deleteNeed($_POST['id']);
            header('Location: /admin/manage_needs');
            exit;
        });
    }
    
    elseif ($uri === 'admin/assign_role') {
        $adminProxy->handleRequest('super_admin', null, 'assignRole',$_POST['user_id'],$_POST['role'] );
        // $adminController->assignRole($_POST['user_id'], $_POST['role']);
        header('Location: /admin/users');
    }elseif ($uri === 'admin/change_donation_state') {
        $donationProxy->handleRequest('donations_admin', null, 'changeDonationState', $_POST['donation_id'], $_POST['state']);
        header('Location: /admin/donations'); // Redirect back to the donations page
        exit;
    }elseif ($uri === 'admin/delete_beneficiary') {
        $donationProxy->handleRequest('donations_admin', null, function() use ($BenefeciaryNeedsController) {
            $BenefeciaryNeedsController->deleteBeneficiary($_POST['id']);
            header('Location: /admin/list_beneficiaries'); // Redirect back to the beneficiaries list
            exit;
        });
    }elseif ($uri === 'events/register') {
            $eventId = $_POST['event_id'];
            $userId = $_SESSION['user_id'];
            try {
                $eventController->registerForEvent($userId, $eventId);
                $_SESSION['success_message'] = "You have successfully registered for the event.";
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Failed to register for the event: " . $e->getMessage();
            }
            
            header('Location: /'); // Redirect back to the homepage
            exit;
    }
    
    elseif ($uri === 'admin/mark_attendance') {
        $adminProxy->handleRequest('super_admin', null, function() use ($eventController) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $registrationId = $_POST['registration_id'] ?? null;
    
                try {
                    $eventController->markAttendance($registrationId);
                    $_SESSION['success_message'] = "Attendance marked successfully.";
                } catch (Exception $e) {
                    $_SESSION['error_message'] = $e->getMessage();
                }
    
                header('Location: /Ticketing/event_registrations');
                exit;
            }
        });
    } 
    
    else {
        echo "Invalid action.";
    }
}

