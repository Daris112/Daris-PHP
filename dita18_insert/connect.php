<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO ("mysql:host = $servername;dbname=daris_products",$username,$password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

}catch(PDOException $e){
    echo "Connected failed: ". $e->getMessage();
}
?>