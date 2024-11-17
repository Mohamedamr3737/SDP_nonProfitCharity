<?php

// File: models/Receipt/TaxDecorator.php
require_once 'Receipt.php';
require_once 'Decorator.php';
class TaxDecorator extends Decorator {
    private $taxRate;

    public function __construct(Receipt $receipt, $taxRate=null) {
        $this->receipt= $receipt;
        $this->taxRate = $taxRate;
    }

    public function getDescription(): string {
        return $this->receipt->getDescription() . " (including tax)";
    }

    public function getTotalAmount(): float {
        // Calculate the tax amount and add it to the original total
        $taxAmount = $this->receipt->getTotalAmount() * $this->taxRate;
        return $this->receipt->getTotalAmount() + $taxAmount;
    }
}

?>