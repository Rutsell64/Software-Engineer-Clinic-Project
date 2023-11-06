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
			$doctor_id = $_SESSION['id'];
			
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
							Your Doctor ID: <?php echo $doctor_id ?>
						</p>
					</div>
					
				<div id = "Delete_Appointment_Border">
					<form action="Doctor_My_Appointments_Confirm.php" method="POST">
                            <table >
                                <tbody>
                                    <tr>
                                        <th id = "Delete_Button_Border">
                                            <button id = "Delete_Button" type="submit" name="stud_delete_multiple_btn"> Delete </button>
                                        </th>
                                        <th id = "medication_title">Patient</th>
                                        <th id = "Time_Title">Date</th>
                                        <th id = "Service_Title">Time</th>
                                        
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php
										
                                        $query = "SELECT * FROM appointments WHERE doctor_id = '$doctor_id' ";
                                        $query_run  = mysqli_query($conn, $query);
										
										

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
												$value = $row['doctor_id']."||".$row['patient_id']."||".$row['day']."||".$row['time']."||".$row['doctor_occupation'] ;
												
												$patient_id = $row['patient_id'];
												$qry = "SELECT * FROM patient_registration WHERE patient_id = '$patient_id' ";
												$reslt = $conn->query($qry);
												
												if($reslt->num_rows > 0){
													
													$rows = $reslt->fetch_assoc();
													$patient_name = $rows["full_name"];
													
											
												}
												
												
                                                ?>
                                                <tr>
                                                    <td id = "checkbox_border">
                                                        <input id = "checkbox" type="checkbox" name="stud_delete_id[]" value="<?= $value?>">
                                                    </td>
                                                    <td id = "medication"><?= $patient_name; ?></td>
                                                    <td id = "dosages"><?= $row['day']; ?></td>
                                                    <td id = "instructions"><?= $row['time']; ?></td>
													
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
					
		}
?>    
	</body>
</html>