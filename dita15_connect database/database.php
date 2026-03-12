<?php
$server = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($server,$username,$password);

if ($conn -> connect_error){
    die("Connection failed: " . $conn -> connection_error);

}
else{
    echo "Connected successfully";
    $sql = "CREATE DATABASE Prizren";
    if($conn-> query($sql) === TRUE){
        echo "Database created successfully";
    }
    else{
        echo "Error creating database:". $conn->error;
    }
}
$conn->close();
?>