<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Send Email</title>
<link rel="stylesheet" type="text/css" href="main.css">	
<script  src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>

</head>
<body>
	<div id="wrap">
		<div id='form_wrap'>
			<form action="submit.php" method="post" enctype="multipart/form-data">
				<p>Send Email</p>
				<label for="email">Email: </label>
				<input type="text" name="email" value="" id="emailphp" /><br><br>

				<label for="subject">Subject: </label>
				<input type="text" name="subject" value="" id="subjectphp" /><br><br>

				<label for="message">Your Message: </label>
				<textarea  name="message" value="Your Message" id="messagephp" ></textarea><br>	<br>		
				<input type="submit" name ="submit" value="Send!" />
			</form>
		</div>
	</div>
</body>
</html>