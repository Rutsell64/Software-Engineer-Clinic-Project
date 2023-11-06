<!DOCTYPE html>
<html>



<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="website.css">
</head>
<body id = "Login_or_Signup">
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action = "doctor_login_successful.php" method = "POST">
				
					<label for="chk" aria-hidden="true">Login</label>
					
					<input type="email" id = "email" name="email" placeholder="Email" required="">
					<input type="password" id = "password" name="password" placeholder="Password" required="">
					<a id = "forgot_info_link" href="forgot_info.php">Forgot your email or password? Click Here</a>
					<button>Login</button>
					
				</form>
			</div>
	</div>
</body>
</html>