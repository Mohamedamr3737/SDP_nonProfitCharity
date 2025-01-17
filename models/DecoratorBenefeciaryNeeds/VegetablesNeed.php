<?php
require_once 'NeedDecorator.php';

class VegetablesNeed extends NeedDecorator {
    private $quantity;

    public function __construct(Need $need, $quantity) {
        parent::__construct($need);
        $this->quantity = $quantity;
    }

    public function getDescription(): string {
        return $this->need->getDescription() . " Vegetables: {$this->quantity} kg";
    }

    public function getDetails(): array {
        $details = $this->need->getDetails();
        $details['vegetables'] = "{$this->quantity} kg";
        return $details;
    }
}
