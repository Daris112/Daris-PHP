<?php

    $host = "localhost";
    $db = "prizren";
    $user = "root";
    $pass = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $sql = "CREATE TABLE users (
            id INT(6) NOT NULL AUTO_INCREMENT,
            username VARCHAR(30) NOT NULL,
            password VARCHAR(100) NOT NULL,
            email VARCHAR(50) NOT NULL,
            PRIMARY KEY(id)
             )";
        $pdo->exec($sql);

    echo "Table created successfully";

    } catch(Exception $e){
    echo "Error creating table: " . $e->getMessage();

    }

?>