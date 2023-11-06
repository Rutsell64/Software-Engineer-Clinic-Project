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
			$patient = $_POST['enter_patient'];
			
			$query = "SELECT * FROM doctor_registration WHERE doctor_id = '$id'";
	
			$q = "SELECT patient_id FROM patient_registration WHERE patient_id = '$patient' ";
			$query_runs  = mysqli_query($conn, $q);
		
			if(mysqli_num_rows($query_runs) < 1){
				?>
					<a id = "" href="Doctor_Patient_Medication.php">Incorrect patient id. Click here to go back</a>
				<?php
			return 0;
			}
			

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
				
				
				<div id = "Delete_Appointment_Border">
					<form action="Doctor_Delete_Medication.php" method="POST">
                            <table >
                                <tbody>
                                    <tr>
                                        <th id = "Delete_Button_Border">
                                            <button id = "Delete_Button" type="submit" name="stud_delete_multiple_btn" >Delete</button>
                                        </th>
                                        <th id = "medication_title">Medication</th>
                                        <th id = "dosages_title">Dosages</th>
                                        <th id = "instructions_title">Instructions</th>
                                     
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php
									
										$patient_id = $_POST['enter_patient'];
                                        $query = "SELECT * FROM patient_medication_list WHERE patient_id = '$patient_id' ";
                                        $query_run  = mysqli_query($conn, $query);
									
                                        
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
												$value = $row['patient_id']."||".$row['medication']."||".$row['dosages']."||".$row['instructions'];
								
                                                ?>
                                                <tr>
                                                    <td id = "checkbox_border">
                                                        <input id = "checkbox" type="checkbox" name="stud_delete_id[]" value="<?= $value?>">
                                                    </td>
                                                    <td id = "medication"><?= $row['medication']; ?></td>
                                                    <td id = "dosages"><?= $row['dosages']; ?></td>
													<td id = "instructions"><?= $row['instructions']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="5">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                    </form>
				</div>	
				
				


				<?php
		} //This bracket ends the if statement where it checks if data is found within the database
		
?>    
	</body>
</html>