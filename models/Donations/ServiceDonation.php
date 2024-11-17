<?php
// models/DonationStrategies/ServiceDonation.php

require_once '../config/Database.php';

// File: models/ServiceDonation.php
class ServiceDonation extends Donation {
    private $donorName;
    private $serviceDescription;

    private $donorId;

    public function __construct($donorId, $donorName, $serviceDescription) {
        $this->donorId = $donorId;
        $this->donorName = $donorName;
        $this->serviceDescription = $serviceDescription;
    }

    public function process() {
        return "Processing a service donation.";
    }

    public function save() {
        $this->notifyObservers($this->donorName);
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO donations (donorId, donor_name, donation_type, service_description) VALUES (:donorId, :donor_name, 'service', :service_description)");
        $stmt->execute([
            'donorId'=> $this->donorId,
            'donor_name' => $this->donorName,
            'service_description' => $this->serviceDescription
        ]);
        return "Service donation saved.";
    }
}

?>