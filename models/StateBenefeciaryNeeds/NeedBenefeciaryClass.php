<?php

require_once 'RequestedState.php';
require_once 'ApprovedState.php';
require_once 'FulfilledState.php';
require_once 'CancelledState.php';

class NeedBenefeciaryClass {
    private $id;
    private $state;

    public function __construct($id, $initialState = 'requested') {
        $this->id = $id;

        // Set the initial state based on the database value
        switch ($initialState) {
            case 'approved':
                $this->state = new ApprovedState();
                break;
            case 'fulfilled':
                $this->state = new FulfilledState();
                break;
            case 'cancelled':
                $this->state = new CancelledState();
                break;
            default:
                $this->state = new RequestedState();
                break;
        }
    }

    public function setState(NeedState $state) {
        $this->state = $state;
        $this->updateStateInDatabase();
    }

    public function getState() {
        return $this->state;
    }

    public function handle() {
        $this->state->handle($this);
    }

    public function moveBack() {
        $this->state->moveBack($this);
    }

    private function updateStateInDatabase() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE beneficiary_needs SET state = :state WHERE id = :id");
        $stmt->execute([
            'state' => strtolower(str_replace('State', '', (new ReflectionClass($this->state))->getShortName())),
            'id' => $this->id,
        ]);
    }
}
