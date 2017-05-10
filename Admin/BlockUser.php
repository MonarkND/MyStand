<?php
if($_POST)
{
	establish_connections(); //This function establishes connection with the database
	BlockUser(); //this function block the user
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

function BlockUser()
{
	//connection
	global $con;
	
	//variable
	$UserEmail=$_POST['UserEmail'];
	
	//query
	$BlockUserQuery = "SELECT BlockStatus FROM userinfo WHERE Email='$UserEmail'";
	$BlockUserResult = mysqli_fetch_row(mysqli_query($con,$BlockUserQuery))[0];
	
	if($BlockUserResult!=1)
	{
		$BlockUpdate = "UPDATE userinfo SET BlockStatus='1' WHERE Email='$UserEmail'";
		if(mysqli_query($con,$BlockUpdate))
		{
			echo "User has been blocked";
		}
		else
		{
			echo "Some error happend";
		}
	}
	else
	{
		echo "User is alredy blocked";
		?>
		<html>
			<body>
			<a href="UnBlockUser.php">
			<h4>UnBlock the user</h4></a>			
			</body>
		</html>
		<?php
	}
}

?>
<html>
	<head>
		<title>Block User | My Stand Admin</title>
	</head>
	<body>
		<form action="" method="post">
			<table align="center" border="1">
				<tr>
					<td>Email</td>
					<td><input type="email" maxlength="255" name="UserEmail"/></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Block"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>