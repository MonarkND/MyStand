<?php
	define('DB_HOST', 'localhost'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	define('DB_NAME', 'mystanddata'); 
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)  or die("Failed to connect to MySQL: " . mysql_error()); 
	
	$AskID = $_GET['AskID'];
	
	$ViewQuery = "SELECT  U.Name, A.CommentWord, A.CommentTime FROM AskComments A, userinfo U WHERE A.AskID='$AskID' AND U.UserID = A.UserID ORDER BY CommentTime DESC";
	$ViewResult = mysqli_query($con,$ViewQuery);
	
	while($ViewRow = mysqli_fetch_assoc($ViewResult))
	{	
		echo"<div>
			<h5 style='font-color:black;' class='fs-subtitle' align='right'>{$ViewRow['CommentTime']}</h5>
			<h5 style='font-color:black;' class='fs-subtitle' align='left'>{$ViewRow['Name']}</h5>
			<div>
				<p>{$ViewRow['CommentWord']}</p> 							
			</div>
		</div>
		<hr>";
	}
?>