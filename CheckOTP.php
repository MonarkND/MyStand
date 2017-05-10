<?php

if($_POST)
{
	session_start();
	establish_connections(); //This function establishes connection with the database
	otpcheck();//This function check user otp and verify email
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


function otpcheck()
{
	//connection prepration
	global $con;
	
	
	//Session variable
	$email=$_SESSION['SessionEmail'];
	
	
	//normal variable
	$UserEnterOTP=$_POST['userotp'];
	$newblock='00';
	
	//fetching variable
	$OTPQuery = "SELECT OTP, UserID FROM userinfo WHERE Email='$email'";
	$OPTResult = mysqli_query($con,$OTPQuery);
	$OTParray = mysqli_fetch_assoc($OPTResult);
	
	$SystemOTP = $OTParray['OTP'];
	$id = $OTParray['UserID'];
	$_SESSION['SessionUserID']=$id;			
			
	if($UserEnterOTP==$SystemOTP)
	{
		$BlockQuery="UPDATE userinfo SET BlockStatus='$newblock' WHERE Email='$email'";
		if(mysqli_query($con,$BlockQuery))
		{
			header("location:SelectInterested.php");
		}
		else 
			echo "<script>alert('Something went wrong');window.location.href='error.php';</script>";
	}
	else
	{
		echo "wrong password";
	}
	
}


?>


<!---<html>
	<head>
		<title>Enter OTP | My Stand</title>
	</head>
	<body>
<p align="center">We sent an email on your mail account</p>
<form action="" method="post">
<table align="center" border="1">
<tr>
<td>OTP</td>
<td><input type="number" max="9999" min="1000" name="userotp" id="userotp"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="Check"></td>
</tr>
</table>
</form>
</body>
</html>--->
<!DOCTYPE html>
<html >
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
		<p align="center" style="font-size:300%; color:Green">MyStand</p>
		<p align="center" style="font-size:200%; color:Green">Account help</p>

		
		<form action="" method="POST" id="msform">
  
		<fieldset>
			<h2 class="fs-title"><font color="green">Enter OTP</font></h2>
			<br>
			<input type="number" name="userotp" id="frgtemail" placeholder="OPT" />
			


		  
			<input type="submit" name="submit" class="submit action-button" value="Submit"/></fieldset>
		</form>
		<p align="center" style="font-size:200%; color:Green">We sent OTP on your Email ID</p>

  </body>
</html>
