<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	
	/
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($str);
	}
		
	//checks whether submit is set
	if(isset($_POST['Submit']))
	{
	    $member_id = $_SESSION['SESS_MEMBER_ID']; //gets member id from session
        $food_id = clean($_POST['food']); //gets food id and sanitizes post value
        $scale_id = clean($_POST['scale']); //gets scale id and sanitizes post value
        
        //check whether there is duplication in the polls_details table
        $check = @$link->query("SELECT * FROM polls_details WHERE member_id='$member_id' AND food_id='$food_id'") or die("Something is wrong.\n Our team is working on it at the moment.\n Please try again after some few minutes.");
        
        if(mysqli_num_rows($check)>0){
            header("location: ratings-failed.php");
        }
        else{
	        //Create INSERT query
	        $qry = "INSERT INTO polls_details(member_id,food_id,rate_id) VALUES('$member_id','$food_id','$scale_id')";
	        @$link->query($qry);
	        
            if($qry){
	            header("location: ratings-success.php");
            }
            else{
                die("Rating failed! Please try again after some few minutes.");
            }
        }

	}else {
		die("Rating failed! Please try again after some few minutes.");
	}
?>