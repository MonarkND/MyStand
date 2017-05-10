
//newsfeed old
<?php
session_start();		
establish_connections();//this function will establish connection with database 
global $con;
global $name;
global $email;

function establish_connections()
{
	global $con;
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'mystanddata'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
}


function headerfun()//this function will print welcome <username>
{
	global $name;
	$name = $_SESSION['SessionName'];
	return strtoupper($name);
	
}

function fetchinterested()//this function will fetch user interested from database to make dynamic newsfeed
{
	
	//connection
	global $con;
	
	//variable;
	global $email;
	
	$email = $_SESSION['SessionEmail'];
	$InterestedQuery = "SELECT Interested FROM userinfo WHERE email='$email'";
	$InterestedQueryResult = mysqli_query($con,$InterestedQuery);
	$InNum =  mysqli_fetch_row($InterestedQueryResult)[0];
	
	
	for ($i=0;$i<8;$i++)
	{
		if (!isset($InNum[$i]))
			$InNum[$i]='0';	
	}
	
	$TopicArray = ['Terrorist'=>$InNum[7] , 'Social'=>$InNum[6] , 'Science'=>$InNum[5] , 'Money'=>$InNum[4] , 'Tech'=>$InNum[3] , 'Sports'=>$InNum[2] , 'Politics'=>$InNum[1], 'Entrainment'=>$InNum[0]];
	
	return $TopicArray;
}	


function fetchnews()//this function will fetch last 50 news from newsdetails table 
{
	//connection
	global $con;
	
	//variable
	global $TopicArray;
	
	$NewsQuery = "SELECT * FROM ( SELECT * FROM newsdetails ORDER BY NewsID DESC LIMIT 50 ) sub ORDER BY NewsID DESC";

	$NewsQueryResult = mysqli_query($con, $NewsQuery);
	
	$NewsArray = array();
	$counter=0;
	
	if($NewsQueryResult)
	{
		while($row=mysqli_fetch_array($NewsQueryResult))
		{
			$NewsArray[$counter]=$row;
			$counter++;
		}
	}
	return $NewsArray;
}


function LastNewsRead()//this function will last user read article from newsreader table
{
	//connection
	global $con;
	
	//variable
	$id = $_SESSION['SessionUserID'];
	
	$RecentQuery = "SELECT Headline,NewsID FROM newsdetails WHERE NewsID IN (SELECT DISTINCT NewsID FROM newsreader WHERE UserID = '$id' )";
	$RecentResult = mysqli_query($con, $RecentQuery);
	if($RecentResult)
	{
		$i=0;
		while($RecentRow = mysqli_fetch_row($RecentResult))
		{
			$Recent[$i][0]=$RecentRow[0];
			$Recent[$i][1]=$RecentRow[1];
			$i++;		
		}
		if(isset($Recent))
			return $Recent;
	}
}

function TodayHot()//this function will print last 24 hours most viewed news 
{
	//connection
	global $con;
	
	//main
	$todayquery = "SELECT * FROM newsreader WHERE time >= NOW() - INTERVAL 1 DAY";
	
		
}
?>
<html>
	<head>
		<title>NewsFeed | MyStand</title>
		<style>
			#EachNews 
			{
				border:1px solid #3B5998;
				border-collapse:collapse;
				background-color:#DFE3EE;
				
			}
			#EachNews td 
			{
				border:none;
			}
			#NewsShadow
			{
				box-shadow: 10px 10px 5px #888888;
			}
		</style>
	</head>
	
	
	<body bgcolor="#F7F7F7">
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
	
	

	<!---profile info starts here-->
	<table border="0" style="float:left; margin-left:20%;" width="10%">
		<tr>
			<td><a href="profile.php"><h3 align="left"><?php $text = headerfun(); echo $text;?></h3></a></td>
		</tr>
		<tr>
			<td><a href="RequestToAdmin.php"><h3 align="left">REQUEST</h3></a></td>
		</tr>
	</table>
	<!---profile info ends here-->
	
	
	<!---newsfeed starts here-->
	<table border="0" style="float:left;" width="25%">	
		<tr>
			<td>
<?php
		$TopicArray=fetchinterested();		 
		$NewsArray=fetchnews();
			
		$NewsCounter=0;
		for($i=0;$i<count($NewsArray);$i++)
		{
			if($TopicArray[$NewsArray[$i][3]]==1)//this will check where user selected that article or not
			{
				?>
				<div id="NewsShadow">
					<table width="100%" align ="center" border="1" id="EachNews">
						<tr><td colspan="2"><h4>From <?php echo $NewsArray[$i][3]?></h4></td></tr>
						<tr><td colspan="2"><?php  echo '<img src="'.$NewsArray[$i][2].'" alt="Can not display image" style="width:100%;">';?></td></tr>
						<tr><td colspan="2"><h3><?php echo $NewsArray[$i][1];?></h3></td></tr>
						<tr>
							<td width="50%" style="border: thin solid" ><h3 align="center"><?php echo "<a href='Discussion.php?NewsID=".$NewsArray[$i][0]."'>Join Discussion</a>";?></h3></td>
							<td style="border: thin solid"><h3 align="center" ><?php echo "<a href='NewsArticle.php?NewsID=".$NewsArray[$i][0]."' target='_blank'>Read full article</a>";?></h3></td>
						</tr>
					</table>
				</div>
				
				<br>
					
				<?php
				$NewsCounter++;
			}	
		}
		if($NewsCounter==0)
		{
			?>
			<div id="NewsShadow">
				<table width="100%" align ="center" border="1" id="EachNews">
					<tr><td><h3>You have selected zero topic</h3></td></tr>
				</table>
			</div>
			<?php
		}
?>
			</td>
		</tr>
	</table>
	<!---newsfeed ends here-->
	
	
	<!---Recent news starts here-->
	<table border="1" style="position:fixed; float:left; margin-left:57%;" width="13%">
	<tr><td><font style="font-size:150%"><b>Your Recent views</b></font></td></tr>
<?php
		$RecentArray = LastNewsRead();
		$lenght= (count($RecentArray));
		if($lenght!=0)
		{
			for($i=0 ; $i<$lenght ; $i++)
			{
				if($i<10)
				{
				?>
					<tr><td><?php echo "<a href='NewsArticle.php?NewsID=".$RecentArray[$i][1]."' target='_blank'>{$RecentArray[$i][0]}</a>";?></td></tr>
				<?php
				}
			}
		}
		else
		{
			?>
				<tr><td>You have not read anything</td></tr>
			<?php
		}
?>	
	</table>
	<!---Recent news ends here-->
	</body>	
</html>
