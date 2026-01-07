 <?php
        //Shembulli 1
			//Te tregohet nese 5 eshte me i vogel se 10 permes kushteve
			$x = 1;
			
			if($x < 10)
			{
				echo "$x eshte me i voges se 10";
			}
			else
			{
				echo "$x eshte me i madh se 10";
			}
		?>
    <br>
    <?php
            //Shembulli 2
			$y = 16;
			
			if($y <= 10)
			{
				echo "$y eshte me i vogel se 10";
			}
			else if($y >= 20)
			{
				echo "$y eshte me i madh ose i barabart me 20";
			}
			else
			{
				echo "$y eshte ne mes te 10 dhe 20";
			}
		?>


    <br>
    <?php
			$a = 50; $b= 70;  $c =60;
			
			if($a > $b && $a > $c){
				echo "A eshte me e madhe";
			}
			else if($b > $a && $b > $c){
				echo "B eshte me e madhe";
			}
			else{
				echo "C eshte me e madhe";
			}

			?>
    <br>

    <?php
        $a = 100; $b = 130; $c=80;

        if($a>$b){
            if($a>$c){
                echo "A eshte me e madhe";
            }
            else{
                echo "C eshte me e madhe";
            }

        }
        else{
            if($b>$c){
                echo "B eshte me e madhe";
            }
            else{
                echo "C eshte me e madhe";
            }

            }
        
    ?>
    <br>
    <?php
        $a= 20;

        if($a>0){
            echo "$a eshte numer pozitiv";
        }
        else if ($a<0) {
            echo "$a eshte numer negativ";
        }
        else{
            echo "$a eshte zero";
        }   
    ?>

    <br>
    <?php   
        $a = 6;

        if($a % 2 == 0){
            echo "$a eshte numer cift";
        }
        else{
            echo "$a eshte numer tek";
        }
    ?>
    


 <?php 
            //Shembulli 5
            $z = 2;
            
            switch($z)
            {
                case 1:
                    echo 'Janar';
                break;
                case 2:
                    echo 'Shkurt';
                break;
                case 3:
                    echo 'Mars';
                break;
                case 4:
                    echo 'Prill';
                break;
                case 5:
                    echo 'Maj';
                break;
                case 6:
                    echo 'Qershor';
                break;
                case 7:
                    echo 'Korrik';
                break;
                case 8:
                    echo 'Gushte';
                break;
                case 9:
                    echo 'Shtator';
                break;
                case 10:
                    echo 'Tetor';
                break;
                
                case 11:
                    echo 'Nentor';
                break;
                
                case 12:
                    echo 'Dhjetor';
                break;
                
                default:
                    echo 'Ky muaj nuk egziston!';
            }
        ?>
    <br>
    <?php
            //Shembulli 6
            $ditet = 'E Hene';
            
            switch($ditet)
            {
                case 'E Hene':
                    echo 'E Hene eshte dita e pare e javes';
                break;
                
                case 'E Marte':
                    echo 'E Marte eshte dita e dyte e javes';
                break;
                
                case 'E Merkure':
                    echo 'E Merkure eshte dita e tret e javes';
                break;
                
                case 'E Enjte':
                    echo 'E Enjte eshte dita e katert e javes';
                break;
                
                case 'E Premte':
                    echo 'E Premte eshte dita e peste e javes';
                break;
                
                case 'E Shtune':
                    echo 'E Shtune eshte dita e gjashte e javes';
                break;
                
                case 'E Diel':
                    echo 'E Diel eshte dita e shtate e javes';
                break;
                
                default:
                    echo 'Kjo dite nuk egziston';
            }
        ?>
    <br>


<?php
$txt = array("Prizren","Prishtine", "Digjitale");
			rsort($txt);
        
			$y = count($txt);
        
			for($z=0; $z<$y; $z++)
			{
				echo $txt[$z];
				echo "<br>";
			}

            ?>


<?php
   
$array = [
    [1, 1, 1, 1],
    [2, 2, 2, 2],
    [3, 3, 3, 3],
    [4, 4, 4, 4]
];

for ($i = 0; $i < count($array); $i++) {
    for ($j = 0; $j < count($array[$i]); $j++) {
        echo $array[$i][$j] . " ";
    }
    echo "<br>";
}
?>

