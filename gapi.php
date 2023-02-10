<?php
	require_once "configapi.php";
	include_once './sn/con.php';
	session_start();
	if(isset($_GET["code"])){
		$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);	
		if(!isset($token['error'])){
			$google_client->setAccessToken($token['access_token']);
			$_SESSION['access_token']=$token['access_token'];
	
			$google_service = new Google_Service_Oauth2($google_client);
			$data = $google_service->userinfo->get();

			$_SESSION['googleId'] =$data['id'];
			$_SESSION['user_email_address'] =$data['email'];
			$_SESSION['user_first_name'] =$data['given_name'];
			$_SESSION['user_last_name'] =$data['family_name'];
			$_SESSION['user_image'] =$data['picture'];
			$_SESSION['login_button'] =false;
			echo '
			<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>Document</title>
				<!-- Latest compiled and minified CSS -->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

			</head>
			<body>
			<form action="gapi.php" method="POST">
			<input type="hidden" name="fromglogin" value="gapi">
  		<div class="mb-3 mt-3">
			<div class="form-check">
				<input type="radio" class="form-check-input" id="teacherrad" name="role" value="teacher">
  				<label class="form-check-label" for="teacherrad">Login as Teacher</label>
			</div>
		</div>
		  <div class="mb-3 mt-3">
			<div class="form-check">
  				<input type="radio" class="form-check-input" id="studentrad" name="role" value="student">
  				<label class="form-check-label" for="studentrad">Login as Student</label>
			</div>
		  </div>
		  <input class="btn btn-primary" type="submit" value="Submit">
		</form>



			<!-- Latest compiled JavaScript -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
			</body>
			</html>';
	
		}
	}

if(isset($_POST['fromglogin'])){

if($_POST['role']=='teacher'){

	$emailad = $_SESSION['user_email_address'];
	$sql = "SELECT googleId FROM apnaTeachers WHERE emailIs = ?;";
	$stmt5 = $con->stmt_init();
	$stmt5->prepare($sql);
	$stmt5->bind_param("s", $emailad);
	$stmt5->execute();
	$stmt5->store_result();
	$stmt5->bind_result($googleidis);
	if($stmt5->num_rows() == 1){
		$gid = $_SESSION['googleId'];
		if($gid == $googleidis){
		//if both the google id matches then we login the user and store the email and password in the session variable
		$sql = "SELECT 	emailIs, passIs  FROM apnaTeachers WHERE googleId = ?;";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("s", $gid);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($email, $pass);
		$_SESSION['user'] = $email;
		$_SESSION['pass'] = $pass;
		$_SESSION['Role'] = "teacher";
		$dt= date("Y-m-d H:i:s");
		$sql8 = "UPDATE apnaTeachers SET lastloginIs = '$dt' WHERE googleId = '$gid';";
		$d=mysqli_query($con,$sql8);
		header("Location: /teacher/index");
		exit();
	}else{
		//if the google ids dont match then we update the google id field of this users account and log him in, and store the email and pass in the session variable
		$gid = $_SESSION['googleId'];
		$sql = "UPDATE apnaTeachers SET googleId = '$gid' WHERE emailIs = '$emailad';";
		if(mysqli_query($con,$sql)){
			$sql = "SELECT emailIs, passIs FROM apnaTeachers WHERE googleId = ?;";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("s", $gid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($email, $pass);
			$_SESSION['user'] = $email;
			$_SESSION['pass'] = $pass;
			$_SESSION['Role'] = "teacher";
			$dt= date("Y-m-d H:i:s");
			$sql8 = "UPDATE apnaTeachers SET lastloginIs = '$dt' WHERE googleId = '$gid';";
			$d=mysqli_query($con,$sql8);
			header("Location: /teacher/index");
			exit();
		}
	}
		
	}else{
		//we didnt get anythig related to the email, that we got from google session means that there is no user with this email in the db 
		//so we need to create a new user 
		$show = 'show';
		$token = 1;
		$useremail=$_SESSION['user_email_address'];
		$user_name=$_SESSION['user_first_name']. " " .$_SESSION['user_last_name'];
		$user_image=$_SESSION['user_image'];
		$googleId=$_SESSION['googleId'];
		$ip = getenv("REMOTE_ADDR");
		$sql2 = "INSERT INTO apnaTeachers (googleId, nameIs, emailIs, thumbnailIs, verifyIs, ipIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?);";
    	$stmt2 = $con->stmt_init();
    	$stmt2->prepare($sql2);
    	$stmt2->bind_param("sssssss", $googleId, $user_name, $useremail, $user_image, $token, $ip, $show);
    	$stmt2->execute();
		$stmt2->fetch();
		$dt= date("Y-m-d H:i:s");
		$sql8 = "UPDATE apnaTeachers SET lastloginIs = '$dt' WHERE googleId = '$googleId';";
		$d=mysqli_query($con,$sql8);
		$_SESSION['user'] = $email;
		$_SESSION['Role'] = "teacher";
		$_SESSION['auth'] = "googleauth";
		header("Location: teacher_profile.php");

	}

}

if($_POST['role']=='student'){
	echo'i am in student';

	$emailad = $_SESSION['user_email_address'];
	$sql = "SELECT googleId FROM apnaStudents WHERE emailIs = ?;";
	$stmt5 = $con->stmt_init();
	$stmt5->prepare($sql);
	$stmt5->bind_param("s", $emailad);
	$stmt5->execute();
	$stmt5->store_result();
	$stmt5->bind_result($googleidis);
	if($stmt5->num_rows() == 1){
		$gid = $_SESSION['googleId'];
		if($gid == $googleidis){
		//if both the google id matches then we login the user 
		$sql = "SELECT 	emailIs, passIs  FROM apnaStudents WHERE googleId = ?;";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("s", $gid);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($email, $pass);
		$_SESSION['user'] = $email;
		$_SESSION['pass'] = $pass;
		$_SESSION['Role'] = "student";
		$dt= date("Y-m-d H:i:s");
		$sql8 = "UPDATE apnaStudents SET lastloginIs = '$dt' WHERE googleId = '$gid';";
		$d=mysqli_query($con,$sql8);
		header("Location: /student/index");
		exit();
	}else{
		//if the google ids dont match then we update the google id field of this users account
		$gid = $_SESSION['googleId'];
		$sql = "UPDATE apnaStudents SET googleId = '$gid' WHERE emailIs = '$emailad';";
		if(mysqli_query($con,$sql)){
			$sql = "SELECT emailIs, passIs FROM apnaStudents WHERE googleId = ?;";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("s", $gid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($email, $pass);
			$_SESSION['user'] = $emailad;
			$_SESSION['pass'] = $pass;
			$_SESSION['Role'] = "student";
			$dt= date("Y-m-d H:i:s");
			$sql8 = "UPDATE apnaStudents SET lastloginIs = '$dt' WHERE googleId = '$gid';";
			$d=mysqli_query($con,$sql8);
			header("Location: /student/index");
			exit();
		}
	}
	}else{
		//we didnt get anythig related to the email, that we got from session means that there is no user with this email in the db 
		//so we need to create a new user 
		$show = 'show';
		$token = 1;
		$useremail=$_SESSION['user_email_address'];
		$user_name=$_SESSION['user_first_name']. " " .$_SESSION['user_last_name'];
		$user_image=$_SESSION['user_image'];
		$googleId=$_SESSION['googleId'];
		$ip = getenv("REMOTE_ADDR");
		$sql2 = "INSERT INTO apnaStudents (googleId, nameIs, emailIs, thumbnailIs, verifyIs, ipIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?);";
    	$stmt2 = $con->stmt_init();
    	$stmt2->prepare($sql2);
    	$stmt2->bind_param("sssssss", $googleId, $user_name, $useremail, $user_image, $token, $ip, $show);
    	$stmt2->execute();
		$stmt2->fetch();
		$dt= date("Y-m-d H:i:s");
		$sql8 = "UPDATE apnaStudents SET lastloginIs = '$dt' WHERE googleId = '$googleId';";
		$d=mysqli_query($con,$sql8);
		$_SESSION['user'] = $email;
		$_SESSION['Role'] = "student";
		$_SESSION['auth'] = $googleId;
		header("Location: /student_profile.php");
	}
}

}
	if(isset($_SESSION['login_button'])){
		$login_button=$_SESSION['login_button'];
	
	}else{
		$login_button = true;
	}
