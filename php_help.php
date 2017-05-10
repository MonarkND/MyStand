<html>
	<head>
		<title>Hello</title>
	</head>	
	<body>
	<form action="" method="post"> 
		<button onclick="check">hello</button>
	</form>	
	</body>
</html>

<?php
/*define('DB_HOST', 'localhost'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 
define('DB_NAME', 'mystanddata'); 
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)  or die("Failed to connect to MySQL: " . mysql_error()); 

session_start();
	$DiscussionStatus = '0';
	$UserID = $_SESSION['SessionUserID'];
	$NewsID = '9';
	$FetchNewsQuery = 	"SELECT * FROM
							(
							SELECT 
							D.AskID, D.AskQuestion, D.AskTime, U.Name, U.UserID 
							FROM DiscussionAsk D, userinfo U 
							WHERE D.NewsID='$NewsID' AND D.UserID = U.UserID 
							AND D.AskID NOT IN (SELECT WhatID FROM reportgroup WHERE UserID = '$UserID' AND WhatReport = 'Ask')
							AND D.DiscussionStatus = '0'  LIMIT 50
							) 
							sub ORDER BY AskTime DESC"; 
							
							
							
							SELECT * FROM 
						(
							SELECT 
							D.AskID, D.AskQuestion, D.AskTime, U.Name, U.UserID 
							FROM DiscussionAsk D, userinfo U 
							WHERE D.NewsID='$NewsID' AND D.UserID = U.UserID 
								AND D.NewsID NOT IN (SELECT WhatID FROM reportgroup WHERE UserID = '$UserID' 
								AND WhatReport = 'Ask') AND D.DiscussionStatus = '0'  LIMIT 50
						) 
					  sub ORDER BY AskTime DESC";
	$FetchNewsResult = mysqli_query($con, $FetchNewsQuery);

	var_dump($FetchNewsQuery);
	if($FetchNewsResult)
	{
		while($row = mysqli_fetch_assoc($FetchNewsResult))
			$Ask[] = $row;	
	}

	var_dump($Ask);*/
?>

