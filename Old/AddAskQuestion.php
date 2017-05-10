<?php
if($_POST)
{
	establish_connections(); //This function establishes connection with the database
	NewAskQue();               //This function adds the new user
	global $con;
}


function establish_connections()
{
	global $con;
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'mystanddata'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error()); 
}

function NewAskQue()
{
	//variable
	global $con;
	session_start();
	
	$UserID = $_SESSION['SessionUserID'];
	
	$NewsID = $_POST['NewsID'];
	$AskQue = $_POST['AskQustion'];
	$Time = localtime();
	$Year = $Time[5]+1900;
	$AskTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
 	
	if($AskQue!=NULL)
	{
		$AskQuery = "INSERT INTO DiscussionAsk (NewsID, UserID, AskQuestion, AskTime) VALUES ('$NewsID', '$UserID', '$AskQue', '$AskTime')";
		$AskResult = mysqli_query($con , $AskQuery);	
	}
	header("location:Discussion.php?NewsID={$NewsID}");	
}


?>