<?php
require_once __DIR__ . '/../models/AdminDonationModel.php';
require_once __DIR__ . '/../models/Proxy/AccessControlProxy.php';

class AdminDonationController {
    private $donationModel;

    public function __construct() {
        $this->donationModel = new AdminDonationModel(Database::getInstance()->getConnection());
    }

    public function viewDonations() {
        return $this->donationModel->getAllDonations();
    }

    public function changeDonationState($donationId, $state) {
        return $this->donationModel->updateState($donationId, $state);
    }
}
