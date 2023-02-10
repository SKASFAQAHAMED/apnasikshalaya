<?php 
include_once("../sn/con.php");
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
} else {
	header('Location: index.php?error=user');
      	exit();
}
$sql = "SELECT * FROM admin_users WHERE Adminname = ? && Adminpass = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ss", $user, $pass);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() != 1) {
		header('Location: index.php?error=user');
      		exit();
	} else {
	$stmt->bind_result($adminId, $adminName, $adminPass, $adminRole, $adminExtra);
	$stmt->fetch();
	$_SESSION['user'] = $adminName;
	$_SESSION['pass'] = $adminPass;
	$_SESSION['role'] = $adminRole;
$action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
	  if($adminRole == 1) {
	  		if($action == "view") {
	  			echo '<table>
	  				<tr>
	  					<th>No.</th>
	  					<th>Email</th>
	  					<th>Course</th>
	  					<th>Action</th>
	  				</tr>';
	  				$i = 1;
	  			$sql = "SELECT * FROM apnaInterest;";
	  			$stmt = $con->stmt_init();
	  			$stmt->prepare($sql);
	  			$stmt->execute();
	  			$stmt->store_result();
	  			$stmt->bind_result($id, $courseId, $email, $verify, $dateTime);
	  			while($stmt->fetch()) {
	  				echo '
	  					<tr>
	  						<td>'.$i.'</td>
	  						<td>'.$email.'</td>
	  						<td>'.$courseId.'</td>
	  						<td>';
	  						if($verify == 1) {
	  							echo 'Verified';
	  						} elseif($verify === null) {
	  							echo '<a href="./enroll.php?action=approve&id='.$courseId.'&email='.$email.'">Approve</a>
	  							<a href="./enroll.php?action=reject&id='.$courseId.'&email='.$email.'">Reject</a>';
	  						} else {
	  							echo 'Rejected';
	  						}
	  					echo '</td>
	  					</tr>
	  				';
	  				$i++;
	  			}
	  			echo '</table>';
	  		} elseif($action == "approve") {
	  			$one = 1;
	  			$email = mysqli_real_escape_string($con, htmlspecialchars($_GET['email'], ENT_QUOTES));
	  			$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
	  			$sql = "UPDATE apnaInterest SET verifyIs = ? WHERE courseId = ? && studentEmail = ?;";
	  			$stmt = $con->stmt_init();
	  			$stmt->prepare($sql);
	  			$stmt->bind_param("iis", $one, $id, $email);
	  			$stmt->execute();
	  			header("Location: ./enroll.php?action=view&status=success");
	  			exit();
	  		} elseif($action == "reject") {
	  			$zero = 0;
	  			$email = mysqli_real_escape_string($con, htmlspecialchars($_GET['email'], ENT_QUOTES));
	  			$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
	  			$sql = "UPDATE apnaInterest SET verifyIs = ? WHERE courseId = ? && studentEmail = ?;";
	  			$stmt = $con->stmt_init();
	  			$stmt->prepare($sql);
	  			$stmt->bind_param("iis", $zero, $id, $email);
	  			$stmt->execute();
	  			header("Location: ./enroll.php?action=view&status=success");
	  			exit();
	  		} else {
	  			echo 'hwllo';
	  		}
	  } else {
	  	header("Location: ./");
	  	exit();
	  }
}
