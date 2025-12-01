<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../../phpmailer/PHPMailer.php";
require __DIR__ . "/../../phpmailer/SMTP.php";
require __DIR__ . "/../../phpmailer/Exception.php";

function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);

    try {
        // Gmail SMTP
        $mail->isSMTP();
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = "vincejollografel@gmail.com"; 
        $mail->Password   = "ieds wwxy zpmk dooz"; 
        $mail->SMTPSecure = "ssl";
        $mail->Port       = 465;

        $mail->setFrom("YOUR_GMAIL@gmail.com", "Saving Goal App");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Your OTP Code";
        $mail->Body    = "<h2>Your OTP Code</h2><h1>$otp</h1><p>Use this to verify your account.</p>";

        return $mail->send();

    } catch (Exception $e) {
        return false;
    }
}
