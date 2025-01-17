<?php
// models/DonationStrategies/ServiceDonation.php

require_once '../config/Database.php';

// File: models/ServiceDonation.php
class ServiceDonation extends Donation {
    private $donorName;
    private $serviceDescription;

    private $donorId;
    private $donorEmail;

    public function __construct($donorId, $donorName, $serviceDescription, $donorEmail) {
        $this->donorId = $donorId;
        $this->donorName = $donorName;
        $this->serviceDescription = $serviceDescription;
        $this->donorEmail = $donorEmail;
    }

    public function process() {
        return "Processing a service donation.";
    }

    public function save() {
        $observerData = [
            'recipient_email' => $this->donorEmail,
            'recipient_name' => $this->donorName,
            'subject' => 'Thank You for Your Donation',
            'message' => "Dear {$this->donorName},\n\nWe have received your request to generous donation of service {$this->serviceDescription}. Thank you for supporting our cause waiting for you!"
        ];
        $this->notifyObservers($observerData);
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