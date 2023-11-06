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
			
			$query = "SELECT * FROM doctor_registration WHERE doctor_id = '$id'";
	
			

?>		
				<div id = "side_directory">
			
					<p id = "side_clinic_name"> Springfield All Clinic <img src="medical_symbol.png" alt="medical symbol" width="35" height="30"> </p>
					<p id = "side_profile"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href= "Doctor_Profile.php">Profile</a> </p>
					<p id = "side_add_medication"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href="Doctor_Add_Medication.php">Add Patient Medication</a> </p>
					<p id = "side_patient_medication_list"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href="Doctor_Patient_Medication.php">Patient's Medication List</a> </p>
					<p id = "side_doctor_appointment"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href="Doctor_My_Appointments.php">My Appointments</a> </p>
					<p id = "side_logout"> <img src="person-icon.jpg" alt="medical symbol" width="30" height="20"> <a href="logout.php">Logout</a> </p>

				</div>
			
					<div id = "patient_id_border">
						<p id = "patient_id">
							Your Doctor ID: <?php echo $id ?>
						</p>
					</div>
			
				<div id = "profile_border">
					<form action = "patient_confirm_medication.php" method = "POST" >
				
					<label class = "add_medication_title" for = "patient_id_title"> Enter patient's ID	</label>
					<input type = "text" id = "enter_patient_id" name = "enter_patient_id" required="">
					
					<label class = "add_medication_title"  for = "medication_title"> Enter the medication name </label>
					<input type = "text" id = "enter_medication" name = "enter_medication" required="">
					
					<label class = "add_medication_title"  for = "medication_dosage_title"> Enter the dosage of the medicine </label>
					<input type = "text" id = "enter_dosage" name = "enter_dosage" required="">
					
					<label class = "add_medication_title"  for = "medication_instruction_title"> Enter the instructions of the medicine </label>
					<input type = "text" id = "enter_instruction" name = "enter_instruction" required="">
				
					<button id = "add_medication_button">Add Medication</button>
					
					</form>
				</div>


				<?php
		} //This bracket ends the if statement where it checks if data is found within the database
		
?>    
	</body>
</html>