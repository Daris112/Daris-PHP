<html>

<head>
</head>

<body>
    <h1>Operatoret</h1>
    <h3>Operatoret Aritmetik</h3>

    <?php
            $x = 10;
            $y = 20;
            
            echo $x + $y;
            echo "<br>";
            echo $x - $y;
            echo "<br>";
            echo $x * $y;
            echo "<br>";
            echo $x / $y;
            echo "<br>";
            echo $x % $y;   //10 / 20 = 0 
                            // 0
                            // 10
        ?>
    <h3>Operatoret Percaktues</h3>

    <?php
            $x = 10;
            $y = 20;
            
            //echo $x = $y;  // x = y
            echo "<br>";
            echo $x += $y;  // x += y; x = x+y
            echo "<br>";
            echo $x -= $y;
            echo "<br>";
            echo $x *= $y;
            echo "<br>";
            echo $x /= $y;
            echo "<br>";
            echo $x %= $y;
        ?>

    <h3>Operatoret Krahasues</h3>

    <?php
            $x = 10;
            $y = 20;
            
            echo $x == $y;
            echo "<br>";
            var_dump($x==$y);
            echo "<br>";
            echo $x === $y;
            echo "<br>";
            var_dump($x===$y);
            echo "<br>";
            echo $x != $y;
            var_dump($x!=$y);
            echo "<br>";
            echo $x <> $y;
            echo "<br>";
            var_dump($x <> $y);
            echo "<br>";
            echo $x > $y;
            echo "<br>";
            echo $x < $y;
            echo "<br>";
            echo $x >= $y;
            echo "<br>";  
            echo $x <= $y;
            echo "<br>";
        ?>

    <h3>Operatoret Logjik</h3>

    <?php
            $x = 11;
            $y = 35;
            
            //AND
            $z = ($x > 5 and $y > 30); //rezultati true  
            echo $z;
            echo "<br>";
            var_dump($z);
            
            //OR
            echo "<br>";
            $a = ($x > 10 or $y < 30);
            var_dump($a);
            
            //NOT
            echo "<br>";
            $b = !($x > 10 or $y < 30);
            var_dump($b);
        
            // XOR
            echo "<br>";
            $c = ($x > 30 xor $y > 30);  //T ^ T = F
                                         //F ^ F = F
            var_dump($c);        //T ^ F = T
                                         //F ^ T = T
            
        ?>

    <h3>Operatoret String</h3>

    <?php
            $x = "10";
            $y = "20";
            echo $x.$y;
            echo "<br>";    
        
            $name = "arianit";
            $age = "25";
            echo $name,$age;
            echo "<br>";
            echo $x .= $y;
        ?>



    <h3>Increment Decrement Operatoret</h3>

    <?php
            $x = 10;
            $y = 20;
            

            echo $x++;
            echo "<br>";
            echo $x;
            echo "<br>";
            echo ++$x;
            
            echo "<br>";
            echo "<br>";
            
            echo $y--;
            echo "<br>";
            echo --$y;
            echo "<br>";
        ?>
    <?php 
            $gjat = 7; 
            $gjer = 5; 
            echo "Siperfaqja e drejtekendeshit eshte: " .  ($gjat * $gjer ) . " cm<sup>2</sup>"; 
            echo "<br>";
            echo "Permietri i drejtekendeshit eshte : " . 2*($gjat + $gjer ) . " cm";
    ?>

</body>

</html>
