<?php

include_once("../sn/con.php");

session_start();

if(isset($_POST['user']) && isset($_POST['pass'])) {

	$user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));

	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));

} elseif(isset($_SESSION['user']) && isset($_SESSION['pass'])) {

	$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));

	$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));

} else {
	header('Location: login.php?error=user');
      	exit();
}

if(isset($_POST['datefilter'])){
	$todate = mysqli_real_escape_string($con, htmlspecialchars($_POST['todate'], ENT_QUOTES));
	$fromdate = mysqli_real_escape_string($con, htmlspecialchars($_POST['fromdate'], ENT_QUOTES));	
	$sql = "SELECT COUNT(DISTINCT ipaddressIs) AS tCount FROM visitorsIs WHERE dateIs BETWEEN '$fromdate' AND '$todate';";
	$anonyuser = mysqli_query($con, $sql);
	$values = mysqli_fetch_assoc($anonyuser);
	$totalcount = $values['tCount'];	
	// echo $count;
	$sql = "SELECT COUNT(DISTINCT ipaddressIs) AS pcCount FROM visitorsIs WHERE dateIs BETWEEN '$fromdate' AND '$todate' AND desigIs='teacher';";
	$anonypcuser = mysqli_query($con, $sql);
	$values = mysqli_fetch_assoc($anonypcuser);
	$totalpccount = $values['pcCount'];	
	$sql = "SELECT COUNT(DISTINCT ipaddressIs) AS mCount FROM visitorsIs WHERE dateIs BETWEEN '$fromdate' AND '$todate' AND desigIs='student';";
	$anonymuser = mysqli_query($con, $sql);
	$values = mysqli_fetch_assoc($anonymuser);
	$totalmcount = $values['mCount'];	

	echo $totalcount;
}