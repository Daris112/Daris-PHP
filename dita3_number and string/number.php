<html>
    <head>
    </head>
    <body>
        <?php
        /*Një numër i plotë është një numër pa asnjë pjesë dhjetore.

2, 256, -256, 10358, -179567 janë të gjithë numra të plotë. Ndërsa 7.56, 10.0, 150.67 janë float.

Pra, një lloj i të dhënave me numër të plotë është një numër jo-dhjetor ndërmjet -2147483648 dhe 2147483647. 
Një vlerë më e madhe (ose më e ulët) se kjo, do të ruhet si float, sepse tejkalon kufirin e një numri të plotë.

Një gjë tjetër e rëndësishme për të ditur është se edhe nëse 4 * 2.5 është 10, rezultati ruhet si float, 
sepse një nga operandët është një notë (2.5).

Këtu janë disa rregulla për numrat e plotë:

Një numër i plotë duhet të ketë të paktën një shifër
Një numër i plotë nuk duhet të ketë një pikë dhjetore
Një numër i plotë mund të jetë ose pozitiv ose negativ

Mund të specifikohen në tre formate: dhjetore (10-bazë), 
hexadecimal (16-bazë - me parashtesë me 0x) ose oktal (me bazë 8 - parashtesë 0)
PHP ka funksionet e mëposhtme për të kontrolluar nëse lloji i një ndryshore është i plotë:

is_int ()
is_integer () - alias i is_int ()
is_long () - alias i is_int ()*/
        
        ?>
        <h2>Integer</h2>
        <?php
            //Na tregon tipin e te dhenave boolean dhe na tregon a eshte true apo false.
            $x = 1024;
            echo $x;
            echo "<br>";
            var_dump($x);
            echo "<br>";
            var_dump(is_int($x));
            echo"<br>";
            echo is_int($x);
        
        ?>
        <br>
        <?php
            //Na tregon tipin e te dhenave boolean dhe na tregon a eshte true apo false.
            $x = 10.24;
            var_dump(is_integer($x));
        ?>
        <br>
        <?php
            //Na tregon tipin e te dhenave boolean dhe na tregon a eshte true apo false.
            $x = 1024;
            var_dump(is_long($x)); //na tregon njejte sikurse is_int dhe is_integer.
        ?>
        <h2>Float</h2>
        <?php
        /*Një notë është një numër me një pikë dhjetore ose një numër në formën eksponenciale.
            2.0, 256.4, 10.358, 7.64E + 5, 5.56E-5 janë të gjitha float.
            Lloji i të dhënave float zakonisht mund të ruajë një vlerë deri në 18,446,744,073,709,551,616 
            (i varur nga platforma) dhe të ketë një saktësi maksimale prej 14 shifrash.
            PHP ka funksionet e mëposhtme për të parë nëse lloji i një ndryshore është float:

            is_float ()
            is_double () - alias i is_float ()*/
        ?>
        <?php
            $x = 10.240;
            echo is_float($x);
            var_dump(is_float($x));
            //$x = 222;
            echo $x;
        ?>
        <br>
        <?php
            $x = 10240;
            var_dump(is_float($x));
            echo $x;
        ?>
        <br>
        <?php
            $x = 10240;
            var_dump(is_double($x));
            echo $x;
        ?>
        <h2>Infinit </h2>
        <?php
            // Kur eshte nje vlere qe nuk mund te llogaritet atehere ajo vlere llogaritet si infinit.           
            $x = 9.9e9999999989+22;
            var_dump($x);
        ?>
        <br>
        <?php
            $x = 81129638414606681695789005144064;
            echo is_infinite($x);
            echo "<br>";
            echo var_dump(is_infinite($x));
        ?>
        <h2>Finit</h2>
        
        <?php
        
            $x = 1.2;
            var_dump($x);
            echo is_finite($x);
            echo "<br>";
            echo var_dump(is_finite($x));
        ?>
        <br>
        
        <h2>Not A Number</h2>
        <?php
            $z=200;
            var_dump(is_nan($z)) . "<br>";
            echo is_nan(acos(1.01));
        ?>
        
        
    </body>
</html>
