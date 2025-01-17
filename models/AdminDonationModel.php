<?php
require_once '../core/BaseModel.php';

class AdminDonationModel extends BaseModel {
    public function getAllDonations() {
        $stmt = $this->db->query("SELECT * FROM donations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateState($donationId, $state) {
        $stmt = $this->db->prepare("UPDATE donations SET state = :state WHERE id = :id");
        $stmt->execute(['state' => $state, 'id' => $donationId]);
        return $stmt->rowCount();
    }
}
