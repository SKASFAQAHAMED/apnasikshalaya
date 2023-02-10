<?php





if(isset($_POST['fromglogin'])){

if($_POST['role']=='teacher'){
$gid = $_SESSION['googleId'];
$sql = "SELECT * FROM apnaTeachers WHERE googleId = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("s", $gid);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows() == 1) {
$gid = $_SESSION['googleId'];
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
header("Location: /index");
}else{
$token = 1;
$useremail=$_SESSION['user_email_address'];
$user_name=$_SESSION['user_first_name'].$_SESSION['user_last_name'];
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
$sql8 = "UPDATE apnaTeachers SET lastloginIs = '$dt' WHERE id = '$$googleId';";
$d=mysqli_query($con,$sql8);
$_SESSION['user'] = $email;
$_SESSION['Role'] = "teacher";
header("Location: /teacher/index");
}


}

if($_POST['role']=='student'){
$gid = $_SESSION['googleId'];
$sql = "SELECT * FROM apnaStudents WHERE googleId = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("s", $gid);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows() == 1) {
$gid = $_SESSION['googleId'];
$sql = "SELECT 	emailIs, passIs  FROM apnaStudents WHERE googleId = ?;";
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
$sql8 = "UPDATE apnaStudents SET lastloginIs = '$dt' WHERE googleId = '$gid';";
$d=mysqli_query($con,$sql8);
header("Location: /index");
}else{
$token = 1;
$useremail=$_SESSION['user_email_address'];
$user_name=$_SESSION['user_first_name'].$_SESSION['user_last_name'];
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
$sql8 = "UPDATE apnaStudents SET lastloginIs = '$dt' WHERE id = '$$googleId';";
$d=mysqli_query($con,$sql8);
$_SESSION['user'] = $email;
$_SESSION['Role'] = "teacher";
header("Location: /student/index");
}
}

}

?>