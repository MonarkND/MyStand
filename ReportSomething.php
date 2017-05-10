<?php
	define('DB_HOST', 'localhost'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	define('DB_NAME', 'mystanddata'); 
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)  or die("Failed to connect to MySQL: " . mysql_error()); 
	
	session_start();
	$UserID = $_SESSION['SessionUserID'];
	$Type= $_GET['Type'];
	$ID = $_GET['WhatID'];
	$Time = localtime();
	$Year = $Time[5]+1900;
	$Time[4] = ($Time[4] + 1);
	$ReportTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
	
	$NotAgainQuery = "SELECT * FROM reportgroup WHERE  UserID = '$UserID' AND WhatID = '$ID' AND WhatReport='$Type'";
	$NotAgainResult = mysqli_query($con, $NotAgainQuery);
	$NotAgain = mysqli_fetch_row($NotAgainResult);
	
	if(!$NotAgain)
	{
		$ReportQuery = "INSERT INTO reportgroup(WhatReport, UserID, WhatID, ReportTime) VALUES ('$Type','$UserID','$ID','$ReportTime')";
		$ReportResult = mysqli_query($con, $ReportQuery);
	}
?>
