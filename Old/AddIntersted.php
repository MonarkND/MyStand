<?php
establish_connections(); //This function establishes connection with the database
ChangeIntersted();
global $con;

function establish_connections()
{
	global $con;
	define('DB_HOST', 'localhost'); 
	define('DB_NAME', 'weblogin'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD',''); 
	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error()); 
}

function ChangeIntersted()
{
	var_dump($_POST);
	//connection
	global $con;
	session_start();
	
	//variable
	$email =$_SESSION['SessionEmail'];
	$UserSelectMovies=$_POST['MoviesUserChoice'];
	$UserSelectPolitics=$_POST['PoliticsUserChoice'];
	$UserSelectSport=$_POST['SportUserChoice'];
	$UserSelectTech=$_POST['TechUserChoice'];
	$UserSelectMoney=$_POST['MoneyUserChoice'];
	$UserSelectScience=$_POST['ScienceUserChoice'];
	$UserSelectFashion=$_POST['FashionUserChoice'];
	$UserSelectSocial=$_POST['SocialUserChoice'];
	$UserSelectTerrosit=$_POST['TerrositUserChoice'];

	//database fetching
	//first time entry in signup process
	if(test_availabilty($email))
	{
		$InsertQuery="INSERT INTO userinterst (email, Movies, Politics, Sports, Tech, Money, Science, Fashion, Social, Terrorist) VALUES ('$email','$UserSelectMovies', '$UserSelectPolitics', '$UserSelectSport', '$UserSelectTech', '$UserSelectMoney', '$UserSelectScience', '$UserSelectFashion', '$UserSelectSocial', '$UserSelectTerrosit')";
		if(mysqli_query($con,$InsertQuery))
		{
			header("location:Newsfeed.php");
		}
		else
		{
			echo "ERROR IN INSERT";
		}
	}
	//change  after some use
	else if(!test_availabilty($email))
	{
		$UpdateQuery="UPDATE userinterst SET Movies='$UserSelectMovies' , Politics='$UserSelectPolitics' , Sports='$UserSelectSport' , Tech='$UserSelectTech' , Money='$UserSelectMoney' , Science='$UserSelectScience' , Fashion='$UserSelectFashion', Social='$UserSelectSocial', Terrorist='$UserSelectTerrosit' WHERE email='$email'";
		if(mysqli_query($con,$UpdateQuery))
		{
			header("location:Newsfeed.php");
		}
		else 
		{
			echo "ERROR IN UPADTE";
		}
	}
	else
	{
		echo "ERROR IN FETCHING";
	}
}

function test_availabilty($email)
{
	global $con;
	$query = "SELECT count(*) FROM users WHERE email='$email'";
	$query_result = mysqli_query($con,$query);
	return !mysqli_fetch_row($query_result)[0];
}
?>