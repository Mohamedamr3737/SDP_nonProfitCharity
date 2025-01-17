<?php
require  __DIR__ . '/../../vendor/autoload.php';
require  __DIR__ . '/EmailServiceInterface.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class EmailServiceAdapter implements EmailServiceInterface {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        // Configure SMTP settings
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'mohamedamr2002a@gmail.com';
        $this->mailer->Password = 'hfhe yyju nfdm rfyd'; // Use a valid app password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
    }

    public function setRecipient($email, $name) {
        $this->mailer->addAddress($email, $name);
    }

    public function setSender($email, $name) {
        $this->mailer->setFrom($email, $name);
    }

    public function setSubject($subject) {
        $this->mailer->Subject = $subject;
    }

    public function setMessage($body) {
        $this->mailer->isHTML(true);
        $this->mailer->Body = $body;
    }

    public function send() {
        try {
            $this->mailer->send();
            error_log("Email successfully sent.");
        } catch (Exception $e) {
            error_log("Email could not be sent. Mailer Error: {$this->mailer->ErrorInfo}");
        }
    }
}
