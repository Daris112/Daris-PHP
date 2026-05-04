<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothingstore_db"; // Change this to your database name

try {
    // Removed spaces around 'host=' and 'dbname='
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Start the session here so it's available on every page
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>