<?php

require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ .'/../../Donation.php';
class OnlineDonation extends Donation {
    private $donorName;
    private $amount;
    private $donorId;


    public function __construct($donorId, $donorName, $amount) {
        $this->donorId = $donorId;
        $this->donorName = $donorName;
        $this->amount = $amount;
    }

    public function process() {
        return "Processing an online money donation.";
    }

    public function save() {
        $this->notifyObservers($this->donorName);
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO donations (donorId,donor_name, donation_type, amount) VALUES (:donorId, :donor_name, 'online', :amount)");
        $stmt->execute(['donorId'=>$this->donorId,'donor_name' => $this->donorName, 'amount' => $this->amount]);
        return "Online donation saved.";
    }
}

?>