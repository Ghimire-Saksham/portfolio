<?php
session_start();
include('db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_name'], $_POST['email'], $_POST['phone'], $_POST['message'])) {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $contact = $_POST['phone'];
    $message = $_POST['message'];
    $sql = "INSERT INTO queries (user_name, email, contact, message, created_at)
            VALUES ('$user_name', '$email', '$contact', '$message', NOW())";
    $run = $conn->query($sql);
  
    if ($run) {
        echo "<script>alert('We received your message successfully!'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error while receiving data'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid Request'); window.location.href='index.php';</script>";
    exit;
}
