<?php
include_once("./sn/con.php");
session_start();

if(isset($_SESSION['user'])){
    $useremail = mysqli_real_escape_string($con, htmlspecialchars($_POST['useremail'], ENT_QUOTES));
    $tuitionId = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuitionId'], ENT_QUOTES));
    $teacheremail = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacheremail'], ENT_QUOTES));
    $teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacherid'], ENT_QUOTES));
    $tuitiontype = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuitiontype'], ENT_QUOTES));
    $price = mysqli_real_escape_string($con, htmlspecialchars($_POST['price'], ENT_QUOTES));
    $status = "pending";
    $tuitiontypeurl = $tuitiontype;
    $tuitionIdurl = $tuitionId;
    // echo $useremail." tuition id:".$tuitionId." teacher email:".$teacheremail." teacher id:".$teacherid." tuition type:".$tuitiontype." price is:".$price." status is:".$status;
    $sql2 = "INSERT INTO tuitionPaymentFinal (tuitionId, teacherId, userIs, statusIs, typeofTuition, teachersEmail, priceIs) values(?, ?, ?, ?, ?, ?, ?);";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("sssssss", $tuitionId, $teacherid, $useremail, $status, $tuitiontype, $teacheremail, $price);
   if($stmt2->execute()){
    header("Location: /single_tution.php?typeis=$tuitiontypeurl&id=$tuitionIdurl&subscription=pending");
   }else{
    header("Location: /single_tution.php?typeis=$tuitiontypeurl&id=$tuitionIdurl&serverproblem=tryagain");
   }
}else{
    header("Location: /single_tution.php?typeis=$tuitiontypeurl&id=$tuitionIdurl&loginrequired=notvalid");
}
?>