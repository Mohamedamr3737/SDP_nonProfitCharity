<?php
// models/DonationStrategies/ProductDonation.php

require_once '../config/Database.php';

class ProductDonation extends Donation {
    private $donorName;
    private $productName;
    private $donorId;
    
    public function __construct($donorId, $donorName, $productName) {
        $this->donorId = $donorId;
        $this->donorName = $donorName;
        $this->productName = $productName;
    }

    public function process() {
        return "Processing a product donation.";
    }

    public function save() {
        $this->notifyObservers($this->donorName);
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO donations (donorId, donor_name, donation_type, product_name) VALUES (:donorId, :donor_name, 'product', :product_name)");
        $stmt->execute(['donorId'=>$this->donorId,'donor_name' => $this->donorName, 'product_name' => $this->productName]);
        return "Product donation saved.";
    }
}
?>
