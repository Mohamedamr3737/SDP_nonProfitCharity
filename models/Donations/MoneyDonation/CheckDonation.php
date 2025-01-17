<?php
// models/DonationStrategies/MoneyDonation/CheckDonation.php

require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ .'/../../Donation.php';
class CheckDonation extends Donation {
    private $donorName;
    private $amount;
    private $donorId;
    private $donorEmail;



    public function __construct($donorId, $donorName, $amount, $donorEmail) {
        $this->donorId = $donorId;
        $this->donorName = $donorName;
        $this->amount = $amount;
        $this->donorEmail = $donorEmail;
    }

    public function process() {
        return "Processing a check money donation.";
    }

    public function save() {
        $observerData = [
            'recipient_email' => $this->donorEmail,
            'recipient_name' => $this->donorName,
            'subject' => 'Thank You for Your Donation',
            'message' => "Dear {$this->donorName},\n\nWe have received your generous donation of $ {$this->amount}. Thank you for supporting our cause!"
        ];
        $this->notifyObservers($observerData);
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO donations (donorId, donor_name, donation_type, amount) VALUES (:donorId, :donor_name, 'check', :amount)");
        $stmt->execute(['donorId' => $this->donorId, 'donor_name' => $this->donorName, 'amount' => $this->amount]);        
        return "Check donation saved.";
    }
}
?>
