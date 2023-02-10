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

if(isset($_POST['checking_edit_btn'])){
    $username=$_POST['username'];
    $result_array=[];
    $query = "SELECT * FROM admin_users WHERE Adminname='$username' ";
    $query_run = mysqli_query($con,$query);
    if(mysqli_num_rows($query_run)>0){
        foreach($query_run as $row){
            array_push($result_array,$row);
            header('content-type: application/json');
            echo json_encode($result_array);
        }
    }else{
        echo '<h4>Opps! Sorry No records found</h4>';
    }
}

if(isset($_POST['update_admin'])){
        $Eid = $_POST['Eid'];
        $Ename = $_POST['Ename'];
        $Erole = $_POST['Erole'];
        $EUsername = $_POST['EUsername'];
        $Epass = $_POST['Epass'];
        $sql = "UPDATE admin_users SET Adminname=?, Adminpass=?, Adminrole=?, AdminRealName=? WHERE id=?";
        $updateStatement = mysqli_prepare($con,$sql);
        mysqli_stmt_bind_param($updateStatement, 'ssisi',$EUsername,$Epass,$Erole, $Ename,$Eid);
        if(mysqli_stmt_execute($updateStatement)){
            header('Location:./admin?action=view&status=success');
        }else{
            echo'error';
        }
        
     }    
     if(isset($_POST['delete_admin'])){
        $username = $_POST['admin_u'];
        $hide=0;
        $sql = "UPDATE admin_users SET extra = ? WHERE Adminname = ?;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ss", $hide, $username);
        $stmt->execute();
        header("Location:./admin.php?action=view");
        exit();
        }
 