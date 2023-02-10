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
	header('Location: index.php?error=user');
      	exit();
}

if(isset($_POST['pupup_upload'])){
    $id=1;
    $extra="valid";
    $popupcontent = $_POST['popupcontent'];
    $poptime = $_POST['poptime'].'000';
    $popimg = strtolower($_FILES['popimg']['name']);
    $file_tmploc_popupImage = $_FILES['popimg']['tmp_name'];
    $popimg = $id.$popimg;
    $location_popupImage = "./popups/".$popimg;
    move_uploaded_file($file_tmploc_popupImage,$location_popupImage);
    $sql = "UPDATE apna_popups SET popupContent = ?, popupImg = ?, extra=?, popupTime=? WHERE id = ?";
    $updateStatement = mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($updateStatement, 'sssii',$popupcontent,$popimg,$extra,$poptime,$id);
    if(mysqli_stmt_execute($updateStatement)){
        header('Location: allcontentchange.php?action=popup');
    }else{
        echo'error';
    }
}