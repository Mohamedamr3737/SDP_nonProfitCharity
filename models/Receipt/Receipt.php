<?php
// File: models/Receipt/Receipt.php
interface Receipt {
    public function getDescription(): string;
    public function getTotalAmount(): float;
    
}

?>