<?php
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'mystanddata'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 

	//variable
	session_start();
	$userid = $_SESSION['SessionUserID'];
	$AskID = $_GET['AskID'];
	
	$CheckUserQuery = "SELECT UserID FROM discussionask WHERE AskID = '$AskID'";
	$CheckUserResult = mysqli_fetch_row(mysqli_query($con, $CheckUserQuery));
	$DeleteStatus = '1';
	
	if($CheckUserResult[0] == $userid)
	{
		$DeleteAskQuery = "UPDATE discussionask SET DiscussionStatus = '$DeleteStatus' WHERE AskID = '$AskID'";
		$DeleteAskResult = mysqli_query($con, $DeleteAskQuery);
		
		$Time = localtime();
		$Year = $Time[5]+1900;
		$DeleteTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
 	
		$DeleteInsertQuery  = "INSERT INTO DeleteGroup(WhatDelete, WhatID, DeleteTime, UserID ) VALUES ('Ask','$AskID','$DeleteTime','$userid')";
		$DeleteInsertResult = mysqli_query($con, $DeleteInsertQuery);
	}
?>