<?php
if($_GET)
{
	session_start();	
	$searchkey = $_GET['SearchKey'];
	$_SESSION['SessionSearch'] = $searchkey;
	header("location:Newsfeed.php?SearchKey={$searchkey}");	
}	
?>