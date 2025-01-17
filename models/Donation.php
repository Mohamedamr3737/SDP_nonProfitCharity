<?php
require_once __DIR__ . '/Observer/Observable.php';
abstract class Donation implements Observable {
    private $observers = [];
    private $donationData;

    public function addObserver(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function removeObserver(Observer $observer) {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notifyObservers($data) {
        foreach ($this->observers as $observer) {
            $observer->update([
                'recipient_email' => $data['recipient_email'],
                'recipient_name' => $data['recipient_name'],
                'subject' => $data['subject'],
                'message' => $data['message'],
            ]);
        }
    }

    public abstract function process();
    public abstract function save();
}

?>