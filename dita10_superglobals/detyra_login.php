<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Username: <input type="text" name="Username">
    <br><br>
    Password: <input type="password" name="Password">
    <br><br>
    <input type="submit" value="Log in">
</form>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $x=$_REQUEST['Username'];
        $y=$_REQUEST['Password'];
        if(empty($x) or empty($y)){
            echo "<script>window.alert('Username or Password is empty');</script>";
        } else if($x=="Daris" and $y=="Daris123"){
            echo  "<script>window.alert('Welcome');</script>";
        }
        else{
            echo "<script>window.alert('Invalid Username or Password');</script>";
        }
    }else{
        echo "<script>window.alert('Method is get');</script>";
    }
    
   ?>