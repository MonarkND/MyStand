<?php
if($_POST)
{
establish_connections(); //This function establishes connection with the database
AddNews(); //This function will add news in newsdetail
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

function AddNews()
{
	//connection 
	global $con;
	
	//variable
	$headline=$_POST['NewsHeadline'];
	$image=$_POST['NewsPhoto'];
	$type=$_POST['NewsType'];
	$pollingquestion=$_POST['NewsPollingque'];
	$newsurl = $_POST['NewsURL'];
	//function main 
	$AddQuery="INSERT INTO newsdetails(Headline, HeadImage, Category, PollingQuestion, NewsURL) VALUES ('$headline','$image','$type','$pollingquestion', '$newsurl')";
	
	if(mysqli_query($con, $AddQuery))
		echo "You have added one news in database";
	else
	{	
		echo "some error"; 	
		mysqli_error($con);
	}
}
					
?>
<html>
	<head>
		<title>Add News | MyStand | Admin</title>
	</head>
	<body>
		<form action="" method="post">
		<table border="3" align="center">
			<tr>
				<td>Headline</td>
				<td><input type="text" id="NewsHeadline" name="NewsHeadline"/></td>
			</tr>
			<tr>
				<td>Images</td>
				<td><input type="text" id="NewsPhoto" name="NewsPhoto" /></td>
			</tr>
			<tr>
				<td>URL</td>
				<td><input type="text" id="NewsURL" name="NewsURL" /></td>
			</tr>
			<tr>
				<td>News Type</td>
				<td>
					<select id="NewsType" name="NewsType">
					<option value="Entrainment">Entrainment</option>
					<option value="Politics">Politics</option>
					<option value="Sports">Sports</option>
					<option value="Tech">Tech</option>
					<option value="Money">Money</option>
					<option value="Science">Science</option>
					<option value="Social">Social</option>
					<option value="Terrorist">Terrorist</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Polling Question</td>
				<td><input type="text" id="NewsPollingque" name="NewsPollingque"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Check" ></td>
			</tr>
		 	
		</table>
		</form>
	</body>
</html>