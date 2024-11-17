<?php
// File: models/PaymentStrategies/CheckPayment.php
require_once 'PaymentStrategy.php';

class CheckPayment implements PaymentStrategy {
    public function pay($amount) {
        // Simulate a successful check payment without an upload

        $message = "Processing a check payment of $" . $amount . ". No image upload required.";
        return ['status' => true, 'message' => $message]; // Return both status and message
    }
}

?>