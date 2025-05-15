<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path if you’re not using Composer

function send_link($destination, $sendername, $message, $subject)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = '@gmail.com'; // Replace with your SMTP username
        $mail->Password = 'rysk xkqt jyuu frn'; // Replace with your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Or use PHPMailer::ENCRYPTION_SMTPS
        $mail->Port = 587; // Or 465 if using SMTPS

        // Recipients
        $mail->setFrom('s.sayeedulalam786@gmail.com', $sendername);
         $mail->addAddress($destination);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "<p>" . nl2br(htmlspecialchars($message)) . "</p><p>Best regards,<br>$sendername</p>";
        $mail->AltBody = $message . "\n\nBest regards,\n$sendername";

        $mail->send();
        // Optional: return success or log
    } catch (Exception $e) {
        // Optional: handle errors
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}
?>

