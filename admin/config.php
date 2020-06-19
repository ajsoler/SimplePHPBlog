<?php	
//Store log in infor into variables
		$servername = 'localhost';
		$serveruser = 'admin';
		$serverpassword = 'password';
		$serverdatabase = 'simplephpblog';

		// Create connection
		$conn = mysqli_connect( $servername, $serveruser, $serverpassword, $serverdatabase );
		
		// Display error message if fails;
		if ( !$conn ) {echo "Connection Fail" . mysqli_connect_error();}

//End  connection
?>