<?php
session_start();
$con = mysqli_connect("localhost","root","","clinic");

if(isset($_POST['stud_delete_multiple_btn']))
{
	if(!isset($_POST['stud_delete_id'])){
        header("Location: Patient_My_Appointments.php");
	}
    $all_id = $_POST['stud_delete_id'];
    $part1 = implode(',' , $all_id);
	$part2 = explode(",",$part1);
	
	$i = 0;
	while($i < count($part2)){
		$part3 = $part2[$i];
		$part4 = explode("||",$part3);
		
		$doctor_id = $part4[0];
		$patient_id = $part4[1];
		$day = $part4[2];
		$time = $part4[3];
		$doctor_occupation = $part4[4];
		
	
     $query = "DELETE FROM appointments WHERE doctor_id = '$doctor_id' AND patient_id = '$patient_id' AND day = '$day' AND time = '$time' AND doctor_occupation = '$doctor_occupation' ";
     $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Deleted Successfully";
        header("Location: Patient_My_Appointments.php");
    }
    else
    {
        $_SESSION['status'] = "Multiple Data Not Deleted";
        header("Location: Patient_My_Appointments.php");
    }
	
	$i++;
	}
}
else{
	echo "Does Not Exist";
}
?>