<?php
include('includes/connect.php');
session_start();

// Security: Check if user is logged in using email (since 'username' column doesn't exist)
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // targeting the 'products' table from your schema
        $query = "DELETE FROM products WHERE id = :id";
        
        // Changed $conn to $pdo to match your connection file
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        
        header("Location: inventory.php?msg=deleted");
        exit();
        
    } catch (PDOException $e) {
        // Handle cases where product might be linked to existing orders[cite: 1]
        header("Location: inventory.php?error=cannot_delete_linked_product");
        exit();
    }
} else {
    header("Location: inventory.php");
    exit();
}
?>