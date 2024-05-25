<?php
// Database connection
//$mysqli = new mysqli("your_host", "your_username", "your_password", "your_database");
$mysqli = new mysqli("localhost", "root", "", "test");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>