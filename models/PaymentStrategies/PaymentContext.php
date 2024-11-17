<?php
require_once 'StripePayment.php';
require_once 'PayPalPayment.php';

class PaymentContext {
    private $strategy;

    public function setPaymentStrategy(PaymentStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function executePayment($amount) {
        return $this->strategy->pay($amount); // Executes the chosen payment strategy
    }
}
?>