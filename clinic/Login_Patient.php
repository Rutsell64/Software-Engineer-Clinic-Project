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
				<form action = "patient_login_successful.php" method = "POST">
				
					<label for="chk" aria-hidden="true">Login</label>
					
					<input type="email" id = "email" name="email" placeholder="Email" required="">
					<input type="password" id = "password" name="password" placeholder="Password" required="">
					<a id = "forgot_info_link" href="forgot_info.php">Forgot your email or password? Click Here</a>
					<button>Login</button>
					
				</form>
			</div>

			<div class="login">
			
				<form action = "patient_confirmation.php" method = "post">
					<label for="chk" aria-hidden="true">Sign up</label>
			
					<input type="text" id = "full_name" name="full_name" placeholder="Full name" required="">
					<input type="password" id = "password" name="password" placeholder="Password" required="">
					<input type="email" id = "email" name="email" placeholder="Email" required="">
					<input type="date" id = "dob" name="dob" placeholder="Date of Birth" required="">
					<input type="tel" id = "phone" name="phone"  pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="Phone Number" required="">
					
					<select name = "gender" id = "gender">
					<option value = "">--Please provide us your gender--</option>
					<option id = "gender" value = "Male">Male</option>
					<option id = "gender" value = "Female">Female</option>
					<option id = "gender" value = "Other">Other</option>
					</select>
					
					<button>Sign up</button>
					
				</form>
			</div>
	</div>
</body>
</html>