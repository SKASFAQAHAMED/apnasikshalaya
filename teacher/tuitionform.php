<?php
include_once("../sn/con.php");
session_start();
$sessionuser = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
if(isset($_POST['tuitionform'])){
    $extra = "show";
    $teacheid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacheid'], ENT_QUOTES));
    $teacheremail = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacheremail'], ENT_QUOTES));
    $board = mysqli_real_escape_string($con, htmlspecialchars($_POST['board'], ENT_QUOTES));
	$grade = mysqli_real_escape_string($con, htmlspecialchars($_POST['grade'], ENT_QUOTES));
	$subject = mysqli_real_escape_string($con, htmlspecialchars($_POST['subject'], ENT_QUOTES));
	$secsubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['secsubject'], ENT_QUOTES));
	$tuitioname = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuitioname'], ENT_QUOTES));
	$wday = mysqli_real_escape_string($con, htmlspecialchars($_POST['wday'], ENT_QUOTES));
	$spcl = mysqli_real_escape_string($con, htmlspecialchars($_POST['spcl'], ENT_QUOTES));
	$ttime = mysqli_real_escape_string($con, htmlspecialchars($_POST['ttime'], ENT_QUOTES));
    $sql2 = "INSERT INTO onlineTeacherTuition (teacherId, teacheremail, tuitionName, gradeIs, boardIs, subjectIs, secondarysubIs, speciIs, hourIs, weekdaysIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt2 = $con->stmt_init();
	$stmt2->prepare($sql2);
	$stmt2->bind_param("issssssssss", $teacheid, $teacheremail, $tuitioname, $grade, $board, $subject, $secsubject, $spcl, $ttime, $wday, $extra);
	if($stmt2->execute()){
        header("Location: https://apnasikshalaya.com/teacher/tuitions.php?status=tuitioncreated");
    }else{
        echo"Error Creating Tuition";
    }
}
if(isset($_POST['sendmail_btn'])){
$tuitionid=mysqli_real_escape_string($con, htmlspecialchars($_POST['tuitionid'], ENT_QUOTES));
$meetlinkis=mysqli_real_escape_string($con, htmlspecialchars($_POST['meetlinkis'], ENT_QUOTES));
$sql = "SELECT userIs FROM tuitionPaymentFinal WHERE tuitionId = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("i", $tuitionid);
$stmt->store_result();
$stmt->bind_result($userIs);
$listofusers=[];
while($stmt->fetch()){
	array_push($listofusers,$userIs);
}
$emails = implode(',', $listofusers);
$subject = "Tuition Link";
$body = "Hello Fellow student todays Tuition link is '.$meetlinkis.'";
$headers = "From: '.$sessionuser.'" . "\r\n" ."CC: rs@crio77.com";
mail($emails, $subject, $body, $headers);
}
