<!Doctype HTML>

<?php

if($_POST)
{
	session_start();	
	establish_connections(); //This function establishes connection with the database
	newuser();               //This function adds the new user
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


function newuser()
{
	//Connection preparation
	global $con;
	
	
	//Variable declaration
	$name = $_POST['username'];
	$email = $_POST['useremail'];
	$dob=$_POST['userdob'];
	$password = $_POST['userpass']; 
	$gender =$_POST['usergender'];
	$phone = $_POST['userphone'];
	
	/*if($gender!="male" || $gender!="female")
	{	
		header("location:error.php");
	}*/
	
	//Output data
	$query = "INSERT INTO userinfo(Email, Name, Password, Gender, DOB, Phone) VALUES('$email', '$name', '$password','$gender', '$dob', '$phone')"; 
	
	//Functionality
	if(test_availabilty($email) && mysqli_query($con, $query)) 
	{
		$randomSelectOTP = rand(1000,9999);
		$EnterOTP= "UPDATE userinfo SET OTP = '$randomSelectOTP' WHERE Email = '$email' ";
		if (mysqli_query($con, $EnterOTP))
		{	
			//sendOTPmail($email,$randomSelectOTP);
			$_SESSION['SessionEmail']=$email;
			header("location: CheckOTP.php");	
		}
		else
			echo "Sorry some ERROR";
	}
	else
	{
		echo "no";
	}
}


//this function check email in database if its their then say no to new account
function test_availabilty($email)
{
	global $con;
	$query = "SELECT * FROM userinfo WHERE Email='$email'";
	$query_result = mysqli_query($con,$query);
	return !mysqli_fetch_row($query_result)[0];
}


//this function will send otp on user mail id to verify
function sendOTPmail($email,$randomSelectOTP)
{
	$mail = new PHPMailer();
	
	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->Password = "Password";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->SMTPDebug = 1;
	$mail->SMTPSecure = "tls";
	$mail->Username = "janicebing47@gmail.com";
	
	//set from
	$mail->SetFrom("janicebing47@gmail.com");
	
	//set body
	$mail->Body = "Welcome user your OTP is {$randomSelectOTP} check it on our website. go on"; 
	
	//set address
	$mail->addAddress($email);
	
	//mail will send
	$mail->Send();
}

?>
<!----<html>
	<head>
		<title>Sign Up | My Stand</title>
		<style>
			
		</style>
	</head>
	<body>
		<h1 align="center">Register</h1>
		<form action="" method="post">
			<table align="center" border="12">
				<tr>
					<td>Name</td>
					<td><input type="text" maxlength="255" id="UserName" name="username"/></td>
				</tr>
				<tr>
					<td>Email ID</td>
					<td><input type="text" maxlength="255" id="UserEmail" name="useremail"/></td>
				</tr>
				<tr>
					<td>Date Of Birth</td>
					<td><input type="date" id="UserDOB" name="userdob"/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" maxlength="16" id="UserPassword" name="userpass"/></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td><input type="radio" value="male" name="usergender" checked/>Male
					<input type="radio" value="female" name="usergender" />Female</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td><input type="number"  name="userphone"/></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="submit" value="Register"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>

---->


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8"><style>
	html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}

article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
  display: block;
}
body {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

blockquote, q {
  quotes: none;
}

blockquote:before, blockquote:after,
q:before, q:after {
  content: '';
  content: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}




.register-title {
  width: 270px;
  line-height: 43px;
  margin: 50px auto 20px;
  font-size: 19px;
  font-weight: 500;
  color: white;
  color: rgba(255, 255, 255, 0.95);
  text-align: center;
  text-shadow: 0 1px rgba(0, 0, 0, 0.3);
  background: #d7604b;
  border-radius: 3px;
  background-image: -webkit-linear-gradient(top, #dc745e, #d45742);
  background-image: -moz-linear-gradient(top, #dc745e, #d45742);
  background-image: -o-linear-gradient(top, #dc745e, #d45742);
  background-image: linear-gradient(to bottom, #dc745e, #d45742);
  -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.1), inset 0 0 0 1px rgba(255, 255, 255, 0.05), 0 0 1px 1px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3);
  box-shadow: inset 0 1px rgba(255, 255, 255, 0.1), inset 0 0 0 1px rgba(255, 255, 255, 0.05), 0 0 1px 1px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3);
}

.register {
  margin: 0 auto;
  width: 230px;
  padding: 20px;
  background: #f4f4f4;
  border-radius: 3px;
  -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3);
  box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3);
}

input {
  font-family: inherit;
  font-size: inherit;
  color: inherit;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.register-input {
  display: block;
  width: 100%;
  height: 38px;
  margin-top: 2px;
  font-weight: 500;
  background: none;
  border: 0;
  border-bottom: 1px solid #d8d8d8;
}
.register-input:focus {
  border-color: #1e9ce6;
  outline: 0;
}

.register-button {
  display: block;
  width: 100%;
  height: 42px;
  margin-top: 25px;
  font-size: 16px;
  font-weight: bold;
  color: #494d59;
  text-align: center;
  text-shadow: 0 1px rgba(255, 255, 255, 0.5);
  background: #fcfcfc;
  border: 1px solid;
  border-color: #d8d8d8 #d1d1d1 #c3c3c3;
  border-radius: 2px;
  cursor: pointer;
  background-image: -webkit-linear-gradient(top, #fefefe, #eeeeee);
  background-image: -moz-linear-gradient(top, #fefefe, #eeeeee);
  background-image: -o-linear-gradient(top, #fefefe, #eeeeee);
  background-image: linear-gradient(to bottom, #fefefe, #eeeeee);
  -webkit-box-shadow: inset 0 -1px rgba(0, 0, 0, 0.03), 0 1px rgba(0, 0, 0, 0.04);
  box-shadow: inset 0 -1px rgba(0, 0, 0, 0.03), 0 1px rgba(0, 0, 0, 0.04);
}
.register-button:active {
  background: #eee;
  border-color: #c3c3c3 #d1d1d1 #d8d8d8;
  background-image: -webkit-linear-gradient(top, #eeeeee, #fcfcfc);
  background-image: -moz-linear-gradient(top, #eeeeee, #fcfcfc);
  background-image: -o-linear-gradient(top, #eeeeee, #fcfcfc);
  background-image: linear-gradient(to bottom, #eeeeee, #fcfcfc);
  -webkit-box-shadow: inset 0 1px rgba(0, 0, 0, 0.03);
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.03);
}
.register-button:focus {
  outline: 0;
}

.register-switch {
  height: 32px;
  margin-bottom: 15px;
  padding: 4px;
  background: #6db244;
  border-radius: 2px;
  background-image: -webkit-linear-gradient(top, #60a83a, #7dbe52);
  background-image: -moz-linear-gradient(top, #60a83a, #7dbe52);
  background-image: -o-linear-gradient(top, #60a83a, #7dbe52);
  background-image: linear-gradient(to bottom, #60a83a, #7dbe52);
  -webkit-box-shadow: inset 0 1px rgba(0, 0, 0, 0.05), inset 1px 0 rgba(0, 0, 0, 0.02), inset -1px 0 rgba(0, 0, 0, 0.02);
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.05), inset 1px 0 rgba(0, 0, 0, 0.02), inset -1px 0 rgba(0, 0, 0, 0.02);
}

.register-switch-input {
  display: none;
}

.register-switch-label {
  float: left;
  width: 50%;
  line-height: 32px;
  color: white;
  text-align: center;
  text-shadow: 0 -1px rgba(0, 0, 0, 0.2);
  cursor: pointer;
}
.register-switch-input:checked + .register-switch-label {
  font-weight: 500;
  color: #434248;
  text-shadow: 0 1px rgba(255, 255, 255, 0.5);
  background: white;
  border-radius: 2px;
  background-image: -webkit-linear-gradient(top, #fefefe, #eeeeee);
  background-image: -moz-linear-gradient(top, #fefefe, #eeeeee);
  background-image: -o-linear-gradient(top, #fefefe, #eeeeee);
  background-image: linear-gradient(to bottom, #fefefe, #eeeeee);
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.1);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.1);
}

:-moz-placeholder {
  color: #aaa;
  font-weight: 300;
}

::-moz-placeholder {
  color: #aaa;
  font-weight: 300;
  opacity: 1;
}

::-webkit-input-placeholder {
  color: #aaa;
  font-weight: 300;
}

:-ms-input-placeholder {
  color: #aaa;
  font-weight: 300;
}

::-moz-focus-inner {
  border: 0;
  padding: 0;
}</style>
    
    
    
    
        <link rel="stylesheet" href="css/frgt1-style.css">

    
    
    
  </head>

  <body>
<br><br><br>
  <p align="center" style="font-size:300%; color:Green">MyStand</p>
		<p align="center" style="font-size:200%; color:Green">Account help</p>

		
    <!-- multistep form -->
<form id="msform" action="Register.php" method="POST">
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Create your account</h2>
		
		<input type="text" maxlength="255" id="UserEmail" name="useremail" placeholder="Email" />
		
		<input type="password" maxlength="16" id="UserPassword" name="userpass" placeholder="Password" />
		
		<input type="text"  maxlength="255" id="UserName" name="username" placeholder="Name" />
		
		<input type="date" id="UserDOB" name="userdob" placeholder="Date of Birth" />
		
		<input type="text" name="userphone" placeholder="Phone" />
		
		<div class="register-switch">
			<input type="radio" name="usergender" value="male" id="sex_m" class="register-switch-input" checked>
			<label for="sex_m" class="register-switch-label">Male</label>
			<input type="radio" name="usergender" value="female" id="sex_f" class="register-switch-input">
			<label for="sex_f" class="register-switch-label">Female</label>
		</div>
		
		<input type="submit" name="submit" class="submit action-button" />

	</fieldset>
</form>
    <!---<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
