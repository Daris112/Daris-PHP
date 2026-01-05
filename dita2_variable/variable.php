 <?php
    //Variablat shenohen me shenjen e dollarit "$"
    //var name = 'Arianit';
    //Rregullat per emrat e variablave
    //1. Emri i variablave duhet te filloj me shkronje ose me shenjen e dollarit $
    //2. Emri i variablave nuk duhet te permbaje hapesira
    //3. Emri i variablave nuk duhet te permbaje karaktere speciale si: !,%,^,*,(,), etj
    //4. Emri i variablave nuk duhet te jete nje fjale e rezervuar e PHP

    $first_name = "Arianit";
    $Name = "Arianiti";

    //Rezultati mund te paraqitet ne dy menyrat e ndryshme
    //document.write("my name is:"+name)
    echo "My name is: $first_name <br>";

    //Nese rezultatin e shenojme me thonjeza te njefishta atehere rezultati paraqitet ashtu siq eshte i shenuar

    echo "My name is:",$first_name,'!','<br>';

    $x = 3;
    $y = 5;

    //Nese e shenojme pa thonjeza rezultati na mblidhet

    echo $x + $y."<br>";

    echo "$x + $y <br>";

    echo $x . $y;
    echo "<br>";

    ECHO $x . $y; // nuk preferohet

    ?>
 