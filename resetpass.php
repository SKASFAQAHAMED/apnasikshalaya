<?php
include_once "/home/admin/web/apnasikshalaya.com/public_html/sn/con.php";
session_start();

if(isset($_POST['newpass'])){
    $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email'], ENT_QUOTES));
    $newpass = mysqli_real_escape_string($con, htmlspecialchars($_POST['newpass'], ENT_QUOTES));
    $sql = "UPDATE apnaStudents SET passIs = ? WHERE emailIs = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("ss", $newpass, $email);
    if($stmt->execute()){
        $_SESSION['resetmsg']="Password updated Succussfully";
        echo $_SESSION['resetmsg'];
        header("https://apnasikshalaya.com");
    }else{
        echo"Error";
    }
}
if(isset($_GET['token'])){
    $token = mysqli_real_escape_string($con, htmlspecialchars($_GET['token'], ENT_QUOTES));
    echo'<!DOCTYPE html>';
    include_once 'header.php';
    echo '  <html lang="en">
    <style>
		* {font-family: "Bona nova";}
		.form {padding: 24px; width: 84%; display: block; margin: 20vh auto; border-radius: 12px;
			box-shadow: 0 16px 22px 0 rgba(90, 91, 95, 0.2);}
		.center {text-align: center; display: block; margin: auto;}
		.a {text-decoration: underline;}
		.input {width: 90% !important; margin: auto !important;}
		.alert {width: 84% !important; margin: 12vh auto; display: block;}
		input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
  			-webkit-appearance: none; margin: 0;}
  		input[type=number] {-moz-appearance: textfield;}
	</style>

    <div>
        <form action="resetpass.php" method="post" class="form">
          <h2 class="center">'.$_SESSION['resetmsg'].'</h2>         
          <input type="hidden" class="form-control" name="email" value="'.$token.'">
            <div class="form-group">
                <label class="center" for="exampleInputPassword1">Enter New Password</label>
                <input type="password" class="form-text input" name="newpass" id="newpass" placeholder="Password">
            </div>
            <div class="form-group">
                <label class="center" for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-text input" id="newpassc" placeholder="Password">
            </div>
            <div id="message">
            </div>
                <button id="submitbtn" type="submit" class="arrow-btn center">Submit</button>
        </form>
    </div>


    ';
    include_once 'footer.php';
}
