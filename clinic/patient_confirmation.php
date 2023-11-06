<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="website.css">
</head>

<body>
	
	 <?php
 
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $conn = mysqli_connect("localhost", "root", "", "clinic");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
		
	// Taking all 5 values from the form data(input)
        $full_name =  $_REQUEST['full_name'];
        $password = $_REQUEST['password'];
        $email =  $_REQUEST['email'];
        $dob = $_REQUEST['dob'];
        $phone = $_REQUEST['phone'];
		$gender = $_REQUEST['gender'];
		
		 $query = "SELECT email FROM patient_registration WHERE email = '$email' ";
         $query_run  = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($query_run) > 0){
			?>
				<a id = "" href="Main.php">This User Already Exist. Click Here to go to main page</a>
			<?php
			return 0;
		}
		
		$sql = "INSERT INTO patient_registration (full_name,password,email,dob,phone,gender)  VALUES ('$full_name','$password','$email','$dob','$phone','$gender')";
         
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";
 
            echo nl2br("\n$full_name\n $password\n $email\n " . "$dob\n $phone\n $gender");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
         
        // Close connection
        mysqli_close($conn);
        ?>
	
</body>

</html>