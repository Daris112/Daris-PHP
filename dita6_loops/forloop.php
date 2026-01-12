<p>For loop</p>

<?php
    for($z=0;$z<=10;$z++)
    {
        echo'Numeri eshte '.$z. '<br>';
        if($z==6){
            continue;
        }
    }
?>

<p>Foreach loop</p>

<?php
    $txt = array (1,23,3,4,5,6,90);
    sort($txt);
    foreach($txt as $x)
    {
        echo "  $x <br>";
    }
?>
<br>
<?php
    for($z=1;$z<=5;$z++){
        for($x=1;$x<=5;$x++){
            echo $x." ";
        }
        echo "<br>";
    }
?>
<br>
<?php
        for($z=1;$z<=5;$z++){
        for($x=1;$x<=5;$x++){
            echo $z." ";
        }
        echo "<br>";
    }
?>
<br>

<?php

    $y=1;
    for($z=1;$z<=5;$z++){
        for($x=1;$x<=5;$x++){
          echo $y." ";
          $y++;

        }
        $y=$z+1;
        echo "<br>";
    }
?>
<br>
<?php

   
    for($z=1;$z<=5;$z++){
        for($x=1;$x<=5;$x++){
          echo "X"." ";
        

        }
        
        echo "<br>";
    }
?>