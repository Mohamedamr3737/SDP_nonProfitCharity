<?php
require_once '../models/DecoratorBenefeciaryNeeds/BasicNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/VegetablesNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/MeatNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/MoneyNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/ServiceNeed.php';
require_once '../models/BeneficiaryNeedsModel.php';


class BenefeciaryNeedsController {
    private $beneficiaryNeedsModel;

    public function __construct() {
        $this->beneficiaryNeedsModel = new BeneficiaryNeedsModel(Database::getInstance()->getConnection());
    }

    public function assignNeeds($beneficiaryId, $selectedNeeds) {
        $need = new BasicNeed();

        // Apply decorators based on selected needs
        foreach ($selectedNeeds as $key => $value) {
            if ($key === 'vegetables' && !empty($value)) {
                $need = new VegetablesNeed($need, $value);
            }
            if ($key === 'meat' && !empty($value)) {
                $need = new MeatNeed($need, $value);
            }
            if ($key === 'money' && !empty($value)) {
                $need = new MoneyNeed($need, $value);
            }
            if ($key === 'service' && !empty($value)) {
                $need = new ServiceNeed($need, $value);
            }
        }

        // Save the assigned needs using the model
        $this->beneficiaryNeedsModel->saveNeeds($beneficiaryId, $need->getDetails());

        return "Needs assigned successfully: " . $need->getDescription();
    }

    public function getBeneficiaryNeeds($beneficiaryId) {
        return $this->beneficiaryNeedsModel->getNeedsByBeneficiary($beneficiaryId);
    }

    public function getAllBeneficiaryNeeds() {
        return $this->beneficiaryNeedsModel->getAllNeeds();
    }
    public function getAllBeneficiaries() {
        return $this->beneficiaryNeedsModel->getAllBeneficiaries();
    }
}
