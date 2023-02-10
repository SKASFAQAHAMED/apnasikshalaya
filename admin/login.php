<?php
include_once("../sn/con.php");
session_start();
echo '
<html>
    <head>
        <title>Admin Login || Apna Sikshalaya</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		</head>
    <body style="font-family: \'Bona Nova\', serif;">
    <div style="width: 90%; overflow: hidden; margin: 24px auto;">';
        echo '</div>


		<div class="modal fade" id="adminforgotVIEWmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="adminforgotVIEWmodal">Forgot password Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
		  <form action ="login.php" method="POST">
          <div class="modal-body">
		   <div class = "form-group">
		     <label for="Email">Please Enter your email</label>
		      <input type="email" name ="Email"  class="form-control" placeholder="Email">
	       </div>
		   <div class = "form-group">
		     <label for="Ename">Please Enter your Name</label>
		      <input type="text" name ="Ename"  class="form-control" placeholder="Name">
	       </div>
          </div>
		  <div class="modal-footer">
		   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		   <button type="submit" name ="Forgot_password" class="btn btn-primary">Request The Details From Superadmin</button>
		  </div>
		  </form>
         
        </div>
        </div>
      </div>


        <form method="POST" style="padding:20px 48px; max-width: 400px; margin:0 auto; border:2px solid grey; box-shadow: 5px 5px 10px grey; border-radius: 5px;" action="login.php">
		
           <center> <h3 style="font-weight:800;">Apna Sikshalaya</h3>
			<h4>Admin Login<h4/> </center>';
			if($_GET['status']) {
				if($_GET['status']=="sentforgotmail"){
					echo'
					<h4  class="alert alert-success"><strong>Success!</strong> Your Request has been sent to the Administrator. You will get a mail shortly</h4>
					';
				}if($_GET['status']=="error"){}
				echo'
					<h4 class="alert alert-danger"><strong>Opps!</strong> Please try with valid credential </h4>
					';
			}elseif($_GET['error']) {
				if($_GET['error'] == 'user') {
					echo '<div class="alert alert-danger" role="alert">Warning! Please try with valid username or password.</div>';
				} else {
					echo '<div class="alert alert-danger" role="alert">Unknown error occured. Please Try again after sometimes</div>';
				}
			}
	
			echo'
            <div class="form-group">
                <label for="inputUserId">User ID</label>
                <input name = "user" type="text" class="form-control" id="inputUserId" aria-describedby="userHelp" placeholder="Enter User ID">
                <!--small id="userHelp" class="form-text text-muted">Apna Sikshalaya User ID provided by Super Admin.</small-->
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input name = "pass" type="password" class="form-control" id="inputPassword" placeholder="Enter Password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="inputCheck">
                <label class="form-check-label" for="inputCheck">I am a member of Apna Sikshalaya</label><br/>
				
            </div>
            <input type="hidden" name="from" value="login">
			
            <button type="submit" class="btn btn-primary" style="width:100%;">Login</button><br/><br/>
			<a href="#" class =" bg bg-danger view_btn"> Forgot Password </a>
        </form>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
	$(document).ready(function (){	 
	  $(".view_btn").click(function (e){
		e.preventDefault();
		$("#adminforgotVIEWmodal").modal("show");
		});
	  });
	</script>
</html>';
if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
	$sql = "SELECT * FROM admin_users WHERE Adminname = ? && Adminpass = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ss", $user, $pass);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() == 1) {
		header('Location: dashboard.php');
      		exit();
	}
} if(isset($_POST['user']) && isset($_POST['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
	$sql = "SELECT * FROM admin_users WHERE Adminname = ? && Adminpass = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ss", $user, $pass);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() == 1) {
		$stmt->bind_result($adminId, $adminName, $adminPass, $adminRole, $adminExtra, $adminrealname,$adminRoleName);
		$stmt->fetch();
		$_SESSION['user'] = $adminName;
		$_SESSION['pass'] = $adminPass;
		$_SESSION['role'] = $adminRole;
		header('Location: dashboard.php');
      		exit();
	}
}
if(isset($_POST['Forgot_password'])){
	$usermail = mysqli_real_escape_string($con, htmlspecialchars($_POST['Email'], ENT_QUOTES));
	$username = mysqli_real_escape_string($con, htmlspecialchars($_POST['Ename'], ENT_QUOTES));

	$superadminemail = "admin@apnasikshalaya.com";
	$subject = "Requesting for Admin Panel Credentials | Apnasikshalaya";
	$body = "Dear Administrator,\n
		This is to inform you that Mr./Mrs : $username with an Email id $usermail has requested for his Password.
		 \n You might want to contact him.  \n\n Replay to this mail with his Credentials.";
	$headers = "From:Apna Sikshalaya <no_reply@apnasikshalaya.com>" . "\r\n". "Reply-To: $usermail";
	if(mail($superadminemail, $subject, $body, $headers)){
		header("Location: ./login.php?status=sentforgotmail");
        exit();
	}else{
		header("Location: ./login.php?status=error");
		exit();
	}
        



}
