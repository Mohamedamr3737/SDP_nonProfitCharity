<?php
require_once __DIR__ . '/Observer.php';
require_once __DIR__ . '/../AdapterEmailInterface/EmailServiceAdapter.php';

class EmailNotification implements Observer {
    private $emailService;

    public function __construct() {
        $this->emailService = new EmailServiceAdapter();
    }

    public function update($data) {
        $senderEmail = $data['sender_email'] ?? 'mohamedamr2002a@gmail.com';
        $senderName = $data['sender_name'] ?? 'Observer Adapter System';
        $recipientEmail = $data['recipient_email'] ?? null;
        $recipientName = $data['recipient_name'] ?? 'User';
        $subject = $data['subject'] ?? 'Notification';
        $message = $data['message'] ?? 'No message provided.';

        if (!$recipientEmail) {
            error_log("Recipient email is missing. Cannot send email.");
            return;
        }

        // Set email details
        $this->emailService->setSender($senderEmail, $senderName);
        $this->emailService->setRecipient($recipientEmail, $recipientName);
        $this->emailService->setSubject($subject);
        $this->emailService->setMessage($message);

        // Send the email
        $this->emailService->send();
    }
}

