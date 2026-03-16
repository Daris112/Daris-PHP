<!DOCTYPE html>
<html>

<head>
    <style>
    .error {
        color: red;
    }
    </style>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php 
        include_once('add.php');
    ?>
    <?php  if (count($errors) > 0) { ?>
    <div class="error">
        <?php foreach ($errors as $error) { ?>
        <p><?php echo $error ?></p>
        <?php } ?>
    </div>
    <?php  } ?>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="confirmPassword">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="submit">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Log in</a>
        </p>
    </form>

</body>

</html>