<?php

for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {

        if (
            $i == 1 || $i == 5 ||           
            $j == 1 ||                      
            ($i == 2 && $j <= 4) ||          
            ($i == 4 && $j <= 4) ||          
            ($i == 3 && $j == 3)             
        ) {
            echo "X ";
        } else {
            echo "0 ";
        }

    }
    echo "<br>";
}

?>
<br><br>
<?php

for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {

        if ($i == 1 || $i == 5) {
            echo $j . " ";
        }
        elseif ($j == 3) {
            echo "3 ";
        }
        elseif ($i == 2 && ($j == 4)) {
            echo "4 ";
        }
        elseif ($i == 4 && ($j == 2)) {
            echo "2 ";
        }
        else {
            echo "0 ";
        }

    }
    echo "<br>";
}

?>
