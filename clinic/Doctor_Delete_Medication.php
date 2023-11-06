<?php
session_start();
$con = mysqli_connect("localhost","root","","clinic");

if(isset($_POST['stud_delete_multiple_btn']))
{
	if(!isset($_POST['stud_delete_id'])){
        header("Location: Doctor_Patient_Medication.php");
	}
    $all_id = $_POST['stud_delete_id'];
    $part1 = implode(',' , $all_id);
	$part2 = explode(",",$part1);
	
	$i = 0;
	while($i < count($part2)){
		$part3 = $part2[$i];
		$part4 = explode("||",$part3);
		
		$patient_id = $part4[0];
		$medication = $part4[1];
		$dosages = $part4[2];
		$instructions = $part4[3];
		
     $query = "DELETE FROM patient_medication_list WHERE patient_id = '$patient_id' AND medication = '$medication' AND dosages = '$dosages' AND instructions = '$instructions' ";
     $query_run = mysqli_query($con, $query);

    if($query_run)
    {

        $_SESSION['status'] = "Multiple Data Deleted Successfully";
        header("Location: Doctor_Patient_Medication.php");
    }
    else
    {
        $_SESSION['status'] = "Multiple Data Not Deleted";
        header("Location: Doctor_Patient_Medication.php");
    }
	
	$i++;
	}
}
else{
	echo "Does Not Exist";
}
?>