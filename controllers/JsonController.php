<?php
    // Helper method to send JSON response
    function jsonResponse($data, $statusCode = 200) {
        ob_clean(); // Clear the buffer to remove any unexpected output
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
?>