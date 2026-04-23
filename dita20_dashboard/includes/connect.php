<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prizren"; // Make sure this is exactly what you named it in phpMyAdmin

try {
    // FIX: Removed the spaces around "host="
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>