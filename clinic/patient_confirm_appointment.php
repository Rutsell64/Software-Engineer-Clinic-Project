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
			$doctor_name = $_POST['doctor'];
			$day =  $_POST['calender'];
			$time = $_POST["time"];
			
			$qry = "SELECT * FROM doctor_registration WHERE full_name = '$doctor_name'";
			$reslt = $conn->query($qry);
			if($reslt->num_rows > 0){
				$row = $reslt->fetch_assoc();
				$doctor_id = $row["doctor_id"];
				$doctor_occupation = $row["doctor_occupation"];
			}
			
			//echo $patient_id. " " . $doctor_name . " " . $day . " " . $time . " " . $doctor_id . " " . $doctor_occupation;
			
			$query1 = mysqli_query($conn,"SELECT * FROM appointments WHERE doctor_id = '$doctor_id' AND patient_id = '$patient_id' AND day = '$day' AND time = '$time' AND doctor_occupation = '$doctor_occupation' ");
			$query2 = mysqli_query($conn,"SELECT * FROM appointments WHERE patient_id = '$patient_id' AND day = '$day' AND time = '$time' ");
			$query3 = mysqli_query($conn,"SELECT * FROM appointments WHERE patient_id = '$patient_id' AND day = '$day' AND doctor_occupation = '$doctor_occupation' ");
			$query4 = mysqli_query($conn,"SELECT * FROM appointments WHERE doctor_id = '$doctor_id' AND day = '$day' AND time = '$time' AND doctor_occupation = '$doctor_occupation' ");
			
				if (mysqli_num_rows($query1) > 0){ //This if statement checks if the email and password is found within the database
		
					 
					?>
					<a  href="Patient_Make_Appointment.php">This appointment already exist</a>
					<?php

				
				} //This bracket ends the if statement where it checks if data is found within the database
				elseif(mysqli_num_rows($query2) > 0){
					?>
					<a  href="Patient_Make_Appointment.php">Could not make the appointment. You already have another appointment at that time and date</a>
					<?php
				}
				elseif(mysqli_num_rows($query3) > 0){
					?>
					<a  href="Patient_Make_Appointment.php"> Could not make the appointment. You already have another appointment with a(n) <?php echo $doctor_occupation ?> in that same day</a>
					<?php
				}
				elseif(mysqli_num_rows($query4) > 0){
					?>
					<a  href="Patient_Make_Appointment.php"> Could not make the appointment. Someone else already made an appointment with Doctor <?php echo $doctor_name ?> at that time and date </a>
					<?php
				}
				else{ 
					
					$sql = "INSERT INTO appointments VALUES ('$doctor_id','$patient_id','$day','$time','$doctor_occupation')";
         
					if(mysqli_query($conn, $sql)){
					echo "Your appointment was successfully, go back to the last page";
					

					}else{
						echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
					}
						
					return 0;	
				}
			
			
		}
?>    
	</body>
</html>