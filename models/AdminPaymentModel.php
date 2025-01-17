<?php
require_once '../core/BaseModel.php';

class AdminPaymentModel extends BaseModel {
    public function getAllPayments() {
        $stmt = $this->db->query("SELECT * FROM donations WHERE donation_type = 'online'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
