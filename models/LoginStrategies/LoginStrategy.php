<?php

// File: models/LoginStrategies/LoginStrategy.php
interface LoginStrategy {
    public function login($username, $password);
}

?>