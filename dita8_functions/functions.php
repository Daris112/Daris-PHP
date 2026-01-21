<html>

<head>
</head>

<body>
    <?php
			//Krijmi i nje funksioni
			function x() //
			{
				echo "Arianit Tershnjaku"; //Vendosja e "echo" brenda funksionit.
			}
			x(); //Thirrja e nje funksioni
		?>
    <br>
    <?php
			function text($emri)
			{
				echo $emri."<br>";
			}
			text("Arianit");
			text("Amir");
			text("Lis");
	
			function text1($emri1,$mbiemri)//Funksioni me parametra
			{
				echo $emri1.$mbiemri."<br>";
			}
			text1("Arianit ","Tershnjaku");//Thirrja e funksionit me argumente(parametra).
			text1("Ari ","Tershnjaku");
			text1("Niti ","Tershnjaku");
		?>
    <br>
    <?php
			//Krijmi i nje funksioni
			function vlera($x,$y) //
			{	
				echo $x + $y;//Vendosja e "echo" brenda funksionit.
				echo "<br>";
				echo "$x" * "$y"; //Pyetje? Qfare rezultati na jep?
			}
			vlera(5,5); //Thirrja e nje funksioni
		?>
    <br>
    <?php
		//Nga versioni PHP7 duhet te i tregohet edhe tipi i te dhenave te parametrave
			function number(int $a, int $b)//Nese i tregojme edhe tipin e te dhenave atehere kur deshirojme te mbledhim tipin number me string na raporton error.
			{
				//return $a . $b;
				return $a + $b;//Return perdoret per te na kthyer nje rezultat nga kodi i funksionit
			}
			echo number(5, "5"); //
			//echo number(5, "Hello"); //
		?>
    <br>
    <?php
			function ari($a, $b)//Edhe pa tipin e te dhenave funksionon.
			{
				return $a . $b;//Return gjithashtu perdoret edhe per ta ndaluar se ekzekutuar funksionin.
			}
			echo ari(5,"5days");//
		?>
    <br>
    <?php
			function numeri()
			{
				$x = "10"; //Mund te i caktojme edhe variabla brenda funksionit.
				$y = 5;
				return $x * $y;
				
			}
			echo numeri();
			echo $x;
		?>
    <br>
    <?php 
			$x = 10;
			$y = 7;
			function mbledh()
			{
				// $x = 10;
				// $y = 7;
				return $x + $y;
			}
			echo mbledh();
			echo $x;
		?>
    <br>
    <?php
			function fiks ($x = 20) //Parametrave mund te ju caktojme edhe vlera fikse.
			{
				echo "Vlera eshte: $x";
			}
			fiks();
		?>
    <br>
    <?php
		//Nese deshirojme te caktojme parametra me te dhena "float" por si rez. te nxjerrim "int".
			function mePresje(float $a, float  $b)//:int
			{
				return($a + $b);
			}
			echo mePresje(1.5,3.6);
		?>
    <br>
    <?php 
		//Nese e shenojme keshtu atehere si rezultat na nxjerr numer me presje(float).
			function mePres($a, $b) 
			{
				return($a + $b);
			}
			echo mePres(1.5, 3.4);
		
		?>

</body>

</html>