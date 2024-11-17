<?php
session_start(); // Start the session if not already started

// Destroy all session data
$_SESSION = []; // Clear session array
session_unset(); // Unset session variables
session_destroy(); // Destroy the session

// Redirect to the home page or login page
header("Location: index.php?showLogin=true");
exit();
?>
