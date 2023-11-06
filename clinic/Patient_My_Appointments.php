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
			$patient_id = $_SESSION['id'];
			
			$query = "SELECT * FROM patient_registration WHERE patient_id = '$patient_id'";
	
			

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
					
				<div id = "Delete_Appointment_Border">
					<form action="Patient_Delete_Appointments.php" method="POST">
                            <table >
                                <tbody>
                                    <tr>
                                        <th id = "Delete_Button_Border">
                                            <button id = "Delete_Button" type="submit" name="stud_delete_multiple_btn" >Delete</button>
                                        </th>
                                        <th id = "Doctor_Title">Doctor</th>
                                        <th id = "Date_Title">Date</th>
                                        <th id = "Time_Title">Time</th>
                                        <th id = "Service_Title">Service</th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php
										$patient_id = $_SESSION['id'];
                                        $query = "SELECT * FROM appointments WHERE patient_id = '$patient_id' ";
                                        $query_run  = mysqli_query($conn, $query);
										
										

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
												$value = $row['doctor_id']."||".$row['patient_id']."||".$row['day']."||".$row['time']."||".$row['doctor_occupation'] ;
												
												$doctor_id = $row['doctor_id'];
												$qry = "SELECT * FROM doctor_registration WHERE doctor_id = '$doctor_id' ";
												$reslt = $conn->query($qry);
												
												if($reslt->num_rows > 0){
													
													$rows = $reslt->fetch_assoc();
													$doctor_name = $rows["full_name"];
													
											
												}
												
												
                                                ?>
                                                <tr>
                                                    <td id = "checkbox_border">
                                                        <input id = "checkbox" type="checkbox" name="stud_delete_id[]" value="<?= $value?>">
                                                    </td>
                                                    <td id = "Doctor_Name"><?= $doctor_name; ?></td>
                                                    <td id = "Day"><?= $row['day']; ?></td>
                                                    <td id = "Time"><?= $row['time']; ?></td>
													<td id = "Doctor_Occupation"><?= $row['doctor_occupation']; ?></td>
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