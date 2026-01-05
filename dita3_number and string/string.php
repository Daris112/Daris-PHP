<html>

<head>
</head>

<body>
    <?php
            //Na mundeson gjetjen e gjatesis se stringut.
            //method()
            echo strlen(" Prizren ");
        ?>
    <br>
    <?php
            //Na tergon sa fjal i kemi brenda nje stringu.
            echo str_word_count(' Shkolla Digjitale Prizren t ');
        ?>
    <br>
    <?php
            
            //Eshte nje metod e cila ne kthen stringun mbrapsht.
            echo strrev('Arianit');
        ?>
    <br>
    <?php
            //Na mundeson te gjejme se ne cilen pozite fillon fjala 'Prizren'
            $pozicioni= strpos('Shkolla Digjitale Prizren', 'Shkolla');
            $pozicioni2= strpos('Shkolla Digjitale Prizren', 'Prizren');
            echo $pozicioni.'<br>';
            echo $pozicioni2;
        ?>
    <br>
    <?php
            //Na mundeson te ndryshojme nje fjale me nje fjale tjeter brenda nje stringu.
            $emri='Shkolla Digjitale Prizren'.'<br>';
            $ndrroje= str_replace('Prizren', 'Suhareke',$emri);
            
            echo $emri;
            echo $ndrroje;
        ?>
    <br>


</body>

</html>
