<?php
$arr = array(
        array(4,"Prizren",20000,"Kalaja"),
        array(1,"Prishtine",10000,"Newborn"),
        array(7,"Gjakove",50000,"Qarshia")
);
$c = count($arr);
$d = count($arr)+1;

for($row = 0; $row<$c; $row++){
    for($col = 0; $col < $d; $col++){
        echo $arr[$row][$col]." " ;
    }
    echo "<br>";
}

?>
<br><br>
<?php

   
    for($z=1;$z<=5;$z++){
        for($x=1;$x<=$z;$x++){
          echo "*"." ";
        

        }
     
        
        echo "<br>";
    }
?>
<br><br>
<?php

   
    for($z=1;$z<=5;$z++){
        for($x=5;$x>=$z;$x--){
          echo "*"." ";
        }
     
        
        echo "<br>";
    }
?>
<br><br>
<?php

   
    for($z=1;$z<=5;$z++){
        for($x=1;$x<=5;$x++){
          if($z == $x){
            echo "X"." ";
          }
          else{
            echo "0"." ";
          }
        

        }
        
        echo "<br>";
    }
?>
<br>
<?php

   
    for($z=1;$z<=5;$z++){
        for($x=1;$x<=5;$x++){
          if($z+$x==6){
            echo "X"." ";
          }
          else{
            echo "0"." ";
          }
        

        }
        
        echo "<br>";
    }
?>
<br>
<?php

   
    for($z=1;$z<=5;$z++){
        for($x=1;$x<=5;$x++){
          if($z+$x==6){
            echo "X"." ";
          }
          else if($x==$z){
            echo "X"." ";
          }
          else{
            echo "0"." ";
          }
        

        }
        
        echo "<br>";
    }
?>
