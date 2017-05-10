<!Doctype HTML>

<?php
if($_POST)
{
	session_start();	
	establish_connections(); //This function establishes connection with the database
	logincheck(); //This function will check user email and password and add session
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

function ipDetailsFetch($id, $blockStatus)//this function will enter ip and userid into databse on every time you login
{
	//connection
	global $con;
	
	//$IPaddress = $_SERVER['REMOTE_ADDR'];
	$IPaddress = '27.251.37.55';
	$Time = localtime();
	$Year = $Time[5]+1900;
	$LoginTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
 	
	$IPinsertQuery = "INSERT INTO logindetails(UserID, IPaddress, BlockStatus, LoginTime) VALUES ('$id','$IPaddress','$blockStatus','$LoginTime')";
	$IPresult = mysqli_query($con, $IPinsertQuery);
}

function logincheck()
{
	//variable
	$email = $_POST['useremail'];
	$password = $_POST['userpass']; 
	
	//connection
	global $con;
	
	//validate input
	
	
	//Login fetching part
	$check = 0;
	$query = "SELECT * FROM userinfo WHERE Password='$password' AND Email='$email'";
	$result = mysqli_query($con,$query);
	
	if($result)
	{ 
		while($row=mysqli_fetch_assoc($result))
		{
			if($email==$row['Email']&& $password==$row['Password'])
			{
				$id=$row['UserID'];
				$blockStatus=$row['BlockStatus'];
				$check=1;
				//ipDetailsFetch($id, $blockStatus);
			}
		}
	}
		
			
	if($check==0)
	{
		echo "Invalid Details";
	}
	else if($check == 1)
	{
		if($blockStatus==11)
		{	
			$_SESSION['SessionUserID']=$id;
			$_SESSION['SessionEmail']=$email;
			header("location:CheckOTP.php");
		}
		else if($blockStatus==00)
		{
			$_SESSION['SessionUserID']=$id;
			$_SESSION['SessionEmail']=$email;
			header("location:Newsfeed.php");
		}
		else if($blockStatus==1)
		{
			echo "<script>alert('Block')</script>>";
		}
	}
}

?>
<!---------<html>
	<head>
		<title>Sign In |My stand</title>
	<style>
	</style>
	</head>
	<body>
		<h1 align="center">Login</h1>
		<div id="MainLogin">
			<form action="" method="post">
				<div>
					User Name
				</div>
				<div>	
					<input type="text" maxlength="255" Id="UserName" name="useremail">
				</div>	
				<br>
				<div>
					Password
				</div>
				<div>		
					<input type="text" maxlength="20" id="Password" name="userpass">
				</div>
				<br>	
				<div>		
					<input type="submit" value="Login">		
					<input type="reset" value="Reset">
				</div>
			</form>
		</div>
		<a href="ForgetPassword.php">
			<h4>Forget Password?</h4>
		</a>
		<a href="Register.php">
			<h4>Don't have account sign up</h4>
		</a>
	</body>
</html>--->
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
	a:link {
    color: white;
    background-color: transparent;
    text-decoration: none;
}
	</style>   
        <link rel="stylesheet" href="css/login-style.css">
  </head>
  <body onload='document.firstform.user.focus()'>
    <div class="wrapper">
	<div class="container">
		<h1>Welcome to My Stand</h1>
		
		<form action="" class="form" name="firstform" method="post">
			<input type="text" placeholder="Username" name="useremail" >
			<input type="password" placeholder="Password" name="userpass">
			<button type="submit" id="login-button" onclick="ValidateEmail(document.firstform.user)">Login</button><br><br>
			<a href="ForgetPassword.php">Forgot Password</a><br>
			<a href="Register.php">Sign Up</a></button>
		</form>
	</div>
</div>

<script>
function ValidateEmail(inputText)  
{  
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 

if(inputText.value.match(mailformat))  
{  
document.firstform.user.focus();  
return true;  
}  
else  
{  
alert("You have entered an invalid email address!");  
document.firstform.user.focus();  
return false;  
}  
}  
</script>
  
  </body>
</html>

