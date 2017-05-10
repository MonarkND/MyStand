<?php
	define('DB_HOST', 'localhost'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	define('DB_NAME', 'mystanddata'); 
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)  or die("Failed to connect to MySQL: " . mysql_error()); 
	
	session_start();
	if(!isset($_GET['NewsID']) || !isset($_GET['PollAns']))
		header("location:error.php");
	
	$UserID = $_SESSION['SessionUserID'];
	$NewsID = $_GET['NewsID'];
	$PollAns = $_GET['PollAns'];
	$Time = localtime();
	$Year = $Time[5]+1900;
	$PollTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
	
	$NotAgainQuery = "SELECT count(*) FROM pollans WHERE UserID = '$UserID' AND NewsID = '$NewsID'";
	$NotAgain = mysqli_fetch_row(mysqli_query($con, $NotAgainQuery));

	
	if(!$NotAgain)
	{
		$InsertVoteQuery  = "INSERT INTO pollans (NewsID, UserID, PollPoint, PollTime) VALUES ('$NewsID', '$UserID', '$PollAns', '$PollTime')";
		$InsertVoteResult = mysqli_query($con, $InsertVoteQuery);
	}
	else
	{
		$RepeatQuery = "UPDATE p	ollans SET PollPoint='$PollAns' WHERE UserID = '$UserID' AND NewsID = '$NewsID'";
		$RepeatVoteResult = mysqli_query($con, $RepeatQuery);
	}	
	$TotalVoteQuery = "SELECT count(*) FROM pollans WHERE NewsID='$NewsID'";
	$TotalVote = mysqli_fetch_row(mysqli_query($con, $TotalVoteQuery))[0];
	$TotalYesVoteQuery = "SELECT count(*) FROM pollans WHERE NewsID='$NewsID' AND PollPoint='1'";
	$TotalYesVote = mysqli_fetch_row(mysqli_query($con, $TotalYesVoteQuery))[0];
	$YesPer = round(($TotalYesVote/$TotalVote)*100);
	$NoPer= round(100-$YesPer);
	echo "<table><tr><td>Yes</td><td>{$YesPer}%</td></tr><tr><td>No</td><td>{$NoPer}%</td></tr>";

?>