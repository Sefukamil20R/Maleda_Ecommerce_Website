<?php
function handleFormSubmission($fullname, $email, $message) {
    $adminEmail = 'maleda@gmail.com';  // Admin email address
    $subject = 'New Contact Form Submission';
    $headers = 'From: ' . $email . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    $body = "Full Name: $fullname\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";

    // Send the email to the admin
    if (mail($adminEmail, $subject, $body, $headers)) {
        return 'Message sent successfully!';
    } else {
        return 'Failed to send message.';
    }
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Call the callback function
    $feedback = handleFormSubmission($fullname, $email, $message);

    // Redirect to the contact page with feedback message
    header("Location: contact.php?feedback=" . urlencode($feedback));
    exit();
}
?>
