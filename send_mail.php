<?php
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    $mail = new PHPMailer(true);

    try {
        // Gmail SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'childress721@gmail.com';  // 🔒 Your Gmail
        $mail->Password = 'fred jgul cgsm cjky';     // 🔒 App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender & Recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('childress721@gmail.com', 'Tanner Childress');
        $mail->addReplyTo($email, $name);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body = "<strong>Name:</strong> $name<br>
                       <strong>Email:</strong> $email<br><br>
                       <strong>Message:</strong><br>$message";
        $mail->AltBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Send email
        $mail->send();

        // ✅ Save message copy
        $saveDir = __DIR__ . '/messages';
        if (!is_dir($saveDir)) {
            mkdir($saveDir, 0755, true);
        }

        $timestamp = date("Y-m-d_H-i-s");
        $filename = $saveDir . "/message_" . $timestamp . ".txt";
        $content = "Time: " . date("Y-m-d H:i:s") . "\n"
                 . "Name: $name\n"
                 . "Email: $email\n\n"
                 . "Message:\n$message\n";

        file_put_contents($filename, $content);

        // Redirect with success message
        header("Location: contact.php?success=1");
        exit;

    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");

        // Try saving even if email fails
        $saveDir = __DIR__ . '/messages';
        if (!is_dir($saveDir)) {
            mkdir($saveDir, 0755, true);
        }
        $timestamp = date("Y-m-d_H-i-s");
        $filename = $saveDir . "/failed_message_" . $timestamp . ".txt";
        $content = "FAILED EMAIL\n\n" .
                   "Error: {$mail->ErrorInfo}\n\n" .
                   "Name: $name\n" .
                   "Email: $email\n" .
                   "Message:\n$message\n";
        file_put_contents($filename, $content);

        header("Location: contact.php?error=1");
        exit;
    }
}
?>
