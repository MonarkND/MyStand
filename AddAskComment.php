<?php
	define('DB_HOST', 'localhost'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	define('DB_NAME', 'mystanddata'); 
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)  or die("Failed to connect to MySQL: " . mysql_error()); 
	
	session_start();
	$UserID = $_SESSION['SessionUserID'];
	$AskID = $_GET['AskID'];
	$CommentWord = $_GET['CommentWord'];
	$Time = localtime();
	$Year = $Time[5]+1900;
	$CommentTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
	if($CommentWord!=null)
	{
		$InsertCommentQuery  = "INSERT INTO AskComments(AskID, UserID, CommentWord, CommentTime) VALUES ('$AskID', '$UserID', '$CommentWord', '$CommentTime')";
		$InsertCommentResult = mysqli_query($con, $InsertCommentQuery);
		$InsertNameQuery = "SELECT Name FROM userinfo WHERE UserID='$UserID'";
		$InsertName= mysqli_fetch_row(mysqli_query($con, $InsertNameQuery))[0];
		if($InsertCommentResult)
		{
			echo"<div>
			<h5 style='font-color:black;' class='fs-subtitle' align='right'>{$CommentTime}</h5>
			<h5 style='font-color:black;' class='fs-subtitle' align='left'>{$InsertName}</h5>
			<div>
			<p>{$CommentWord}</p> 							
			</div>
			</div>
			<hr>";
		}
	}
?>