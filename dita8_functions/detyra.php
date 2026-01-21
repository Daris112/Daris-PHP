<?php
    function detyra1($a,$b,$c){
        if($a>$b && $a>$b)
            {
                echo "A eshte me e madhe";
            }
        else if($b>$a && $b>$c){
            echo "B eshte me e madhe";
        }
        else{
            echo "C eshte me e madhe";
        }
    }
    echo detyra1(312,9,7);
?>

<?php
   
function factorial($n) {
    $result = "1"; 

    for ($i = 1; $i <= $n; $i++) {
        $result *= $i;
    }

    return $result;
}

$numbers = [3, 5, 12, 20, 35, 200];

foreach ($numbers as $num) {
    echo "Faktorijali i $num është: " . factorial($num) . "<br><br>";
}
?>


<?php
$array = ["banana", "apple", "orange", "pear", "kiwi"];

sort($array); // alfabetski

$brojElemenata = count($array);

if ($brojElemenata <= 5) {
    $broj = 1;
    foreach ($array as $element) {
        echo $broj . ". " . $element . "<br>";
        $broj++;
    }
} else {
    for ($i = $brojElemenata - 1; $i >= 0; $i--) {
        echo ($i + 1) . ". " . $array[$i] . "<br>";
    }
}
?>


<?php
$array = ["A", "B", "C", "D", "E", "F"];

$broj = count($array);

if ($broj < 3) {
    $array[] = "Novi element";
} elseif ($broj >= 3 && $broj <= 5) {
    array_shift($array);
} else {
    array_splice($array, 2, 2);
}

$x = ["Prizren", "Prishtine", "Ferizaj"];

$rezultat = array_merge($array, $x);

print_r($rezultat);
?>
