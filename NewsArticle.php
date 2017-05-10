<?php

	if($_GET)
	{
		establish_connections(); //This function establishes connection with the database
		GoToArticle(); //This function will add news in newsdetail
		global $con;
	}

	function establish_connections()
	{
		global $con;
		define('DB_HOST', 'localhost'); 
		define('DB_NAME', 'mystanddata'); 
		define('DB_USER','root'); 
		define('DB_PASSWORD',''); 
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
	}
	
	function GoToArticle()
	{
		//connection
		global $con;
		session_start();
		//variable
		$NewsID=$_GET['NewsID'];
		$UserID=$_SESSION['SessionUserID'];
		$Time = localtime();
		$Year = $Time[5]+1900;
		$Entrytime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
 		
		//main query
		$EntryQuery = "INSERT INTO `newsreader` (NewsID, UserID, Time) VALUES ('$NewsID', '$UserID', '$Entrytime')";
		$EntryResult=mysqli_query($con, $EntryQuery);
		
		
		$AddressQuery = "SELECT NewsURL FROM newsdetails WHERE NewsID = '$NewsID'";
		$AddressResult = mysqli_query($con, $AddressQuery);
		$Address = mysqli_fetch_row($AddressResult)[0];
		
		//main
		if($AddressResult)
			header("Location: $Address");
		
	}
?>