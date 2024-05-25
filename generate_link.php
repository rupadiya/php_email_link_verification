<?php
include('conn.php');
function generateToken() {
    return bin2hex(random_bytes(16)); // Generates a 32-character token
}

function sendVerificationEmail($email, $token) {
	
    $verificationLink = "http://localhost/email_link_verification/verify_link.php?token=" . $token;
    $subject = "Email Verification";
    $message = "Click this link to verify your email: " . $verificationLink;
	
	echo $verificationLink;
	
    $headers = "From: no-reply@yourdomain.com";
/*
    if (mail($email, $subject, $message, $headers)) {
        echo "Verification email sent.";
    } else {
        echo "Failed to send verification email.";
    }
	*/
}

//$email = $_POST['email'];
$email = 'rupadiyabipin@gmail.com';
$token = generateToken();

// Store the email and token in the database
$stmt = $mysqli->prepare("INSERT INTO email_verification (email, token) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $token);
$stmt->execute();

sendVerificationEmail($email, $token);
$stmt->close();
$mysqli->close();
?>
