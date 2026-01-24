<p>$GLOBALS</p>
<?php
    $a = 20;
    $b = 50;
?>
<?php
    $x = 65;
    $y = 15;
    function vlere() {
        //$z = $x + $y;//Kjo metod nuk funksionon
        //$GLOBALS['z']= 10 + 20;
        $GLOBALS['z'] = $GLOBALS['a'] + $GLOBALS['b'];
    }

    vlere();
    echo $z;

?>
    <p>$_SERVER</p>
    <?php
			
			echo $_SERVER['PHP_SELF']; //tregon vendndodhjen e file qe jemi.
			echo "<br>";
 			echo $_SERVER['SERVER_NAME']; //tregon emrin e serverit ku gjendet file i yne.
			echo "<br>";
			echo $_SERVER['HTTP_HOST']; //tregon hostin ku ndodhet(ne rastin ton e tregon portin)
			echo "<br>";
			echo $_SERVER['HTTP_REFERER']; //tregon linkun se si te qasemi tek file qe gjendemi.
			echo "<br>";
			echo $_SERVER['SCRIPT_NAME']; //Tregon emrin e scriptes qe jemi duke punuar.
			echo "<br>";
			echo $_SERVER['SERVER_SOFTWARE'];//Tregon me qfare server jeni duke punuar.
			echo "<br>";
			echo $_SERVER['SERVER_PROTOCOL'];//Tregon qfare protokolli ka serveri.
			echo "<br>";
			echo $_SERVER['REQUEST_METHOD']; //Kthen metodën e kërkesës së përdorur për të hyrë në faqe(siç është POST)
			
		?>

    <p>$_REQUEST</p>
    
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            Username: <input type="text" name="Username">
            <input type="submit" value="Log in">
        </form>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $x=$_REQUEST['Username'];
                if(empty($x)){
                    echo "<script>window.alert('Username is empty');</script>";
                } else {
                    echo  $x;
                }

            }else{
                echo "<script>window.alert('Method is get');</script>";
            }
           ?>
            
            
    