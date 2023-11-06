<!DOCTYPE html>
<html>



<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="website.css">
</head>
<body>

	<div id="retrieve_email_border">  		
		<form action = "forgot_info_confirm.php" method = "post">
					
					<h2 id = "forgot_email_password">Enter information here to get email</h2>
					
					<label> Enter your id</label>
					<input type="text" id = "personal_id" name="personal_id" required="">
						
					<label> Enter password</label>
					<input type="text" id = "personal_password" name="personal_password" required="">
				
					<button>Submit</button>
					
		</form>
	</div>
	
	<div id="retrieve_password_border">  		
		<form action = "forgot_info_confirm.php" method = "post">
					
					<h2 id = "forgot_email_password">Enter information here to get password</h2>
					
					<label> Enter your id</label>
					<input type="text" id = "personal_id" name="personal_id" required="">
						
					<label> Enter email</label>
					<input type="text" id = "personal_email" name="personal_email" required="">
				
					<button>Submit</button>
					
		</form>
	</div>
	
	
	
	
</body>
</html>