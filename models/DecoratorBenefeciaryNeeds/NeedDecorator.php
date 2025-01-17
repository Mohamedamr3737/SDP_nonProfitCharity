<?php
require_once 'Need.php';

abstract class NeedDecorator implements Need {
    protected $need;

    public function __construct(Need $need) {
        $this->need = $need;
    }

    public function getDescription(): string {
        return $this->need->getDescription();
    }

    public function getDetails(): array {
        return $this->need->getDetails();
    }
}
