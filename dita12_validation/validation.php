<html>
<head>
    <style>
        .empty{
            color: red;
        }
    </style>
</head>

<body>
    
    <?php

    $empUsername = "";
    $empPassword = "";
    $empEmail = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = secure($_POST['Username']);
        $password = secure($_POST['Password']);
        $email = secure($_POST['Email']);

        if(empty($username))
            {
                $empUsername = "Username is required";
            }
        else if(!preg_match("/^[a-zA-ZëË],{5,} *$/",$username)){
            $empUsername = "Only letters and white space allowed";
        }
        if(empty($password))
            {
                $empPassword = "Password is required";
            }
        else if(strlen($password) < 8){
            $empPassword = "Password must be at least 8 characters long";
        }
        if(empty($email))
            {
                $empEmail = "Email is required";
            }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $empEmail = "Invalid email format";
        }
        if(empty($username) and empty($password) and empty($email))
            {
                $empUsername = "Username is required";
                $empPassword = "Password is required";
                $empEmail = "Email is required";
            }
            else if($username !="" and $password !="" and $email !="" and preg_match("/^[a-zA-ZëË]*$/",$username) and filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                echo "<script>alert('Register Successfully')</script>";

            }
    }
    function secure($x){
        $x = trim($x);
        $x = stripslashes($x);
        $x = htmlspecialchars($x);
        return $x;
    }
    ?>
    <p><span class="empty">* Required</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        Username: <input type="text" name="Username">
        <span class="empty">* <?php echo $empUsername;?></span>
        <br><br> 
        Email: <input type="text" name="Email">
        <span class="empty">* <?php echo $empEmail;?></span>
        <br><br>
        Password: <input type="password" name="Password">
        <span class="empty">* <?php echo $empPassword;?></span>
        <br><br>

        <input type="submit" value="Sign Up">
        <input type="reset" value="Cancel">
    </form>
    </body>

</html>