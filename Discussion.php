<!Doctype HTML>

<?php
establish_connections();
$NewsID = $_GET['NewsID']; 
global $NewsID;
global $con;

function establish_connections()//this function will establish connections with database
{
	session_start();
	global $con;
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'mystanddata'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysql_error()); 
}


function fetchnewsdetails()//this function will print question and category
{
	//variable
	global $NewsID;
	global $con;
	
	//main
	$NewsDetailsQuery = "SELECT Headline, Category, PollingQuestion FROM newsdetails WHERE NewsID = '$NewsID'";
	$NewsDetails = mysqli_fetch_row(mysqli_query($con, $NewsDetailsQuery));
	
	if(isset($NewsDetails))
		return $NewsDetails;
}


function fetchQuestion()
{
	//variable
	global $con;
	global $NewsID;
	$DiscussionStatus = '0';
	$UserID = $_SESSION['SessionUserID'];
	
	$FetchNewsQuery = 	"SELECT * FROM
						(
							SELECT 
							D.AskID, D.AskQuestion, D.AskTime, U.Name, U.UserID 
							FROM DiscussionAsk D, userinfo U 
							WHERE D.NewsID='$NewsID' AND D.UserID = U.UserID 
								AND D.AskID NOT IN (SELECT WhatID FROM reportgroup WHERE UserID = '$UserID' AND WhatReport = 'Ask')
								AND D.DiscussionStatus = '0'  LIMIT 50
						) 
						sub ORDER BY AskTime DESC"; 
	$FetchNewsResult = mysqli_query($con, $FetchNewsQuery);
	

	if($FetchNewsResult)
	{
		while($row = mysqli_fetch_assoc($FetchNewsResult))
			$Ask[] = $row;	
	}
	
	if(isset($Ask))
		return $Ask;
}	
?>

<html>
	<head>
		<title>Discussion | MyStand</title>
		<style>
			.EveryAsk
			{
				width:25%;
				border:0px solid #3B5998;
				border-collapse:collapse;	
			}
			div.container 
			{
				width: 25%;
				border: 1px solid gray;
				
			}
			div.a
			{
				padding: 1em;
				color: white;
				background-color: black;
				clear: left;
				text-align: center;
			}
			div.a1
			{
				padding: 1em;
				color: white;
				background-color: white;
				clear: left;
				text-align: center;
			}
			div.date_time
			{
				padding: 1em;
				color: white;
				background-color: black;
				clear: left;
				text-align: center;
			}
			div.pol
			{
				padding: 1em;
				color: white;
				background-color: black;
				clear: left;
				text-align: center;
			}
			div.make 
			{
				margin-left: 170px;
				border-left: 1px solid gray;
				padding: 1em;
				overflow: hidden;
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
		<script language = "javascript" type="text/javascript">
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
		
		function OpenComments(AskID, AskNumber)
		{
			document.getElementsByClassName('AskComments')[AskNumber].style.display = "block";
			document.getElementsByName('CommentButton')[AskNumber].disabled = true;
			xmlhttp = CreateXML();
			var queryViewComments = "AskID="+AskID;
			var ViewCommentsURL = "ViewOldComments.php?" + queryViewComments;
			xmlhttp.open("GET",ViewCommentsURL,true);
			
			xmlhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					var list2 = document.getElementsByClassName("OldComments")[AskNumber];
					list2.innerHTML = xmlhttp.responseText +list2.innerHTML;
				}
			};
			xmlhttp.send(null);
		}
		
		
		function AddAskComments(AskID, AskNumber)
		{
			var CommentWord = document.getElementsByClassName("CommentAdd")[AskNumber].value;
			var queryComment = "AskID=" + AskID + "&CommentWord=" +CommentWord;
			var CommentURL = "AddAskComment.php?" + queryComment;
		
			xmlhttp.open("GET", CommentURL, true);
			
			xmlhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					var list2 = document.getElementsByClassName("OldComments")[AskNumber];
					list2.innerHTML = xmlhttp.responseText + list2.innerHTML;
					document.getElementsByClassName("CommentAdd")[AskNumber].value="";
				}
			};
			xmlhttp.send(null);
		}
		
		function DeleteAsk(AskID, AskNumber)
		{
			document.getElementsByClassName('EveryAsk')[AskNumber].style.display = "none";
			document.getElementsByClassName('EveryAskBR')[AskNumber].style.display = "none";
			xmlhttp = CreateXML();
			var queryDeleteAsk = "AskID="+AskID;
			var DeleteAskURL = "DeleteAsk.php?" + queryDeleteAsk;
			xmlhttp.open("GET",DeleteAskURL,true);
			
			xmlhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					console.log(xmlhttp.responseText);
					alert("Your Ask has been delete");
				}
			};
			xmlhttp.send(null);
		}
		
		function ReportAsk(AskID, AskNumber)
		{
			document.getElementsByClassName('EveryAsk')[AskNumber].style.display = "none";
			xmlhttp = CreateXML();
			var queryDeleteAsk = "WhatID="+AskID;
			var DeleteAskURL = "ReportSomething.php?Type=Ask&" + queryDeleteAsk;
			xmlhttp.open("GET",DeleteAskURL,true);
			
			xmlhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					console.log(xmlhttp.responseText);
					alert("Ask has been reported");
				}
			};
			xmlhttp.send(null);
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

	<?php 
		$NewsDetails = fetchnewsdetails(); 
	
		if($NewsDetails)
		{
			echo "<h1><b>{$NewsDetails[0]}</b></h1>";
			echo "<h3>From {$NewsDetails[1]}</h3>";
			echo "<h3><i>Polling Question - {$NewsDetails[2]}</i></h3>";
		}
		else
			header("location:error.php");
	?>
	<div style="width:25%">	
	<form action="AddAskQuestion.php" method="GET">
		<textarea style="width:100%; height: 100px; resize:none;" maxlength="500" name="AskQustion" id="AskQustion"></textarea>
		<input type="hidden" name="NewsID" id="NewsID" <?php echo"value='{$NewsID}'"?> />
		<input style="height:20px; width:200px; " type="submit" value="Ask!"/>
	</form>	
	</div>
	<div id="Ask-list">
	<?php
		$Ask = fetchQuestion();
		$len = count($Ask);
		if($len==0)
		{
			echo "<h4 align='center'>Be the First to start discussion</h4>";
		}
		for($i=0;$i<$len;$i++)
		{
			
			?>
				<div class="EveryAsk" id="msform">
					<fieldset>
						<div>
							<h2 class="fs-subtitle" align="left"><?php echo "By {$Ask[$i]['Name']}";?></h2>
							<h2 class="fs-subtitle" align="left"><?php echo "{$Ask[$i]['AskTime']}"; ?></h2>
						</div>
						<div>
							<p style="font-color:black;"><?php echo $Ask[$i]['AskQuestion'] ?></p>
							<button name="CommentButton" <?php echo "onclick='OpenComments({$Ask[$i]['AskID']},{$i})'"; ?> align="center" class="submit action-button">Comments</button>
							<button name="ReportButton" <?php echo "onclick='DeleteAsk({$Ask[$i]['AskID']},{$i})'"; ?> align="center" class="submit action-button">Report Ask</button>
						</div>
						<div class="AskComments" style="width:100%;display:none;">
							<hr>
							<input type="text" style="width:50%" class="CommentAdd"><input type="submit" name="CommentButton" class="submit action-button" value="Comment" <?php echo "onclick='AddAskComments({$Ask[$i]['AskID']},{$i})'"?>> 
							<div class="OldComments">
							</div>
						</div>
					</fieldset>
				</div>
			<?php	
		}				
	?>
	</div>
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