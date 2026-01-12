<p>While loops</p>

    <?php
        
			$x = 0;
			
			while($x <= 10)
			{
				echo $x."<br>";
				$x++;

				// Pyetje? Si mund te i rrisim nga dy vlera, ose me shume.
			}
		?>
    <br>
    <?php
			$x = 0;
			
			while($x <= 10)
			{
				echo $x."<br>";
				$x++;
				if($x==6)
				{
					break; //e nderpret loop edhe nese nuk ka perfundue ende.
				}
				// Pyetje? Si mund te i rrisim nga dy vlera, ose me shume.
					//$x+=2;
			}
		?>
    <p>Do while loops</p>

    <?php
        
			$y = 0;
			do{
				echo $y . '<br>';
				$y++;
				if($y==6)
				{
					break; //e nderpret loop edhe nese nuk ka perfundue ende.
				}
			}
			while($y <= 10)
		?>