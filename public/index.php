<?php
// public/index.php

require '../config/Database.php';
require '../controllers/AuthController.php';
require '../controllers/DonationController.php';

$authController = new AuthController();
$donationController = new DonationController();

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
        
    }
    else {
        echo "Invalid action.";
    }
}

