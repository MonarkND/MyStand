<!Doctype HTML>

<?php
session_start();
establish_connections(); //This function establishes connection with the database
$email = $_SESSION['SessionEmail'];


if($_POST)
{
	ChangeIntersted();
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


function ChangeIntersted()
{
	//connection
	global $con;
	
	//variable
	global $email;
	$UserSelectMovies=$_POST['MoviesUserChoice'];
	$UserSelectPolitics=$_POST['PoliticsUserChoice'];
	$UserSelectSport=$_POST['SportUserChoice'];
	$UserSelectTech=$_POST['TechUserChoice'];
	$UserSelectMoney=$_POST['MoneyUserChoice'];
	$UserSelectScience=$_POST['ScienceUserChoice'];
	$UserSelectSocial=$_POST['SocialUserChoice'];
	$UserSelectTerrosit=$_POST['TerrositUserChoice'];
	
	$Interested=[$UserSelectMovies, $UserSelectPolitics, $UserSelectSport, $UserSelectTech, $UserSelectMoney, $UserSelectScience, $UserSelectSocial, $UserSelectTerrosit];
	
	$InterstedNumber = EncodeInterested($Interested);
	

	$InterestedQuery = "SELECT Interested FROM userinfo WHERE email='$email'";
	$InterestedQueryResult = mysqli_query($con,$InterestedQuery);
	if($InterestedQueryResult)
		$InNum =  mysqli_fetch_row($InterestedQueryResult)[0];
	else
		echo "<script>alert('Something went wrong');window.location.href='error.php';</script>";
	
	
	for ($i=0;$i<count($Interested);$i++)
	{
		if(!isset($InNum[$i]))
			$InNum[$i]='0';
	}
	
	if($InNum!=$InterstedNumber)
	{	
		//database fetching
		$InterstedQuery="UPDATE userinfo SET Interested='$InterstedNumber' WHERE Email='$email'";
		if(mysqli_query($con,$InterstedQuery))
		{
			AddTrackInterest($InNum, $InterstedNumber);
			echo "<script>alert('We have added topic');</script>";
		}
		else 
			echo "<script>alert('Something went wrong');window.location.href='error.php';</script>";
	}
	else
		echo "<script>alert('You havent change topic');</script>";
}


function EncodeInterested($array)
{
	$result = $array[0].$array[1].$array[2].$array[3].$array[4].$array[5].$array[6].$array[7];
	return $result;
}

function fetchinterested()
{
	//connection
	global $con;
	
	//variable
	global $email;
	$InterestedQuery = "SELECT Interested FROM userinfo WHERE email='$email'";
	$InterestedQueryResult = mysqli_query($con,$InterestedQuery);
	if($InterestedQueryResult)
		$InNum =  mysqli_fetch_row($InterestedQueryResult)[0];
	else
		echo "<script>alert('Something went wrong');window.location.href='error.php';</script>";
	
	
	$TopicName = ['Entrainment', 'Politics', 'Sports', 'Tech', 'Money', 'Science', 'Social', 'Terrorist'];
	
	for ($i=0;$i<count($TopicName);$i++)
	{
		if(!isset($InNum[$i]))
			$InNum[$i]='0';
		$TopicArray[$TopicName[$i]] = $InNum[$i];	
	}
	
	return $TopicArray;
}

function headerfun()//this function will print welcome <username>
{
	global $name;
	$name = $_SESSION['SessionName'];
	return strtoupper($name);
}

function AddTrackInterest($old, $new)
{
	//connection
	global $con;
	$id = $_SESSION['SessionUserID'];
	
	
	//get time
	$Time = localtime();
	$Year = $Time[5]+1900;
	$ChangeTime = "{$Year}-{$Time[4]}-{$Time[3]} {$Time[2]}:{$Time[1]}:{$Time[0]}";
 	
	//main
	$TrackQuery = "INSERT INTO changegroup(WhatChange, UserID, WhatOld, WhatNew, ChangeTime) VALUES ('Interested', '$id', '$old', '$new', '$ChangeTime')";
	$TrackResult = mysqli_query($con, $TrackQuery);	
}

?>
<!------<html>
	<head>
			<title>Intersted Topic | My Stand</title>
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
		
	<h1 align="center">Select interested</h1>
		<form action="" border="1" method="post">
		<table align="center" border="1">
			<tr>
				<td>Topic</td>
				<td>Your Choice</td>
			</tr>
			<tr>
				<td>Entrainment</td>
				<td><input type="radio" name="MoviesUserChoice" value="1"<?php $TopicArray=fetchinterested(); if($TopicArray['Entrainment']==1) {echo 'checked';}?> >Yes
				<input type="radio" name="MoviesUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Entrainment']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td>Politics</td>
				<td><input type="radio" name="PoliticsUserChoice" value="1" <?php $TopicArray=fetchinterested(); if($TopicArray['Politics']==1) {echo 'checked';}?>>Yes
				<input type="radio" name="PoliticsUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Politics']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td>Sports</td>
				<td><input type="radio" name="SportUserChoice" value="1" <?php $TopicArray=fetchinterested(); if($TopicArray['Sports']==1) {echo 'checked';}?> >Yes
				<input type="radio" name="SportUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Sports']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td>Tech</td>
				<td><input type="radio" name="TechUserChoice" value="1" <?php $TopicArray=fetchinterested(); if($TopicArray['Tech']==1) {echo 'checked';}?> >Yes
				<input type="radio" name="TechUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Tech']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td>Money & Businass</td>
				<td><input type="radio" name="MoneyUserChoice" value="1" <?php $TopicArray=fetchinterested(); if($TopicArray['Money']==1) {echo 'checked';}?> >Yes
				<input type="radio" name="MoneyUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Money']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td>Science</td>
				<td><input type="radio" name="ScienceUserChoice" value="1" <?php $TopicArray=fetchinterested(); if($TopicArray['Science']==1) {echo 'checked';}?> >Yes
				<input type="radio" name="ScienceUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Science']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td>Social</td>
				<td><input type="radio" name="SocialUserChoice" value="1" <?php $TopicArray=fetchinterested(); if($TopicArray['Social']==1) {echo 'checked';}?> >Yes
				<input type="radio" name="SocialUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Social']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td>Terrosit</td>
				<td><input type="radio" name="TerrositUserChoice" value="1" <?php $TopicArray=fetchinterested(); if($TopicArray['Terrorist']==1) {echo 'checked';}?> >Yes
				<input type="radio" name="TerrositUserChoice" value="0" <?php $TopicArray=fetchinterested(); if($TopicArray['Terrorist']==0){echo "checked";} ?> >No</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" value="Change"></td>
			</tr>
		</table>
		</form>
	</body>
</html>---->
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
		<p align="center" style="font-size:300%; color:Green">MyStand</p>
		<p align="center" style="font-size:200%; color:Green">Account help</p>

	<!-- multistep form -->
		<form id="msform" action="" method="POST">
  
			<fieldset>
    
				<h1>Choose your Desired Topics</h1>
				<br>
				<form class="register">
					<table>
						<tr>
							<span><p>Entertainment</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">
								<input type="radio" name="MoviesUserChoice" value="1" id="10" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Entrainment']==1) {echo 'checked';}?> >
								<label for="10" class="register-switch-label">Yes</label>
								<input type="radio" name="MoviesUserChoice" value="0" id="11" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Entrainment']==0) {echo 'checked';}?>>
								<label for="11" class="register-switch-label">No</label>
							</div>
						</tr>
						<br>
						<hr>
						<br>
						<tr>
							<span><p>Politics</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">
								<input type="radio" name="PoliticsUserChoice" value="1" id="12" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Politics']==1) {echo 'checked';}?>>
								<label for="12" class="register-switch-label">Yes</label>
								<input type="radio" name="PoliticsUserChoice" value="0" id="13" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Politics']==0) {echo 'checked';}?>>
								<label for="13" class="register-switch-label">No</label>
							</div>
						</tr>
						<br>
						<hr>
						<br>
						<tr>
							<span><p>Sports</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">
								<input type="radio" name="SportUserChoice" value="1" id="14" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Sports']==1) {echo 'checked';}?>>
								<label for="14" class="register-switch-label">Yes</label>
								<input type="radio" name="SportUserChoice" value="0" id="15" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Sports']==0) {echo 'checked';}?>>
								<label for="15" class="register-switch-label">No</label>
							</div>
						</tr>
						<br>
						<hr>
						<br>
						<tr>
							<span><p>Tech</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">
								<input type="radio" name="TechUserChoice" value="1" id="16" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Tech']==1) {echo 'checked';}?>>
								<label for="16" class="register-switch-label">Yes</label>
								<input type="radio" name="TechUserChoice" value="0" id="17" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Tech']==0) {echo 'checked';}?>>
								<label for="17" class="register-switch-label">No</label>
							</div>
						</tr>
						<br>
						<hr>
						<br>
						<tr>
							<span><p>Money & Business</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">
								<input type="radio" name="MoneyUserChoice" value="1" id="18" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Money']==1) {echo 'checked';}?>>
								<label for="18" class="register-switch-label">Yes</label>
								<input type="radio" name="MoneyUserChoice" value="0" id="19" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Money']==0) {echo 'checked';}?>>
								<label for="19" class="register-switch-label">No</label>
							</div>
						</tr>
						<br>
						<hr>
						<br>
						<tr>
							<span><p>Science</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">
								<input type="radio" name="ScienceUserChoice" value="1" id="20" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Science']==1) {echo 'checked';}?>>
								<label for="20" class="register-switch-label">Yes</label>
								<input type="radio" name="ScienceUserChoice" value="0" id="21" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Science']==0) {echo 'checked';}?>>
								<label for="21" class="register-switch-label">No</label>
							</div>
						</tr>
						<br>
						<hr>
						<br>
						<tr>
							<span><p>Social</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">

								<input type="radio" name="SocialUserChoice" value="1" id="22" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Social']==1) {echo 'checked';}?>>
								<label for="22" class="register-switch-label">Yes</label>
								<input type="radio" name="SocialUserChoice" value="0" id="23" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Social']==0) {echo 'checked';}?>>
								<label for="23" class="register-switch-label">No</label>
							</div>
						</tr>
						<br>
						<hr>
						<br>
						<tr>
							<span><p>Terrorism</p></span>
						</tr>
						<br>
						<tr>
							<div class="register-switch">
								<input type="radio" name="TerrositUserChoice" value="1" id="24" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Terrorist']==1) {echo 'checked';}?>>
								<label for="24" class="register-switch-label">Yes</label>
								<input type="radio" name="TerrositUserChoice" value="0" id="25" class="register-switch-input" <?php $TopicArray=fetchinterested(); if($TopicArray['Terrorist']==0) {echo 'checked';}?>>
								<label for="25" class="register-switch-label">No</label>
							</div>
						</tr>
						<tr>
							<td colspan="2" align="center"><input type="submit" name="submit" class="submit action-button" value="Submit" /></td>
						</tr>
					</table> 
				</form>
    </fieldset>
</form>
    
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
