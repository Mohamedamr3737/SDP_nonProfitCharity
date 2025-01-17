<?php
// models/DonationStrategies/ProductDonation.php

require_once '../config/Database.php';

class ProductDonation extends Donation {
    private $donorName;
    private $productName;
    private $donorId;
    private $donorEmail;
    
    public function __construct($donorId, $donorName, $productName, $donorEmail) {
        $this->donorId = $donorId;
        $this->donorName = $donorName;
        $this->productName = $productName;
        $this->donorEmail = $donorEmail;
    }

    public function process() {
        return "Processing a product donation.";
    }

    public function save() {
        $observerData = [
            'recipient_email' => $this->donorEmail,
            'recipient_name' => $this->donorName,
            'subject' => 'Thank You for Your Donation',
            'message' => "Dear {$this->donorName},\n\nWe have received your generous donation of product {$this->productName}. Thank you for supporting our cause waiting for you!"
        ];
        $this->notifyObservers($observerData);
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO donations (donorId, donor_name, donation_type, product_name) VALUES (:donorId, :donor_name, 'product', :product_name)");
        $stmt->execute(['donorId'=>$this->donorId,'donor_name' => $this->donorName, 'product_name' => $this->productName]);
        return "Product donation saved.";
    }
}
?>
