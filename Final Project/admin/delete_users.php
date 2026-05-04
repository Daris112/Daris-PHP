<?php
include('includes/connect.php');
session_start();

// 1. Security Check
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 2. Action Check
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Delete the user from the database
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);

        // Go back to the users list with a success message
        header("Location: users.php?msg=deleted");
        exit();
    } catch (PDOException $e) {
        die("Error deleting user: " . $e->getMessage());
    }
} else {
    // If someone tries to open this file without an ID
    header("Location: users.php");
    exit();
}