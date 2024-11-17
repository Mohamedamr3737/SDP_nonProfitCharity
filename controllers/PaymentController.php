<?php
// File: controllers/PaymentController.php
require_once '../models/PaymentStrategies/PaymentContext.php';
require_once '../models/PaymentStrategies/StripePayment.php';
require_once '../models/PaymentStrategies/PayPalPayment.php';
require_once '../models/PaymentStrategies/CheckPayment.php';

class PaymentController {
    public function processPayment($data) {
        $donationType = $data['donationType'];
        $paymentMethod = $data['paymentMethod']; // 'stripe', 'paypal', or 'check'
        $amount = $data['amount'];

        $paymentContext = new PaymentContext();

        // Set the appropriate payment strategy based on payment method
        if ($donationType === 'online') {
            if ($paymentMethod === 'stripe') {
                $paymentContext->setPaymentStrategy(new StripePayment());
            } elseif ($paymentMethod === 'paypal') {
                $paymentContext->setPaymentStrategy(new PayPalPayment());
            }
        } elseif ($donationType === 'check') {
            $paymentContext->setPaymentStrategy(new CheckPayment());
        } else {
            throw new Exception("Invalid donation type or payment method.");
        }

        // Execute the payment and return the result
        return $paymentContext->executePayment($amount);
    }
}


?>