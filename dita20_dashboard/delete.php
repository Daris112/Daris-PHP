<?php
include('includes/connect.php');
session_start();

// Security: Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['id' => $id]);
    
    header("Location: inventory.php?msg=deleted");
    exit();
}
?>