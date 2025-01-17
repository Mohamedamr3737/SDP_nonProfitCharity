<?php
require_once __DIR__ . '/../models/AdminPaymentModel.php';

class AdminPaymentController {
    private $paymentModel;

    public function __construct() {
        $this->paymentModel = new AdminPaymentModel(Database::getInstance()->getConnection());
    }

    public function viewPayments() {
        return $this->paymentModel->getAllPayments();
    }
}
