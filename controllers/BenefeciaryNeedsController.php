<?php
require_once '../models/DecoratorBenefeciaryNeeds/BasicNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/VegetablesNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/MeatNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/MoneyNeed.php';
require_once '../models/DecoratorBenefeciaryNeeds/ServiceNeed.php';
require_once '../models/BeneficiaryNeedsModel.php';
require_once '../models/StateBenefeciaryNeeds/NeedBenefeciaryClass.php';


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
    // Delete a need
    public function deleteNeed($id) {
        $this->beneficiaryNeedsModel->deleteNeed($id);
        return "Need deleted successfully.";
    }

    // Change the state of a need
    public function changeNeedState($needId, $action) {
        // Fetch the current need
        $needData = $this->beneficiaryNeedsModel->getNeedById($needId);

        if (!$needData) {
            return "Need not found.";
        }

        // Create a Need instance
        $need = new NeedBenefeciaryClass($needId, $needData['state']);

        // Perform the requested action
        if ($action === 'next') {
            $need->handle();
        } elseif ($action === 'back') {
            $need->moveBack();
        } elseif ($action === 'cancel') {
            $need->setState(new CancelledState);
        }elseif ($action === 'noCancel') {
            if($need->getState()== new CancelledState){
            $need->setState(new RequestedState);
            }
        }

        // Update the state in the database
        $newState = strtolower(str_replace('State', '', (new ReflectionClass($need->getState()))->getShortName()));
        $this->beneficiaryNeedsModel->updateNeedState($needId, $newState);

        return "Need state updated successfully.";
    }
    public function deleteBeneficiary($id) {
        $this->beneficiaryNeedsModel->deleteBeneficiary($id);
        return "Beneficiary deleted successfully.";
    }
    
}
