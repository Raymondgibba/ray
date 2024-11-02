<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize form data
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve and sanitize form data
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $class = sanitize_input($_POST['class']);
    $why_join = sanitize_input($_POST['why_join']);

    // Validate the form inputs (check if fields are empty)
    if (empty($name) || empty($email) || empty($class) || empty($why_join)) {
        echo "<h2>All fields are required. Please go back and fill out the form.</h2>";
        exit;
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h2>Invalid email format. Please go back and correct your email.</h2>";
        exit;
    }

    // Set recipient email
    $to = "rgibba17@gmail.com"; // Replace with your email

    // Email subject
    $subject = "New Science Club Application from $name";

    // Email body
    $message = "
    Name: $name\n
    Email: $email\n
    Class: $class\n
    Why Join: $why_join
    ";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Try to send the email
    if (mail($to, $subject, $message, $headers)) {
        // Success message
        echo "<h2>Thank you, your application has been submitted successfully!</h2>";
    } else {
        // Error message
        echo "<h2>Sorry, there was an error submitting your application. Please try again later.</h2>";
    }
}
?>
