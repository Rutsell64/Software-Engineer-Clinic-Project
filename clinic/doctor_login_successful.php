<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="website.css">
</head>
<body>
	
<?php

ob_start();
 
$conn = mysqli_connect("localhost","root","","clinic");

if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
if( isset($_POST['email']) && isset($_POST['password']) ){ //This checks if the email or password was sent over from the log in page to this profile page
	
    $email =  $_POST['email'];
    $password = $_POST['password'];
	
	$_SESSION['email'] = $email; 
	
	$query = "SELECT * FROM doctor_registration WHERE email = '$email' AND password = '$password'";
	
	if ($result = mysqli_query($conn,$query)){ //This checks if there is even a connection to the database
		if (mysqli_num_rows($result) > 0) { //This if statement checks if the email and password is found within the database
		
		$query1 = "SELECT * FROM doctor_registration WHERE email = '$email' AND password = '$password'";
		$result1 = $conn->query($query1);

			if ($result1->num_rows > 0) {
				// output data of each row
				$row = $result->fetch_assoc();
				
				$doctor_id = $row["doctor_id"];
				$full_name = $row["full_name"];
				$password = $row["password"];
				$email = $row["email"];
				$dob = $row["dob"];
				$phone = $row["phone"];
				$gender = $row["gender"];
				$doctor_occupation = $row["doctor_occupation"];
			}
			
			$_SESSION['id'] = $doctor_id;
?>			
			<p>Successfully Logged In </p>
			<a id = "" href="Doctor_Profile.php">Go To Profile</a>


		<?php
		} //This bracket ends the if statement where it checks if data is found within the database
		else{ //If the email and password is not found then execute whatever is in this else statement
		?>
			<a id = "forgot_info_link" href="Login_Organization.php">Incorrect email or password. Click here to go back</a>
		<?php	
			return 0;	
		}
	} //This bracket is the end of the if statement that checks if there was even a connection to the database
	else{ //No connection to the database
		echo 'Error: ' . mysqli_error();
	}
}
else {//if the email and password was not sent over from the log in page then make them log in again
?>
	<a id = "forgot_info_link" href="Main.php">Please Log in</a>
<?php
	Return 0;
}
        
?>
	
	
</body>
</html>