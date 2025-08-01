<?php
$conn = new mysqli("localhost", "ruax7678_root", "hilman1234#", "ruax7678_chat_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>