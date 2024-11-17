<?php
require_once __DIR__ . '/Observer.php';
require  __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailNotification implements Observer {
    public function update($data) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['donation_message'] = "Thank you for your donation, " . htmlspecialchars($data) . "! from Observer";

        $mail = new PHPMailer(true);

        try {
           
            $mail->SMTPDebug = 2; 
            $mail->Debugoutput = function($str, $level) { error_log("SMTP Debug: $str"); };

            // Gmail SMTP server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mohamedamr2002a@gmail.com'; 
            $mail->Password = 'cajx ywnd posh tcuz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('mohamedamr2002a@gmail.com', 'From the observer');
            if(isset($_SESSION['user_email']))
            $mail->addAddress($_SESSION['user_email']); // Recipient email address
            else
            throw new Exception('not logged in');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Donation Received';
            $mail->Body    = "Thank you for your donation, " . htmlspecialchars($data) . "!";

            $mail->send();
            error_log("Email successfully sent via Gmail.");
        } catch (Exception $e) {
            error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
