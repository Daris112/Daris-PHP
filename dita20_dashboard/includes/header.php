<?php
// 1. Start the session to track the user
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Security: Redirect to login if the user is not authenticated
// This allows the user to see login.php, but nothing else.
$currentPage = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['username']) && $currentPage != 'login.php') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dita Admin | Dashboard</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex min-h-screen overflow-x-hidden">

    <?php if ($currentPage != 'login.php') { include('sidebar.php'); } ?>

    <div class="flex-1 flex flex-col min-w-0">
        
        <?php if ($currentPage != 'login.php') { include('navbar.php'); } ?>

        <main class="p-6 lg:p-10">