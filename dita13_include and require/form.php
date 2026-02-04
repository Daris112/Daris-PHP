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
        //require 'form.php';
        include 'include and require.php';
    ?>
 
 
 <p><span class="empty">* Required</span></p>
    <form method="post" >
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