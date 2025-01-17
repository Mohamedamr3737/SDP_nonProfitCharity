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
        // Get a specific need by ID
        public function getNeedById($id) {
            $stmt = $this->db->prepare("SELECT * FROM beneficiary_needs WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        // Update the state of a need
        public function updateNeedState($id, $newState) {
            $stmt = $this->db->prepare("UPDATE beneficiary_needs SET state = :state WHERE id = :id");
            $stmt->execute([
                'state' => $newState,
                'id' => $id,
            ]);
        }
        public function deleteNeed($id) {
            $stmt = $this->db->prepare("DELETE FROM beneficiary_needs WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }
        public function deleteBeneficiary($id) {
            // Delete the beneficiary's needs first to maintain database integrity
            $stmt = $this->db->prepare("DELETE FROM beneficiary_needs WHERE beneficiary_id = :id");
            $stmt->execute(['id' => $id]);
        
            // Delete the beneficiary from the users table
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id AND type = 'beneficiary'");
            $stmt->execute(['id' => $id]);
        }
        
}
