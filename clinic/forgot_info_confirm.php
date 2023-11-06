<!DOCTYPE html>
<html>



<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="website.css">
</head>
<body>

	<?php
		$conn = mysqli_connect("localhost","root","","clinic");
		//This checks if the page recieved the information from the forgot_info page
		if(!isset($_POST['personal_id']) && !isset($_POST['personal_password']) || !isset($_POST['personal_id']) && !isset($_POST['personal_email'])){
			echo "Please go back and enter the information required to retrieve email or password" ;
		}
		//This checks if the page recieved an id and password from the forgot_info page
		elseif(isset($_POST['personal_id']) && isset($_POST['personal_password'])){
			
			$personal_id = $_POST['personal_id'];
			$personal_password = $_POST['personal_password'];
			
			$case1 = "SELECT * FROM patient_registration WHERE patient_id = '$personal_id' AND password = '$personal_password' " ;
			$case1_result = $conn->query($case1);
			$case2 = "SELECT * FROM doctor_registration WHERE doctor_id = '$personal_id' AND password = '$personal_password' " ;
			$case2_result = $conn->query($case2);
			
			if($case1_result->num_rows > 0){
				$row = $case1_result->fetch_assoc();
				$email = $row["email"];
				echo "Your email is" ." ". $email ;
	?>
				<a id = "" href="Main.php">Click here to go back to the homepage</a>
	<?php		Return 0;
			}
			elseif($case2_result->num_rows > 0){
				$row = $case2_result->fetch_assoc();
				$email = $row["email"];
				echo "Your email is" ." ". $email ;
	?>
				<a id = "" href="Main.php">Click here to go back to the homepage</a>
	<?php		Return 0;
				
				
			}
			else{
				echo "Your id or password was incorrect. Please try again." ;
	?>
				<a id = "" href="Main.php">Click here to go back to the homepage</a>
	<?php		Return 0;
			}
			
			
			
			$qry = "SELECT * FROM doctor_registration WHERE full_name = '$doctor_name'";
			$reslt = $conn->query($qry);
			if($reslt->num_rows > 0){
				$row = $reslt->fetch_assoc();
				$doctor_id = $row["doctor_id"];
				$doctor_occupation = $row["doctor_occupation"];
			}
			
		}
		//This checks if the page recieved an id and email from the forgot_info page
		elseif(isset($_POST['personal_id']) && isset($_POST['personal_email'])){
			
			$personal_id = $_POST['personal_id'];
			$personal_email = $_POST['personal_email'];
			
			$case1 = "SELECT * FROM patient_registration WHERE patient_id = '$personal_id' AND email = '$personal_email' " ;
			$case1_result = $conn->query($case1);
			$case2 = "SELECT * FROM doctor_registration WHERE doctor_id = '$personal_id' AND email = '$personal_email' " ;
			$case2_result = $conn->query($case2);
			
			if($case1_result->num_rows > 0){
				$row = $case1_result->fetch_assoc();
				$password = $row["password"];
				echo "Your password is" ." ". $password ;
	?>
				<a id = "" href="Main.php">Click here to go back to the homepage</a>
	<?php		Return 0;
			}
			elseif($case2_result->num_rows > 0){
				$row = $case2_result->fetch_assoc();
				$password = $row["password"];
				echo "Your email is" ." ". $password ;
	?>
				<a id = "" href="Main.php">Click here to go back to the homepage</a>
	<?php		Return 0;
				
				
			}
			else{
				echo "Your id or email was incorrect. Please try again." ;
	?>
				<a id = "" href="Main.php">Click here to go back to the homepage</a>
	<?php		Return 0;
			}
			
		
		}
	
	
	
	?>
	
	
	
	
</body>
</html>