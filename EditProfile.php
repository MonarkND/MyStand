<!Doctype HTML>

<?php
session_start();
establish_connections(); //This function establishes connection with the database
$email = $_SESSION['SessionEmail'];
global $email;

if($_POST)
{
	if(isset($_POST['UserOldPassword']))
		UpdatePassword();
	else
		UpdateUserInfo();	
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

function UpdateUserInfo()
{
	//variable
	global $con;
	global $email;
	
	$name = $_POST['UserName']; 
	$gender = $_POST['UserGender'];
	$phone = $_POST['UserPhone'];
	$dob = $_POST['UserDOB'];
	
	
	//Old variable
	$old = FetchUserInfo();
	//new variable
	$new = [$name, $gender, $phone, $dob]; 
	//variable name
	$ChangeName = ['Name', 'Gender', 'Phone', 'DOB'];
	
	
	//query
	if($name==NULL || $phone==NULL || $dob==NULL)
		echo "<script>alert('Enter full details');</script>";
	else	
	{
		$UpdateQuery = "UPDATE userinfo SET Name='$name', Gender='$gender', Phone='$phone', DOB='$dob'  WHERE Email='$email'";
		$UpdateResult = mysqli_query($con, $UpdateQuery);
		
		if($UpdateResult)
		{	
			//for($i=0;$i<count($ChangeName);$i++)
				//AddTrack($ChangeName[$i], $old[$i], $new[$i]);
			echo "<script>alert('We have update your profile');</script>";
		}
		else
			echo "<script>alert('Something went wrong');window.location.href='error.php';</script>";
	}
}

function FetchUserInfo()
{
	//connection
	global $con;
	
	//variable
	global $email;
	
	//query
	$fetchinfoquery = "SELECT Name, Gender, Phone, DOB FROM userinfo WHERE email= '$email'";
	$result = mysqli_query($con, $fetchinfoquery);
	
	$row = mysqli_fetch_row($result);

	return $row;
}

function UpdatePassword()
{
	//connection
	global $con;
	
	//variable
	global $email;
	$OldPass = $_POST['UserOldPassword'];
	$NewPass = $_POST['UserNewPassword'];
	
	$CheckPassQuery = "SELECT Password FROM userinfo WHERE Email='$email'";
	$CheckPassResult = mysqli_fetch_row(mysqli_query($con, $CheckPassQuery))[0];
	
	if($CheckPassResult==$OldPass)
	{	
		$UpdatePassQuery = "UPDATE userinfo SET Password='$NewPass' WHERE Email='$email'";
		$UpdatePassResult = mysqli_query($con, $UpdatePassQuery);
		if($UpdatePassResult)
		{
			//AddTrack('Password', $OldPass, $NewPass);
			echo "<script>alert('We have update your password');</script>";
		}
		else
			echo "<script>alert('Something went wrong');window.location.href='error.php';</script>";
	}
	else
		echo "<script>alert('Wrong password');</script>";
}

function AddTrack($What, $Old, $New)
{
	if($Old!=$New)
	{
		//connection
		global $con;
		$id = $_SESSION['SessionUserID'];
		
		//get time
		$Time = localtime();
		$Year = $Time[5]+1900;
		$ChangeTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
 	
		//main
		$TrackQuery = "INSERT INTO changegroup(WhatChange, UserID, WhatOld, WhatNew, ChangeTime) VALUES ('$What', '$id', '$Old', '$New', '$ChangeTime')";
		$TrackResult = mysqli_query($con, $TrackQuery);
	}
}

?>
<!----<html>
	<head>
		<title>Edit Profile | MyStand</title>
	</head>
	
	
	<body>
		<div style="position:fixed; width:100%; align:left; top:0px; left:0px; overflow-x:hidden;">
			<table width="100%" border="0" bgcolor="#00405d">
				<tr>
					<td style="width:30%"></td>
					<td style="width:20%">	
											<a href="EditProfile.php"><img src="Images/profile.jpg" title="Edit Profile" width="40px" height="40px"></a>
											<a href="Newsfeed.php"><img src="Images/newsfeed.jpeg" title="NewsFeed" width="40px" height="40px"></a>
											<a href="SelectInterested.php"><img src="Images/topic.png" title="Select Topic" width="40px" height="40px"></a>
											<a href="logout.php"><img src="Images/logout.png"  title="Logout :'(" width="40px" height="40px"></a>
					</td>
					<td style="width:50%"></td>
				</tr>
			</table>
		</div>
	
	<br>
	<br>
	<br>
	

    <form action="" method="post">
	<?php
		$info = FetchUserInfo();
		?>
		<table align="center" border="1">
			<tr>
				<td>Name</td>
				<td><input type="text" name="UserName" <?php echo "value='$info[0]'"; ?>></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><input type="radio" value="male" name="UserGender" <?php if($info[1]=='male') echo "checked" ?>>Male
					<input type="radio" value="female" name="UserGender" <?php if($info[1]=='female') echo "checked" ?> >Female
				</td>
            </tr>
			<tr>
				<td>Phone</td>
				<td><input type="text" name="UserPhone" <?php echo "value='$info[2]'"; ?> ></td>
            </tr>
			<tr>
				<td>DOB</td>
				<td><input type="date" name="UserDOB" <?php echo "value='$info[3]'"; ?> ></td>
            </tr>
			<tr>
				<td align="center" colspan="2">
				<input type="submit" name="submit" value="Update">
				</td>
			</tr>
		</table>
	</form>
	
	<br>
	<br>
	
	<form action="" method="POST">
		<table align="center" border="1">
			<tr>
				<td>Old Password</td>
				<td><input type="text" maxlength="16" name="UserOldPassword"/></td>
			</tr>
			<tr>
				<td>New Password</td>
				<td><input type="text" maxlength="16" name="UserNewPassword"/></td>
			</tr>
			<tr>
				<td align="center" colspan="2">
				<input type="submit" name="submit" value="Update">
				</td>
			</tr>
		</table>
	</form>

    </body>
</html>
--->

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
}
header, footer 
			{
				padding: 1.2em;
				color: white;
				background-color:#20B2AA;
				clear: left;
				text-align: center;
				height:6%;
			}
			input[type=searchtext] {
				width: 130px;
				box-sizing: border-box;
				border: 2px solid #ccc;
				border-radius: 4px;
				font-size: 16px;
				background-color: white;
				background-image: url('images\searchicon1.png');
				background-position: 5px 5px;
				background-repeat: no-repeat;
				padding: 12px 20px 12px 40px;
				-webkit-transition: width 0.4s ease-in-out;
				transition: width 0.4s ease-in-out;
			}

			input[type=searchtext]:focus 
			{
				width: 50%;
			}
</style>
     <link rel="stylesheet" href="css/frgt1-style.css">

    
</head>

<body>
	<header>
		<div style="position:fixed; top:10px; overflow-x:hidden;">
			<img src="images\mystandheader.png" title="Edit Profile" width="150px" height="60px">
			<a href="EditProfile.php"><img src="images\profile1.png" title="Edit Profile" width="40px" height="40px"></a>
			<a href="Newsfeed.php"><img src="images\newsfeed1.jpg" title="NewsFeed" width="40px" height="40px"></a>
			<a href="SelectInterested.php"><img src="images\inter1.jpg" title="Select Topic" width="40px" height="40px"></a>
			<a href="logout.php"><img src="images\out1.jpg"  title="Logout :'(" width="40px" height="40px"></a>
		</div>
		<div style=" margin-left:250px;">
			<form action="SearchResult.php" method="GET"><input type="searchtext" name="SearchKey" placeholder="Search..">
			</form>
		</div>
	</header>

<form id="msform" action="" method="POST">
    <p  style="font-size:300%; color:Green" >MyStand</p>
	  <p  style="font-size:220%; color:Green" >Account Help</p><br><br>
  <fieldset>
  <?php
		$info = FetchUserInfo();
	?>
    <h2 class="fs-title"><font color="green">Edit Profile</font></h2>
    <br>
    <input type="text" name="UserName" placeholder="Name" <?php echo "value='$info[0]'"; ?> />
	<input type="date" name="UserDOB" placeholder="Date of Birth" <?php echo "value='$info[3]'"; ?> />
    <input type="text" name="UserPhone" placeholder="Phone" <?php echo "value='$info[2]'"; ?> />
	
    


  <form class="register">
    <div class="register-switch">
      <input type="radio" name="UserGender" value="M" id="sex_m" class="register-switch-input" <?php if($info[1]=='male') echo "checked" ?> >
      <label for="sex_m" class="register-switch-label">Male</label>
	<input type="radio" name="UserGender" value="F" id="sex_f" class="register-switch-input" <?php if($info[1]=='female') echo "checked" ?>>
      <label for="sex_f" class="register-switch-label">Female</label>

    </div>
    
  </form>
    <input type="submit" name="submit" class="submit action-button" value="Submit" /></fieldset>
</form>
<form id="msform" action="" method="POST">
  
  <fieldset>
    <h2 class="fs-title"><font color="green">Edit Password</font></h2>
    <br>
	<input type="password" name="UserOldPassword" placeholder="Old Password" />
	<input type="password" name="UserNewPassword" placeholder="New Password" />
    


    <input type="submit" name="submit" class="submit action-button" value="Submit" /></fieldset>
</form>
        <script src="js/index.js"></script>

    
    <footer class="footer1">
    <div class="col-lg-3 col-md-3"><!-- widgets column left -->                
		<table class="widget-container widget_nav_menu"><!-- widgets list -->
                    
                                <h1 class="title-widget">Contact Us</h1>
                                
                                <tr>
                                	<td style="font-size:20px; color:green"> EMAIL ID:</td></tr>
									<tr>
									<td> care@mystand.com</td></tr>
								<tr>
									<td  style="font-size:20px; color:green"> HELPLINE NUMBERS:</td></tr>
									<tr>
									<td> 9825098250</td></tr>
                                </tr>
							</table></div></footer>
    
  </body>
</html>