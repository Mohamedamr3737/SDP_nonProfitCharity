<?php
require_once 'PaymentStrategy.php';

class StripePayment implements PaymentStrategy {
    public function pay($amount) {
        // Simulate Stripe payment processing
        $message = "Processing a payment of $" . $amount . " via Stripe.";
        return ['status' => true, 'message' => $message]; // Return both status and message
    }
}
?>