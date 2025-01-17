<?php
require_once 'NeedDecorator.php';

class MoneyNeed extends NeedDecorator {
    private $amount;

    public function __construct(Need $need, $amount) {
        parent::__construct($need);
        $this->amount = $amount;
    }

    public function getDescription(): string {
        return $this->need->getDescription() . " Money: {$this->amount} EGP";
    }

    public function getDetails(): array {
        $details = $this->need->getDetails();
        $details['money'] = "{$this->amount} EGP";
        return $details;
    }
}
