<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Send Email</title>
	<link rel="stylesheet" type="text/css" href="main.css">	
</head>
<body>
	<div id="wrap">
		<div id="form_wrap">
			<form action="submit.php" method="post" enctype="multipart/form-data">
				<div class="form_header">
					<span class="form_icon">&#9993;</span>
					<div>
						<p class="eyebrow">Quick message</p>
						<h1>Send Email</h1>
					</div>
				</div>

				<div class="form_group">
					<label for="emailphp">Email</label>
					<input type="email" name="email" value="" id="emailphp" placeholder="recipient@example.com" required />
				</div>

				<div class="form_group">
					<label for="subjectphp">Subject</label>
					<input type="text" name="subject" value="" id="subjectphp" placeholder="What is this about?" required />
				</div>

				<div class="form_group">
					<label for="messagephp">Your Message</label>
					<textarea name="message" id="messagephp" placeholder="Write your message here..." required></textarea>
				</div>

				<input type="submit" name="submit" value="Send Message" />
			</form>
		</div>
	</div>
</body>
</html>
