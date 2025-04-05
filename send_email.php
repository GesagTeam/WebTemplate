<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

// Capture form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    die("All fields are required!");
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Use an App Password instead of your actual password!
    $mail->Username = "gesagservices@gmail.com";
    $mail->Password = "cabd idvh obtl sime";

    // Set sender as your own email to avoid SMTP issues
    $mail->setFrom("gesagservices@gmail.com", "Website Contact Form");

    // Set Reply-To so you can reply directly to the sender
    $mail->addReplyTo($email, $name);

    // Recipient
    $mail->addAddress("gesagservices@gmail.com", "Mohimeen");

    // Email content
    $mail->Subject = "New Message from Website - " . $subject;
    $mail->Body = "You have received a new message from your website contact form:\n\n" .
                  "👤 Name: $name\n" .
                  "📧 Email: $email\n" .
                  "📌 Subject: $subject\n\n" .
                  "💬 Message:\n$message";

    $mail->SMTPDebug = 0; // Set to 2 for debugging, 0 for production
    $mail->send();

    // Redirect after successful submission
    header("Location: thank-you.html");
    exit();
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}

?>
