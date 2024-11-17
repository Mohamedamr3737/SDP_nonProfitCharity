<?php

class LoginContext {
    private $strategy;

    public function setStrategy(LoginStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function executeLogin($email, $password) {
        return $this->strategy->login($email, $password);
    }
}

?>