<?php
    session_start();
?>
<html>
    <head>

    </head>
    <body>
        <?php
            $_SESSION['emri'] = "Daris";
            $_SESSION['mbiemri'] = "Hodza"; 
            echo "Session set";
            echo "<br>";
            print_r($_SESSION);
        ?>

        <?php
            if(isset($_SESSION['emri']))
                {
                    $_SESSION['count']=1;
                } 
            else 
                {
                    $_SESSION['count']++;
                }
                echo $_SESSION['count'];
        ?>
        <?php
            //session_unset()
            //session_destroy()
        ?>
        <a href="session1.php">Next</a>
    </body>
</html>
