<?php
	define('DB_HOST', 'localhost'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	define('DB_NAME', 'mystanddata'); 
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)  or die("Failed to connect to MySQL: " . mysql_error()); 
	
	
	$NewsID = $_GET['NewsID'];
	session_start();
	
	$UserID = $_SESSION['SessionUserID'];
	$AskQue = $_GET['AskQustion'];
	$Time = localtime();
	$Year = $Time[5]+1900;
	$AskTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
 	$Status = '0';
	if($AskQue!=NULL)
	{
		$AskQuery = "INSERT INTO discussionask(NewsID, UserID, AskQuestion, AskTime, DiscussionStatus) VALUES ('$NewsID','$UserID','$AskQue','$AskTime','$Status')";
		$AskResult = mysqli_query($con , $AskQuery);

		//$insert_id = mysqli_insert_id($con);
		/*print "<br>
			<table border='1' style='width:25%' class='YourAsk EveryAsk' align='center'>
			<tr><td colspan='2'><p> {$AskQue}</p></td></tr>
			<tr><td colspan='2' align='right'>At {$AskTime}</td></tr>
			<tr><td colspan='2' align='left'>By {$UserID}</td></tr>
			<tr>
				<td width='50%' align='center'><button onclick='opencomments({$insert_id})'>Comments</button></td>
				<td align='center'><a href='DeleteAsk.php?AskID={$insert_id}'><button>Delete</button></a></td>
			</tr>
			</table>";*/		
	}
	header("location:Discussion.php?NewsID={$NewsID}");
		
?>