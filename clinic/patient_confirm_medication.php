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
				
				<?php
					if(!isset($_POST['enter_patient_id']) && !isset($_POST['enter_medication']) && !isset($_POST['enter_dosage']) && !isset($_POST['enter_instruction'])) {
				?>
					<a id = "" href="Doctor_Add_Medication.php">They is no data to store. Try again</a>
				<?php
						return 0;
					}
					
										$doctor_id = $_SESSION['id'];
										$patient_id = $_POST['enter_patient_id'];
										$medication_id = $_POST['enter_medication'];
										$dosages = $_POST['enter_dosage'];
										$instructions = $_POST['enter_instruction'];
										
                                        $query = "SELECT patient_id FROM patient_registration WHERE patient_id = '$patient_id' ";
                                        $query_run  = mysqli_query($conn, $query);
										
										$query2 = "SELECT * FROM patient_medication_list WHERE patient_id = '$patient_id' AND medication = '$medication_id' ";
                                        $query_run2 = mysqli_query($conn, $query2);
										
                                        if(!mysqli_num_rows($query_run) > 0)
                                        {
											?>
											<a id = "center" href="Doctor_Add_Medication.php">Incorrect Patient ID. Try again</a>
										<?php
											return 0;
                                        }
										elseif(mysqli_num_rows($query_run2) > 0)
                                        {
											?>
											<a id = "center" href="Doctor_Add_Medication.php">This medication already exist for the patient. </a>
										<?php
											return 0;
                                        }
										else{
											$sql = "INSERT INTO patient_medication_list VALUES ('$patient_id','$medication_id','$dosages','$instructions')";
										if(mysqli_query($conn, $sql)){
										?>
											<a id = "center" href="Doctor_Add_Medication.php">Successfully Added. Click Here to add another medication </a>
										<?php
												
											} else{
											echo "ERROR: Hush! Sorry $sql. "
											. mysqli_error($conn);
											}
										}
										
										
										
										
					
					
					
					
				?>
				
				
				<div id = "profile_border">
					
					
					
					
				</div>


				<?php
		} //This bracket ends the if statement where it checks if data is found within the database
		
?>    
	</body>
</html>