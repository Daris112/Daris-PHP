<?php
	//Nxjerrja e dates behet permes funksionit data.
		echo "Sot eshte " . date("d/m/Y") . "<br>";
		echo "Sot eshte " . date("Y.m.d") . "<br>";
		echo "Sot eshte " . date("Y-m-d") . "<br>";
		echo "Sot eshte " . date("l");
	?>
    <br>
    <!--Si behet nderrimi i vitit te copyright automatik-->
    &copy; 2010-<?php echo date("Y");?>
    <br>
    <?php
	//Si tregohet ora e sakte permes funksionit "data()".
		echo "Ora eshte " . date("h:i:sa");
		echo "<br>";
		echo "Ora eshte " . date("H:i:s");
	?>
    <br>
    <?php
		echo date("Y-m-d H:i:s");
	?>
    <br>
    <?php
	//Krijimi i nje date me vlerat tona
		$date=mktime(23, 04, 50, 07, 27, 1994);
		echo date("Y-m-d H:i:s", $date);
	?>