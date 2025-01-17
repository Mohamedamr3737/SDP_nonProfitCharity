<?php
require_once 'NeedDecorator.php';

class ServiceNeed extends NeedDecorator {
    private $serviceType;

    public function __construct(Need $need, $serviceType) {
        parent::__construct($need);
        $this->serviceType = $serviceType;
    }

    public function getDescription(): string {
        return $this->need->getDescription() . " Service: {$this->serviceType}";
    }

    public function getDetails(): array {
        $details = $this->need->getDetails();
        $details['service'] = $this->serviceType;
        return $details;
    }
}
