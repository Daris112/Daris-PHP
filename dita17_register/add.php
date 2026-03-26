<?php

include_once('connect.php');

$errors = array();

if (isset($_POST['submit'])) {
    $username         = $_POST['username']         ?? '';
    $password         = $_POST['password']         ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $email            = $_POST['email']            ?? '';
    $gender           = $_POST['gender']           ?? '';
    $birthdate        = $_POST['birthdate']        ?? '';

    // Username validation
    if (empty($username)) {
        array_push($errors, "Username is required");
    } elseif (!preg_match("/^[a-zA-ZëË ]*$/", $username)) {
        array_push($errors, "Username can only contain letters and spaces");
    }

    // Email validation
    if (empty($email)) {
        array_push($errors, "Email is required");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format");
    }

    // Password validation
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Confirm password
    if ($password !== $confirmPassword) {
        array_push($errors, "Passwords do not match");
    }

   // Only check DB if no validation errors so far
if (count($errors) == 0) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->execute([':username' => $username, ':email' => $email]);

    if ($stmt->rowCount() > 0) {
        array_push($errors, "User with this username or email already exists");
    }
}

    // If no errors -> insert user
    if (count($errors) == 0) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert = $conn->prepare("INSERT INTO users (username, email, password, gender, birthdate) 
                             VALUES (:username, :email, :password, :gender, :birthdate)");

    if ($insert->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $hashed_password,
        ':gender' => $gender,
        ':birthdate' => $birthdate
    ])) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error inserting user.";
    }
}
    }

?>