<?php

if($_POST)
{
	establish_connections(); //This function establishes connection with the database
	FrgtChangePass(); //this function send otp on email id 
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

function FrgtChangePass()
{
	//connection
	global $con;
	session_start();
	
	//variable
	$email=$_SESSION['SessionEmail'];
	$UserOTP=$_POST['UserOTP'];
	$NewPassword=$_POST['NewPassword'];
	
	//fetching variable
	$OTPQuery = "SELECT OTP FROM userinfo WHERE Email='$email'";
	$SystemOTP = mysqli_fetch_row(mysqli_query($con,$OTPQuery))[0];
	
	//main work
	if($UserOTP==$SystemOTP)
	{
		$ChangePasswordQuery="UPDATE userinfo SET Password='$NewPassword' WHERE Email='$email'";
		if(mysqli_query($con,$ChangePasswordQuery))
		{
			$_SESSION['SessionEmail']=NULL;
			header("location: Login.php");
		}
		else 
		{
			echo "SORRY we can't cahnge your password";
		}
	}
	else
	{
		echo "Wrong OTP";
	}
	
}


?>

<!----<html>
	<head>
		<title>Forget Password | MyStand </title>
	</head>
	<body>
		<form action="" method="post">
			<table border="1" align="center">
				<tr>
					<td>OTP</td>
					<td><input type="number" name="UserOTP" max="9999" min="1000"></td>
				</tr>
				<tr>
					<td>New Password</td>
					<td><input type="password" name="NewPassword" maxlength="16"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Submit"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>--->



<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style>
			p 
			{
				font-size: 40px;
			}
		</style>
		<link rel="stylesheet" href="css/frgt1-style.css">    
	</head>
	<body>
		<br><br><br>
		
		<p align="center" style="font-size:300%; color:Green">MyStand</p><br>
		<p align="center" style="font-size:200%; color:Green">Account help</p>
		
		
		<form id="msform" action="" method="POST">
			<fieldset>
				<h2 class="fs-title"><font color="green">Find Your Account</font></h2>
				<br>
				<input type="number" name="UserOTP" max="9999" min="1000" placeholder="OTP" />
				<input type="password" name="NewPassword" maxlength="16" placeholder="New Password" />
				<input type="submit" name="submit" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
		
		<p align="center" style="font-size:200%; color:Green">We have sent OTP to your Email ID
	</body>
</html>
