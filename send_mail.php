<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data safely
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        // Redirect back with an error message if any field is empty
        header("Location: index.html?error=Please+fill+in+all+fields");
        exit;
    }

    // Email settings
    $to      = "johnson@writesec.in"; // Updated email address
    $subject = "New message from your website contact form";
    $body    = "You have received a new message from your website contact form.\n\n" .
               "Name: $name\n" .
               "Email: $email\n" .
               "Message:\n$message\n";
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect to a thank-you page on success
        header("Location: thank_you.html");
    } else {
        // Redirect back with an error message on failure
        header("Location: index.html?error=Message+could+not+be+sent");
    }
    exit;
}
?>
