

<html>
	<head>
	</head>
	<body>

		<form ethod="post" action="login1.php">
			Username: <input type="text" name="Username"><br><br>
			Password: <input type="password" name="Password"><br><br>
			<input type="button" value="Log in">
			<input type="reset" value="Cancel">
		</form>
	</body>
</html>
<?php
	if($SERVER['REQUESTMETHOD'] == 'POST')
	{
		a = $post['username'];
		b = $post['Password'];
		if(empty(a) || empty(b))
		{
			echo '<script>alert("Username or Password is empty")';
		}
		if else($a === 'arianit' && $b === 'tershnjaku')
		{
			echo "<script>alert('Welcome!')</script>";
			// echo "<script>window.open('login1.php','_self')";
		}
		else
		{
			'<script>alert("Username and Password is incorrect!)';
		}
	}
	else
	{
		echo '<script>alert("Metoda nuk eshte POST!")';
	}
?>
