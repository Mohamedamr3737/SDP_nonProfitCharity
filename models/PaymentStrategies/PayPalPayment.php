<?php
require_once 'PaymentStrategy.php';

class PayPalPayment implements PaymentStrategy {
    public function pay($amount) {
        // Simulate PayPal payment processing
        $message = "Processing a payment of $" . $amount . " via PayPal.";
        return ['status' => true, 'message' => $message]; // Return both status and message
    }
}

?>