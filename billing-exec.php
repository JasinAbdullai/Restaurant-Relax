<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	

	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$StreetAddress = clean($_POST['sAddress']);
	$BoxNo = clean($_POST['box']);
	$City = clean($_POST['city']);
	$MobileNo = clean($_POST['mNumber']);
	$LandlineNo = clean($_POST['lNumber']);
	// check if the 'id' variable is set in URL

	// check if the 'id' variable is set in URL
	if (isset($_GET['id']))
	{
	// get id value
	$id = $_GET['id'];

	//Create INSERT query
	$qry = "INSERT INTO billing_details(member_id,Street_Address,P_O_Box_No,City,Mobile_No,Landline_No) VALUES('$id','$StreetAddress','$BoxNo','$City','$MobileNo','$LandlineNo')";
	@$link->query($qry);
	
	//redirect to billing-success page
	header("location: billing-success.php");
	}else {
		die("Adding billing information failed! Please try again after a few minutes.");
	}
?>