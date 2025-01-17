<?php

require_once __DIR__. '/../core/BaseModel.php';

class BeneficiaryNeedsModel extends BaseModel {
    public function saveNeeds($beneficiaryId, $needs) {
        $stmt = $this->db->prepare(
            "INSERT INTO beneficiary_needs (beneficiary_id, description) VALUES (:beneficiary_id, :description)"
        );
        $stmt->execute([
            'beneficiary_id' => $beneficiaryId,
            'description' => json_encode($needs), // Encode needs as JSON
        ]);
    }

    public function getNeedsByBeneficiary($beneficiaryId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM beneficiary_needs WHERE beneficiary_id = :beneficiary_id"
        );
        $stmt->execute(['beneficiary_id' => $beneficiaryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllNeeds() {
        $stmt = $this->db->query("SELECT * FROM beneficiary_needs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllBeneficiaries() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE type = 'beneficiary'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
