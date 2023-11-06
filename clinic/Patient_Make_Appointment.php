<?php
session_start();
//echo ("{$_SESSION['id']}");
?>




<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="website.css">
		 
		 <script
		 src ="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		 
		 <link rel="stylesheet"
		 href = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/start/jquery-ui.css">
		 <script 
		 src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		 <script>
		 $(document).ready(function(){
		 $("#calender").datepicker({minDate:0,
               
                
                beforeShowDay: $.datepicker.noWeekends});
		 
		 
});
		 </script>
		 
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
				if (mysqli_num_rows($result) > 0){ //This if statement checks if the id is found within the database
		
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
			
				<form id = "patient_make_appointment_border" action = "patient_confirm_appointment.php" method = "POST" >
				
					<label for="doctor_title">Choose a Doctor:</label>
					<select name="doctor" id="doctor" required="">
					
						<optgroup label="Pediatric">
							<?php
								$qry = mysqli_query($conn,"SELECT * FROM doctor_registration WHERE doctor_occupation = 'Pediatric'");
								while ($reslt = mysqli_fetch_array($qry)){ ?>
									<option value="<?php echo $reslt["full_name"] ?> " > <?php echo $reslt["full_name"]." "."(".$reslt["gender"].")" ?> </option>
							<?php }
							?>
						</optgroup>
						<optgroup label="Primary Doctor">
							<?php
								$qry = mysqli_query($conn,"SELECT * FROM doctor_registration WHERE doctor_occupation = 'Primary Doctor'");
								while ($reslt = mysqli_fetch_array($qry)){ ?>
									<option value="<?php echo $reslt["full_name"] ?> " > <?php echo $reslt["full_name"]." "."(".$reslt["gender"].")" ?> </option>
							<?php }
							?>
						</optgroup>
						<optgroup label="Cardiologist">
							<?php
								$qry = mysqli_query($conn,"SELECT * FROM doctor_registration WHERE doctor_occupation = 'Cardiologist'");
								while ($reslt = mysqli_fetch_array($qry)){ ?>
									<option value="<?php echo $reslt["full_name"] ?> " > <?php echo $reslt["full_name"]." "."(".$reslt["gender"].")" ?> </option>
							<?php }
							?>
						</optgroup>
						<optgroup label="Orthopedic Physician">
							<?php
								$qry = mysqli_query($conn,"SELECT * FROM doctor_registration WHERE doctor_occupation = 'Orthopedic'");
								while ($reslt = mysqli_fetch_array($qry)){ ?>
									<option value="<?php echo $reslt["full_name"] ?> " > <?php echo $reslt["full_name"]." "."(".$reslt["gender"].")" ?> </option>
							<?php }
							?>
						</optgroup>
						<optgroup label="Nephrologist">
							<?php
								$qry = mysqli_query($conn,"SELECT * FROM doctor_registration WHERE doctor_occupation = 'Nephrologist'");
								while ($reslt = mysqli_fetch_array($qry)){ ?>
									<option value="<?php echo $reslt["full_name"] ?> " > <?php echo $reslt["full_name"]." "."(".$reslt["gender"].")" ?> </option>
							<?php }
							?>
						</optgroup>
						<optgroup label="Hematologist">
							<?php
								$qry = mysqli_query($conn,"SELECT * FROM doctor_registration WHERE doctor_occupation = 'Hematologist'");
								while ($reslt = mysqli_fetch_array($qry)){ ?>
									<option value="<?php echo $reslt["full_name"] ?> " > <?php echo $reslt["full_name"]." "."(".$reslt["gender"].")" ?> </option>
							<?php }
							?>
						</optgroup>
					</select>
				
					<label for = "date">Date of Appointment: </label>
					 <input id = "calender" type = "text" name = "calender" required="" /> 
					
					
					<label for="time_title">Choose a time:</label>
					<select name="time" id="time" required="">
						<optgroup label="Morning Hours">
							<option value="7:00AM-7:30AM">7:00AM - 7:30AM</option>
							<option value="7:30AM-8:00AM">7:30AM - 8:00AM</option>
							<option value="8:00AM-8:30AM">8:00AM - 8:30AM</option>
							<option value="8:30AM-9:00AM">8:30AM - 9:00AM</option>
							<option value="9:00AM-9:30AM">9:00AM - 9:30AM</option>
							<option value="9:30AM-10:00AM">9:30AM - 10:00AM</option>
							<option value="10:00AM-10:30AM">10:00AM - 10:30AM</option>
							<option value="10:30AM-11:00AM">10:30AM - 11:00AM</option>
							<option value="11:00AM-11:30AM">11:00AM - 11:30AM</option>
							<option value="11:30AM-12:00AM">11:30AM - 12:00AM</option>
						</optgroup>
						<optgroup label="Afternoon Hours">
							<option value="1:00AM-1:30AM">1:00AM - 1:30AM</option>
							<option value="1:30AM-2:00AM">1:30AM - 2:00AM</option>
							<option value="2:00AM-2:30AM">2:00AM - 2:30AM</option>
							<option value="2:30AM-3:00AM">2:30AM - 3:00AM</option>
							<option value="3:00AM-3:30AM">3:00AM - 3:30AM</option>
							<option value="3:30AM-4:00AM">3:30AM - 4:00AM</option>
							<option value="4:00AM-4:30AM">4:00AM - 4:30AM</option>
							<option value="4:30AM-5:00AM">4:30AM - 5:00AM</option>
							<option value="5:00AM-5:30AM">5:00AM - 5:30AM</option>
							<option value="5:30AM-6:00AM">5:30AM - 6:00AM</option>
						</optgroup>
					</select>
				
					<button id = "make_appointment_button">Confirm Appointment</button>
					
				</form>
			


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