<?php
session_start();
//echo ("{$_SESSION['id']}");
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="website.css">
	</head>

	<body>

<?php
		ob_start();
 
		$conn = mysqli_connect("localhost","root","","clinic");

		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
 
		if(!isset($_SESSION['id']) ){ //This checks if the user successfully logged in and his id was saved
?>
		<a id = "forgot_info_link" href="Main.php">Does not Exist</a>
<?php
		}
		else{ //if the user successfully logged in then log them into there account 
			$id = $_SESSION['id'];
			
			$query = "SELECT * FROM patient_registration WHERE patient_id = '$id'";
	
			if ($result = mysqli_query($conn,$query)){ //This checks if there is even a connection to the database
				if (mysqli_num_rows($result) > 0){ //This if statement checks if the email and password is found within the database
		
					$query1 = "SELECT patient_id,full_name,password,email,dob,phone,gender FROM patient_registration WHERE patient_id = '$id'";
					$result1 = $conn->query($query1);

					if ($result1->num_rows > 0) {
						// output data of each row
						$row = $result->fetch_assoc();
						$patient_id = $row["patient_id"];
						$full_name = $row["full_name"];
						$password = $row["password"];
						$email = $row["email"];
						$dob = $row["dob"];
						$phone = $row["phone"];
						$gender = $row["gender"];
					}

?>		
					<div id = "side_directory">
			
					<p id = "side_clinic_name"> Springfield All Clinic <img src="medical_symbol.png" alt="medical symbol" width="35" height="30"> </p>
					<p id = "side_profile"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href= "Patient_Profile.php">Profile</a> </p>
					<p id = "side_make_appointment"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href="Patient_Make_Appointment.php">Make Appointment</a> </p>
					<p id = "side_my_appointment"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href="Patient_My_Appointments.php">My Appointment</a> </p>
					<p id = "side_logout"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href="logout.php">Logout</a> </p>

					</div>
			
					<div id = "patient_id_border">
						<p id = "patient_id">
							Your Patient ID: <?php echo $patient_id ?>
						</p>
					</div>
			
					<div id = "profile_border">
						<h1 id = "profile_main_title">My Profile</h1>
						<div id = "profile_image">
								<?php
							if($gender == 'Male'){
								?>	
								<img id = "image" src="male_icon.png" alt="Avatar" style="width:200px">
								<?php
							}elseif($gender == 'Female'){
								?>	
								<img id = "image" src="female_icon.png" alt="Avatar" style="width:200px">
								<?php
							}else{
								?>	
								<img id = "image" src="other_icon.png" alt="Avatar" style="width:200px">
								<?php
								}
								?>
						</div>
				
						<p id = "profile_full_name"> <?php echo $full_name ?></p>
			
						<h2 class = "profile_titles">Contact Information</h2>
						<p class = "profile_info"> <img src="email_icon.png" alt="email symbol" width="14" height="17"> <?php echo $email ?></p>
						<p class = "profile_info"> <img src="phone_icon.png" alt="phone symbol" width="14" height="17"> <?php echo $phone ?></p>
				
						<h2 class = "profile_titles">Personal Information</h2>
						<p class = "profile_info"> <img src="dob_icon.png" alt="dob symbol" width="14" height="17"> <?php echo $dob ?></p>
						<p class = "profile_info"> <img src="gender_icon.png" alt="gender symbol" width="14" height="17"> <?php echo $gender ?></p>
					</div>


				<?php
				} //This bracket ends the if statement where it checks if data is found within the database
		
				else{ //If the email and password is not found then execute whatever is in this else statement
				?>
					<a id = "forgot_info_link" href="Main.php">Please Log in</a>
				<?php	
					return 0;	
				}
			}		 //This bracket is the end of the if statement that checks if there was even a connection to the database
			else{ //No connection to the database
				echo 'Error: ' . mysqli_error();
			}
		}
?>    
	</body>
</html>