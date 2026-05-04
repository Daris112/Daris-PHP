<?php
// 1. DATABASE AND LOGIC FIRST
include('includes/connect.php');

// Start session to check the currently logged-in user
session_start();

if (isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];
    $current_admin_id = $_SESSION['user_id'] ?? null;

    // Prevent deleting yourself for safety
    if ($id_to_delete == $current_admin_id) {
        header("Location: users.php?error=self_delete");
        exit();
    }

    try {
        // Prepare the delete statement targeting the 'users' table
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id_to_delete]);

        // Redirect back to the users list with a success message
        header("Location: users.php?msg=user_deleted");
        exit();

    } catch (PDOException $e) {
        // Redirect with an error if there's a foreign key constraint (e.g., user has orders)
        header("Location: users.php?error=db_error");
        exit();
    }
} else {
    // If no ID is provided, just go back to the list
    header("Location: users.php");
    exit();
}