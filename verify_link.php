<?php
include('conn.php');
$token = $_GET['token'];

$stmt = $mysqli->prepare("SELECT email, created_at FROM email_verification WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($email, $created_at);
$stmt->fetch();

if ($stmt->num_rows > 0) {
    $current_time = new DateTime();
    $creation_time = new DateTime($created_at);
    $interval = $current_time->diff($creation_time);

    if ($interval->i < 30) { // Check if the token is within the 30-minute window
        echo "Email verified successfully.";
        // Here you can mark the email as verified in your users table or perform any necessary action.
    } else {
        echo "The verification link has expired.";
    }
} else {
    echo "Invalid verification link.";
}

$stmt->close();
$mysqli->close();
?>
