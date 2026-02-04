<?php
	session_start();
?>
<html>

<head>
</head>

<body>

    <?php
			echo 'Emri: '.$_SESSION['emri'].'<br>';
			echo 'Mbiemri: '.$_SESSION['mbiemri'];
			//session_destroy();
			
		?>
    <a href='Sessions.php'>back</a>
</body>

</html>