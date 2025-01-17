<?php
require_once 'Need.php';

class BasicNeed implements Need {
    public function getDescription(): string {
        return "Needs assigned:";
    }

    public function getDetails(): array {
        return [];
    }
}
