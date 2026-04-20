<?php
include("includes/connect.php");

$errors = array();

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    if (empty($username) || empty($password)){
        array_push($errors, "Username and password are required for login");
    }

    if (count($errors) == 0){
        $query = "SELECT * FROM users WHERE username=:username";
        $checkQuery = $conn -> prepare($query);
        $checkQuery -> bindParam(':username', $username);
        $checkQuery -> execute();
        $result = $checkQuery->fetch();

       if ($result && password_verify($password, $result['password'])){
            // Start the session and save the username
            session_start();
            $_SESSION['username'] = $result['username'];
            
            echo "<script>alert('Login successful');</script>";
            echo "<script>window.open('admin.php','_self');</script>";
        } else {
            array_push($errors, "Invalid username or password");
        }
    
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="header">
        <h2>Login</h2>
    </div>

    <form method="post">
        <?php  if (count($errors) > 0) { ?>
        <div class="error">
            <?php foreach ($errors as $error) { ?>
            <p><?php echo $error ?></p>
            <?php } ?>
        </div>
        <?php  } ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login">Login</button>
        </div>
        <p>
            Not yet a member? <a href="#">Sign up</a>
        </p>
    </form>
</body>

</html>

