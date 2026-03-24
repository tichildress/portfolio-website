<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

function clean_input($value) {
    return trim(stripslashes($value));
}

$name = clean_input($_POST["name"] ?? "");
$company = clean_input($_POST["company"] ?? "");
$email = clean_input($_POST["email"] ?? "");
$phone = clean_input($_POST["phone"] ?? "");
$subject = clean_input($_POST["subject"] ?? "");
$message = clean_input($_POST["message"] ?? "");

if (
    $name === "" ||
    $email === "" ||
    $subject === "" ||
    $message === ""
) {
    die("Please fill in all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Please enter a valid email address.");
}

$to = "childress721@gmail.com";
$email_subject = "Portfolio Contact: " . $subject;

$email_body  = "You received a new message from your portfolio contact form.\n\n";
$email_body .= "Name: " . $name . "\n";
$email_body .= "Company: " . $company . "\n";
$email_body .= "Email: " . $email . "\n";
$email_body .= "Phone: " . $phone . "\n\n";
$email_body .= "Message:\n" . $message . "\n";

$headers  = "From: noreply@" . $_SERVER["SERVER_NAME"] . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $email_subject, $email_body, $headers)) {
    header("Location: index.html?sent=1");
    exit;
} else {
    echo "Sorry, your message could not be sent. Please try again later.";
}
?>