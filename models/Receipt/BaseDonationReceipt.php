<?php
// File: models/Receipt/BaseDonationReceipt.php
require_once 'Receipt.php';

class BaseDonationReceipt implements Receipt {
    private $donorName;
    private $donationAmount;
    private $donatedProduct;
    private $donatedService;



    public function __construct($donorName, $donationAmount, $donatedProduct, $donatedService) {
        $this->donorName = $donorName;
        $this->donationAmount = $donationAmount?$donationAmount:0;
        $this->donatedProduct = $donatedProduct?$donatedProduct:"";
        $this->donatedService = $donatedService?$donatedService:"";
    }

    public function getDescription(): string {
        $receipt = "Donation Receipt for {$this->donorName}.";

        // Add amount if it's not null
        if ($this->donationAmount > 0) {
            $receipt .= " Amount: {$this->donationAmount}";
        }
    
        // Add product if it's not null
        if ($this->donatedProduct !="") {
            $receipt .= " Product: {$this->donatedProduct}";
        }
    
        // Add service if it's not null
        if ($this->donatedService != "") {
            $receipt .= " Service: {$this->donatedService}";
        }
    
        return $receipt;
    }

    public function getTotalAmount(): float {
        return $this->donationAmount;
    }
}

?>