<?php
/**
 * Dita Admin - Unified Security & Header
 * This file protects the admin panel and initializes the layout.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);

// 1. Security Guard
// If the user is NOT logged in and is NOT already on the login page:
if (!isset($_SESSION['email'])) {
    // If we are inside the /admin/ folder, we go UP one level to find the root login
    header("Location: ../login.php"); 
    exit();
}

// 2. Database Connection
// This ensures $pdo is available for your dashboard stats
require_once('connect.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dita Admin | Dashboard</title>
    
    <!-- Tailwind & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom scrollbar for a modern look */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-50 flex min-h-screen overflow-x-hidden">

    <!-- Include Sidebar -->
    <?php include('sidebar.php'); ?>

    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Include Navbar -->
        <?php include('navbar.php'); ?>

        <main class="p-6 lg:p-10">