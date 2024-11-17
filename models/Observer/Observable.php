<?php
require_once __DIR__ . '/Observer.php';
interface Observable {
    public function addObserver(Observer $observer);
    public function removeObserver(Observer $observer);
    public function notifyObservers($data);
}
