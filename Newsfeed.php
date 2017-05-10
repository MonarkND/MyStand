<!Doctype HTML>

<?php
session_start();		
establish_connections();//this function will establish connection with database 
global $con;
global $email;

function establish_connections()
{
	global $con;
	define('DB_HOST', 'localhost'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	define('DB_NAME', 'mystanddata'); 
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQLI: " . mysqli_error()); 
}

function fetchinterested()//this function will fetch user interested from database to make dynamic newsfeed
{
	//connection
	global $con;
	
	//variable;
	global $email;
	$email = $_SESSION['SessionEmail'];
	$UserID = $_SESSION['SessionUserID'];
	
	
	if(isset($_GET['SearchKey']))//search condition
	{
		if($_GET['SearchKey']!=NULL)
		{
			$searchkey = $_GET['SearchKey'];
			$NewsQuery = "SELECT * FROM newsdetails WHERE Headline LIKE '%$searchkey%' OR Category LIKE '%$searchkey%'";
		}
	}
	else//normal process
	{
		$TopicName = ['Entrainment', 'Politics', 'Sports', 'Tech', 'Money', 'Science', 'Social', 'Terrorist'];
	
		$InterestedQuery = "SELECT Interested FROM userinfo WHERE email='$email'";
		$InNum =  mysqli_fetch_row(mysqli_query($con,$InterestedQuery))[0];
		$TopicNumber = count($TopicName);
		
		for ($i=0; $i<$TopicNumber; $i++)
		{
			if (!isset($InNum[$i]))
				$InNum[$i]='0';	//first some digit can be zero so fix this bug we are putting that zero
			$TopicArray[$TopicName[$i]] = $InNum[$i];//creating an assoc array where key is topic and value is user selection 
		}
		$NewsStatus='0';
		$NewsQuery = "SELECT * FROM newsdetails WHERE NewsID NOT IN (SELECT WhatID FROM reportgroup WHERE UserID = '$UserID' AND WhatReport = 'News') AND NewsStatus = '$NewsStatus' ORDER BY NewsID DESC LIMIT 100";
	}
	
	if(isset($NewsQuery))
	{
		$NewsQueryResult = mysqli_query($con, $NewsQuery);
		
		if($NewsQueryResult)
		{
			while($row=mysqli_fetch_assoc($NewsQueryResult))
			{
				if(!isset($searchkey))
				{
					if($TopicArray[$row['Category']]==1)  //this will check where user selected that article topic or not		
						$News[]=$row;
				}
				elseif(isset($searchkey))
					$News[] = $row;
			}
		}
		if(isset($News))//return the value all news
			return $News;
	}				
}


function LastNewsRead()//user read article from newsreader table
{
	//connection
	global $con;
	
	//variable
	$id = $_SESSION['SessionUserID'];
	
	$RecentQuery = "SELECT Headline,NewsID FROM newsdetails WHERE NewsID IN (SELECT DISTINCT NewsID FROM newsreader WHERE UserID = '$id') ORDER BY NewsID DESC LIMIT 10";
	$RecentResult = mysqli_query($con, $RecentQuery);
	if($RecentResult)
	{
		while($RecentRow = mysqli_fetch_row($RecentResult))
		{
			$Recent[]=$RecentRow;		
		}
		if(isset($Recent))
			return $Recent;
	}
}

function ipDetails()
{
	//$ip =  $_SERVER['REMOTE_ADDR'];
	/*$ip = $_SERVER['SERVER_ADDR'];

    if (PHP_OS == 'WINNT'){
		
        $ip = getHostByName(getHostName());
    }

    if (PHP_OS == 'Linux'){
        $command="/sbin/ifconfig";
        exec($command, $output);
        // var_dump($output);
        $pattern = '/inet addr:?([^ ]+)/';

        $ip = array();
        foreach ($output as $key => $subject) 
		{
            $result = preg_match_all($pattern, $subject, $subpattern);
            if ($result == 1) {
                if ($subpattern[1][0] != "127.0.0.1")
                $ip = $subpattern[1][0];
            }
        //var_dump($subpattern);
        }
    }*/
	
	$header_checks = array(
        'HTTP_CLIENT_IP',
        'HTTP_PRAGMA',
        'HTTP_XONNECTION',
        'HTTP_CACHE_INFO',
        'HTTP_XPROXY',
        'HTTP_PROXY',
        'HTTP_PROXY_CONNECTION',
        'HTTP_VIA',
        'HTTP_X_COMING_FROM',
        'HTTP_COMING_FROM',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'ZHTTP_CACHE_CONTROL',
        'REMOTE_ADDR'
    );
 
    foreach ($header_checks as $key)
    {
        if (array_key_exists($key, $_SERVER) === true)
        {
            foreach (explode(',', $_SERVER[$key]) as $ip)
            {
                $ip = trim($ip);
                 
                //filter the ip with filter functions
                if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false)
                {
                    $mainIP =  $ip;
                }
            }
        }
    }
	
	$ip = '27.251.37.55';
	
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	$region = $details->region; 
	$country = $details->country;
	$appli = explode(',', $details->loc);
	
	$url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$appli[0].",".$appli[1]."&sensor=false";
	$json = @file_get_contents($url);
	$data = json_decode($json);
	$address = $data->results[0]->formatted_address;
	
	$IPdetails = [$region, $country, $appli[0], $appli[1], $address];
	return $IPdetails;
}
?>

<html>
	<head>
		<title>NewsFeed | MyStand</title>
		<style>
			.EachNews 
			{
				border:0px solid #3B5998;
				border-collapse:collapse;
				background-color:#DFE3EE;	
			}
				
			.RecentRead
			{
				margin-left:62%; 
				background-color:#DFE3EE; 
				border:1px solid black; 
				overflow-y:auto; 
				height:350px; 
				width:14%; 
				position:fixed; 
				float:left;
			}
			div.end{
				padding: 1em;
				color: white;
				background-color: black;
				clear: left;
				text-align: center;
			}
			.NewsPoll{
				padding: 1em;
				color: white;
				clear: left;
				text-align: center;
			}
			.NewsImage
			{
				float: center;
				margin: 0;
			}

			article 
			{
				margin-left: 170px;
				border-left: 1px solid gray;
				padding: 1em;
				overflow: hidden;
			}

			div.container 
			{
				width: 25%;
				border: 0px solid gray;
	
			}
			
			div.pol
			{
				padding: 1em;
				color: white;
				background-color: black;
				clear: left;
				text-align: center;
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
		<script>
			function GoToSomeWhere(Name, GivenNewsID)
			{
					if(Name==1)
						window.location.href='Discussion.php?NewsID='+GivenNewsID;
					else if(Name==0)
						window.open('NewsArticle.php?NewsID='+GivenNewsID,'_blank');
			}
			function ViewPoll(NewsID, NewsNumber)
			{
				document.getElementsByClassName('NewsPoll')[NewsNumber].style.display = "block";
			}
			function CreateXML()
			{
				if (window.XMLHttpRequest) 
				{	
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} 
				else 
				{
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				return xmlhttp;
			}
			function SubmitPoll(NewsID, NewsNumber)
			{
				var PollAns = document.getElementsByName("PollOption")[NewsNumber].value;
				
				
				var PollURL = "AddPollVote.php?NewsID="+NewsID+"&PollAns="+PollAns;
	
				xmlhttp = CreateXML();
				xmlhttp.open("GET",PollURL,true);
				xmlhttp.onreadystatechange = function() 
				{
					if (this.readyState == 4 && this.status == 200) 
					{
						document.getElementsByClassName('NewsPollResult')[NewsNumber].style.display = "block";
						document.getElementsByClassName('NewsPollResult')[NewsNumber].innerHTML = xmlhttp.responseText;	
						console.log(xmlhttp.responseText);
					}
				};
				xmlhttp.send(null);
			}
			function ReportNews(NewsID, NewsNumber)
			{
				document.getElementsByClassName('container')[NewsNumber].style.display = "none";
				xmlhttp = CreateXML();
				var queryDeleteAsk = "WhatID="+NewsID;
				var DeleteURL = "ReportSomething.php?Type=News&" + queryDeleteAsk;
				xmlhttp.open("GET",DeleteURL,true);
				
				xmlhttp.onreadystatechange = function() 
				{
					if (this.readyState == 4 && this.status == 200) 
					{
						alert("Ask has been reported");
					}
				};
				xmlhttp.send(null);
			}
			function CheckNullSearch()
			{	
				var searchuser = document.getElementById('SearchUserEnter').value;
				if(searchuser.length < 4)
				{
					alert("Enter search keyword");
					return false;
				}
				else
					return true;
			}
		</script>
		
		<link rel="stylesheet" href="css/news-style.css">
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
	<!---newsfeed starts here-->
	<div border="0" style="float:left" >	
<?php
					 
		$NewsArray=fetchinterested();
		
		/*if(isset($_GET['SearchKey']))
		{	
			$NumberResult = count($NewsArray);
			echo "<h3>{$NumberResult} Search result for '{$_GET['SearchKey']}'</h3>";
		}*/
		
		$NewsCounter=0;
		for($i=0;$i<count($NewsArray);$i++)
		{
				?>
					<div id="msform" class="container">
						<fieldset>
							<h2 class="fs-subtitle" align="left"><?php echo $NewsArray[$i]['Category']?></h2><br>
							<h3  class="fs-title" ><?php echo $NewsArray[$i]['Headline'];?></h3>
							<?php if($NewsArray[$i]['HeadImage']){echo"<img src='{$NewsArray[$i]['HeadImage']}' style='width:100%;'>";}?>
							<input type="submit" class="submit action-button" <?php echo"onclick='GoToSomeWhere(1,{$NewsArray[$i]['NewsID']})'"?> value="Join Discussion">
							<input type="submit" class="submit action-button" <?php echo"onclick='GoToSomeWhere(0,{$NewsArray[$i]['NewsID']})'"?> value="Read Article">
							<input type="submit" class="submit action-button" <?php echo"onclick='ViewPoll({$NewsArray[$i]['NewsID']},{$i})'"?> value="Poll">
							<input type="submit" class="submit action-button" <?php echo"onclick='ReportNews({$NewsArray[$i]['NewsID']},{$i})'"?> value="Report News">
						</fieldset>
						<div Class="NewsPoll" style="display:none;">
							<fieldset>
								<hr>
								<p class="fs-title"><?php echo"{$NewsArray[$i]['PollingQuestion']}";?></p>
								<select Name="PollOption" class="submit action-button">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
								<button Name="PollButton" <?php echo"onclick='SubmitPoll({$NewsArray[$i]['NewsID']},{$i})'"?> class="submit action-button">Vote</button>
								<div class="NewsPollResult fs-title"></div>
							</fieldset>
						</div>
					</div>
				<?php
				$NewsCounter++;
		}	
	
		if($NewsCounter==0)
		{
			echo "<div>";
			if(!isset($_GET['SearchKey']))
				echo "<h3>You have selected zero topic</h3>";
			elseif(isset($_GET['SearchKey']))
				echo "<h3>Try someother key word</h3>";
			echo "</div>";						
		}
?>
			
	</div>
	<!---newsfeed ends here-->
	
	
	<!---Recent news starts here
	<div class="RecentRead" >
		<font style="font-size:150%"><b>Your Recent views</b></font><hr>
<?php/*
		$RecentArray = LastNewsRead();
		$LengthOfR = (count($RecentArray));
		
		for($i=0 ; $i<$LengthOfR ; $i++)
			echo "<font style='font-size:125%'><a href='NewsArticle.php?NewsID={$RecentArray[$i][1]}' target='_blank'>{$RecentArray[$i][0]}</a></font><hr>";
		
		if($LengthOfR==0)
			echo "<font style='font-size:125%'>Nothing to show</font>";
*/?>
	<!---Recent news ends herdiv-->
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
