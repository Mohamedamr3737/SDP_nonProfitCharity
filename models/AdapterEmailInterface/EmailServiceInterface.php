<?php
interface EmailServiceInterface {
    public function setRecipient($email, $name);
    public function setSender($email, $name);
    public function setSubject($subject);
    public function setMessage($body);
    public function send();
}
