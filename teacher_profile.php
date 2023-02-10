<?php
include_once './sn/con.php';
session_start();
$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
if(isset($_SESSION['googleId'])){
	$auth=$_SESSION['googleId'];
	$sql = "SELECT * FROM apnaTeachers WHERE googleId = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("s", $auth);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() == 1){
	  $stmt->bind_result($id, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
		$stmt->fetch();
	  if(isset($_SESSION['verifyrowid'])){
		$visitorrowid = $_SESSION['verifyrowid'];
		$desig = "teacher";
		$sql = "UPDATE visitorsIs SET desigIs = '$desig' AND emailIs = '$email' WHERE id = '$visitorrowid';";
		mysqli_query($con,$sql);
	  }
	  $view = "show";
	  echo '<!DOCTYPE html>';
		include_once 'header.php';
		echo '
		<title>Welcome '.$name.' | Please update your profile</title>
		<style>
			.form {padding: 24px; width: 84%; display: block; margin: 6vh auto; border-radius: 12px;
			box-shadow: 0 16px 22px 0 rgba(90, 91, 95, 0.2);}
			.center {text-align: center; display: block; margin: 12px auto;}
			.a {text-decoration: underline;}
			.input {width: 90% !important; margin: 12px auto !important;}
			.alert {width: 84% !important; margin: 12vh auto; display: block;}
			select::-ms-expand {display: none;}
			.checkbox--main__div {width: 90%; margin: auto;}
			.checkbox--div {width: 30%; text-align: left; display: inline-block;}
			.checkbox--div input {margin-left: 12px;}
			@media only screen and (max-width: 768px) {.checkbox--div {width: 48%;}}
		</style>';
		if($_GET['status'] == "interest") {
			echo '<div class="alert alert-danger" role="alert">You need to have atleast 1 interest.</div>';
		} elseif($_GET['status'] == "data") {
			echo '<div class="alert alert-danger" role="alert">Your details are required.</div>';
		}
		echo '<form class="form" method="POST" action="/admin/submit.php" enctype="multipart/form-data">
			<h2 class="center">Welcome '.$name.'</h2>
			<p class="center">Please fill all the information</p>
			<input type="hidden" name="from" value="teacher_profilegoogleauth">
			<input type="hidden" name="teacher" value="'.$id.'">
			<input type="hidden" name="action" value="updategoogleauth">';
			echo '<label class="center" for="email">Email</label>';
			if($email == null) {
				echo '<input type="email" name="email" class="form-text input" id="email" required>';
			} else {
				echo '<input name="email" class="form-text input" value="'.$email.'" readonly id="email">
';
			}
			echo '<label class="center" for="email">please create a apnashikshalaya password</label>';
			if($password == null) {
				echo '<input type="text" name="password" class="form-text input" id="password" required>
				<input type="file" class="custom-file-input center" id="customFile" name="resume required">
                <label class="custom-file-label center" for="customFile">Upload Resume(PDF) This is an required field!</label> ';
			} else {
				echo '<input name="password" class="form-text input" value="'.$password.'" readonly id="password">
				<input type="file" class="custom-file-input center" id="customFile" name="resume required">
                <label class="custom-file-label center" for="customFile">Upload Resume(PDF) This is an required field!</label> 
';
			}
			echo '<label class="center" for="gender">Gender</label>';
			if($gender == null) {
				echo '<select name="gender" id="gender" class="form-text input" required="">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Other">Other</option>
					</select>';
			} else {
				echo '<input name="gender" class="form-text input" value="'.$gender.'" readonly id="gender">';
			} echo '<label class="center" for="contact">Contact No</label>';
			if($contact == null) {
				echo '<input type="tel" required name="contact" class="form-text input" id="contact" placeholder="Enter contact no.">';
			} else {
				echo '<input name="contact" class="form-text input" value="'.$contact.'" readonly id="contact">';
			}  echo '<label class="center" for="altContact">Alternative Contact No</label>';
			if($altContact == null) {
				echo '<input type="tel" name="altContact" class="form-text input" id="altContact" placeholder="Enter alternative contact no.">';
			} else {
				echo '<input name="altContact" class="form-text input" value="'.$altContact.'" readonly id="altContact">';
			} echo '<label class="center" for="dob">Date of birth</label>';
			if($dob == null) {
				echo '<input name="dob" required class="form-text input" id="dob" placeholder="Enter your dob" type="date">';
			} else {
				echo '<input name="dob" class="form-text input" value="'.$dob.'" readonly id="dob">';
			} echo '<label class="center" for="address">Address</label>';
			if($address == null) {
				echo '<input type="text" required name="address" class="form-text input" id="address" placeholder="Enter your address">';
			} else {
				echo '<input name="address" class="form-text input" value="'.$address.'" readonly id="address">';
			} echo '<label class="center" for="city">City</label>';
			if($city == null) {
				echo '<input name="city" required class="form-text input" id="city" placeholder="Enter your city">';
			} else {
				echo '<input name="city" class="form-text input" value="'.$city.'" readonly id="city">';
			} echo '<label class="center" for="state">State</label>';
			if($state == null) {
				echo '<input name="state" required class="form-text input" id="state" placeholder="Enter your state">';
			} else {
				echo '<input name="state" class="form-text input" value="'.$state.'" readonly id="state">';
			} echo '<label class="center" for="pin">Pin</label>';
			if($pin == null) {
				echo '<input name="pin" class="form-text input" id="pin" placeholder="Enter your pin">';
			} else {
				echo '<input name="pin" required class="form-text input" value="'.$pin.'" readonly id="pin">';
			} echo '<div class="checkbox--main__div">
			<div class="checkbox--div">
			<label for="tuition">Interested in <b>Tuition Service</b></label>';
			if($tuition != "on") {
				echo '<input name="tuition" id="tuition1" type="checkbox" onchange="this.checked == true ? document.querySelector(\'#tuition--input__div\').style.display = \'block\' : document.querySelector(\'#tuition--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="tuition" id="tuition1" type="checkbox" value="on" checked onchange="this.checked == true ? document.querySelector(\'#tuition--input__div\').style.display = \'block\' : document.querySelector(\'#tuition--input__div\').style.display = \'none\' ">';
			} echo '</div><div class="checkbox--div">
			<label for="pro">Interested in <b>Professional Courses</b></label>';
			if($proCourse != "on") {
				echo '<input name="proCourse" id="pro1" type="checkbox"  onchange="this.checked == true ? document.querySelector(\'#pro--input__div\').style.display = \'block\' : document.querySelector(\'#pro--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="proCourse" id="pro1" type="checkbox" value="on" checked onchange="this.checked == true ? document.querySelector(\'#pro--input__div\').style.display = \'block\' : document.querySelector(\'#pro--input__div\').style.display = \'none\' ">';
			} echo '</div><div class="checkbox--div">
			<label for="cer">Interested in <b>Certification Courses</b></label>';
			if($cerCourse != "on") {
				echo '<input name="cerCourse" id="cer1" type="checkbox" onchange="this.checked == true ? document.querySelector(\'#certi--input__div\').style.display = \'block\' : document.querySelector(\'#certi--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="cerCourse" id="cer1" type="checkbox" value="on" checked onchange="this.checked == true ? document.querySelector(\'#certi--input__div\').style.display = \'block\' : document.querySelector(\'#certi--input__div\').style.display = \'none\' ">';
			} echo '</div></div>
			<div id="tuition--input__div"';
			if($tuition == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '>
				<div ';
			echo '>
				<label for="grade" class="center">Type or Please select which Grade you would like to teach</label>
				<input class="form-text input" list="grade" name="grade" id="tgrade">
			    <datalist id="grade">
				 <option value="1 to 5">
				 <option value="6 to 8">
				 <option value="9, 10, 11 and 12(Regular Curriculum)">
				 <option value="11 and 12(JEE Mains/NEET Level)">
			    </datalist>
			    <label class="center" for="board" >Type or Please select the Education Board you can handle</label>
				<input class="form-text input" list="board" name="board" id="tboard">
			    <datalist id="board">
				<option value="CBSE">
				<option value="ICSE">
			    </datalist>
			    <label for="tuisubject" class="center">Type or Please select the Subjects you can teach</label>
				<input class="form-text input" list="tuisubject" name="tuisubject" id="ttuisubject">
			    <datalist id="subject">
				<option value="Physics">
				<option value="Chemistry">
			    </datalist>
			    <label for="secsubject" class="center">Type or Please select the Seconadary Subjects you can teach</label>
				<input class="form-text input" list="secsubject" name="secsubject" id="tsecsubject">
			    <datalist id="secsubject">
				<option value="Physics">
				<option value="Chemistry">
			    </datalist>
				<label for="tuispecialization" class="center">Specialization: </label>
				<input name="tuispecialization" class="form-text input" id="tuispecialization" type="text" placeholder="Enter specialization">
				<label for="tuihour" class="center">Hours you can Teach</label>
				<input name="tuihour" class="form-text input" id="tuihour" type="text" placeholder="Enter Hours">
				
			
            </div></div>
			<div id="certi--input__div"';
			if($cerCourse == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '>
				<div ';
			echo '>
				<label class="center" for="certicourse" class="center">Type or Please select Certification Courses you would like to teach</label>
				<input class="form-text input" list="grade" name="certicourse" id="certicourse">
			<datalist id="certicourse">
				<option value="Physics">
				<option value="CS">
				<option value="Chemistry">
				<option value="Maths">
			  </datalist>
			  <label for="certisubject" class="center">Type or Please select the Subjects you can teach</label>
				<input class="form-text input" list="certisubject" name="certisubject" id="certisubject">
			<datalist id="certisubject">
				<option value="Physics">
				<option value="Chemistry">
			  </datalist>
				<label for="certispecialization" class="center">Certification Specialization: </label>
				<input name="certispecialization" class="form-text input" id="certispecialization" type="text" placeholder="Enter specialization">
				<label for="certihour" class="center">Hours you can Teach</label>
				<input name="certihour" class="form-text input" id="certihour" type="text" placeholder="Enter Hours">
				
				
            </div>
		</div>
			<div id="pro--input__div"';
			if($proCourse == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '>
				<div ';
			echo '>
				<label class="center" for="procourse" class="center">Type or Please select which Professional Course you would love to teach</label>
				<input class="form-text input" list="procourse" name="procourse" id="procourse">
			<datalist id="procourse">
			<option value="Physics">
			<option value="CS">
			<option value="Chemistry">
			<option value="Maths">
			  </datalist>
			  <label for="prosubject" class="center">Type or Please select the Subjects you can teach in Professional Course category</label>
				<input class="form-text input" list="prosubject" name="prosubject" id="prosubject">
			<datalist id="prosubject">
				<option value="Physics">
				<option value="Chemistry">
			  </datalist>
				<label for="prospecialization" class="center">Professional Specialization: </label>
				<input name="prospecialization" class="form-text input" id="prospecialization" type="text" placeholder="Enter Professional Course specialization">
				<label for="prohour" class="center">Hours you can Teach</label>
				<input name="prohour" class="form-text input" id="prohour" type="text" placeholder="Enter Hours">
				
            </div>
		</div>
			<button type="submit" class="arrow-btn center">Submit</button><br>
		</form>';
		include_once 'footer.php';
	
	} else {
	  header("Location: /index.php?from=signinteacher&error=googleidusernotfound");
	  exit();
	 }
	} 
if(!isset($_SESSION['googleId'])){
$sql = "SELECT * FROM apnaTeachers WHERE emailIs = ? && passIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows() != 1) {
	header("Location: /index?from=signin&status=error");
	exit();
} 
else {
	$stmt->bind_result($id, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
	$stmt->fetch();
	if($verify == 1) {
		echo '<!DOCTYPE html>';
		include_once 'header.php';
		echo '
		<title>Welcome '.$name.' | Please update your profile</title>
		<style>
			.form {padding: 24px; width: 84%; display: block; margin: 6vh auto; border-radius: 12px;
			box-shadow: 0 16px 22px 0 rgba(90, 91, 95, 0.2);}
			.center {text-align: center; display: block; margin: 12px auto;}
			.a {text-decoration: underline;}
			.input {width: 90% !important; margin: 12px auto !important;}
			.alert {width: 84% !important; margin: 12vh auto; display: block;}
			select::-ms-expand {display: none;}
			.checkbox--main__div {width: 90%; margin: auto;}
			.checkbox--div {width: 30%; text-align: left; display: inline-block;}
			.checkbox--div input {margin-left: 12px;}
			@media only screen and (max-width: 768px) {.checkbox--div {width: 48%;}}
		</style>';
		if($_GET['status'] == "interest") {
			echo '<div class="alert alert-danger" role="alert">You need to have atleast 1 interest.</div>';
		} elseif($_GET['status'] == "data") {
			echo '<div class="alert alert-danger" role="alert">Your details are required.</div>';
		}
		echo '<form class="form" method="POST" action="/admin/submit.php" enctype="multipart/form-data">
			<h2 class="center">Welcome '.$name.'</h2>
			<p class="center">Please fill all the information</p>
			<input type="hidden" name="from" value="teacher_profile">
			<input type="hidden" name="teacher" value="'.$id.'">
			<input type="hidden" name="action" value="update">';
			echo '<label class="center" for="email">Email</label>';
			if($email == null) {
				echo '<input type="email" name="email" class="form-text input" id="email" required>';
			} else {
				echo '<input name="email" class="form-text input" value="'.$email.'" readonly id="email">
				<input type="file" class="custom-file-input center" id="customFile" name="resume required">
                <label class="custom-file-label center" for="customFile">Upload Resume(PDF) This is an required field!</label> 
';
			}
			echo '<label class="center" for="gender">Gender</label>';
			if($gender == null) {
				echo '<select name="gender" id="gender" class="form-text input" required="">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Other">Other</option>
					</select>';
			} else {
				echo '<input name="gender" class="form-text input" value="'.$gender.'" readonly id="gender">';
			} echo '<label class="center" for="contact">Contact No</label>';
			if($contact == null) {
				echo '<input type="tel" required name="contact" class="form-text input" id="contact" placeholder="Enter contact no.">';
			} else {
				echo '<input name="contact" class="form-text input" value="'.$contact.'" readonly id="contact">';
			}  echo '<label class="center" for="altContact">Alternative Contact No</label>';
			if($altContact == null) {
				echo '<input type="tel" name="altContact" class="form-text input" id="altContact" placeholder="Enter alternative contact no.">';
			} else {
				echo '<input name="altContact" class="form-text input" value="'.$altContact.'" readonly id="altContact">';
			} echo '<label class="center" for="dob">Date of birth</label>';
			if($dob == null) {
				echo '<input name="dob" required class="form-text input" id="dob" placeholder="Enter your dob" type="date">';
			} else {
				echo '<input name="dob" class="form-text input" value="'.$dob.'" readonly id="dob">';
			} echo '<label class="center" for="address">Address</label>';
			if($address == null) {
				echo '<input type="text" required name="address" class="form-text input" id="address" placeholder="Enter your address">';
			} else {
				echo '<input name="address" class="form-text input" value="'.$address.'" readonly id="address">';
			} echo '<label class="center" for="city">City</label>';
			if($city == null) {
				echo '<input name="city" required class="form-text input" id="city" placeholder="Enter your city">';
			} else {
				echo '<input name="city" class="form-text input" value="'.$city.'" readonly id="city">';
			} echo '<label class="center" for="state">State</label>';
			if($state == null) {
				echo '<input name="state" required class="form-text input" id="state" placeholder="Enter your state">';
			} else {
				echo '<input name="state" class="form-text input" value="'.$state.'" readonly id="state">';
			} echo '<label class="center" for="pin">Pin</label>';
			if($pin == null) {
				echo '<input name="pin" class="form-text input" id="pin" placeholder="Enter your pin">';
			} else {
				echo '<input name="pin" required class="form-text input" value="'.$pin.'" readonly id="pin">';
			} echo '<div class="checkbox--main__div">
			<div class="checkbox--div">
			<label for="tuition">Interested in <b>Tuition Service</b></label>';
			if($tuition != "on") {
				echo '<input name="tuition" id="tuition1" type="checkbox" onchange="this.checked == true ? document.querySelector(\'#tuition--input__div\').style.display = \'block\' : document.querySelector(\'#tuition--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="tuition" id="tuition1" type="checkbox" value="on" checked onchange="this.checked == true ? document.querySelector(\'#tuition--input__div\').style.display = \'block\' : document.querySelector(\'#tuition--input__div\').style.display = \'none\' ">';
			} echo '</div><div class="checkbox--div">
			<label for="pro">Interested in <b>Professional Courses</b></label>';
			if($proCourse != "on") {
				echo '<input name="proCourse" id="pro1" type="checkbox"  onchange="this.checked == true ? document.querySelector(\'#pro--input__div\').style.display = \'block\' : document.querySelector(\'#pro--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="proCourse" id="pro1" type="checkbox" value="on" checked onchange="this.checked == true ? document.querySelector(\'#pro--input__div\').style.display = \'block\' : document.querySelector(\'#pro--input__div\').style.display = \'none\' ">';
			} echo '</div><div class="checkbox--div">
			<label for="cer">Interested in <b>Certification Courses</b></label>';
			if($cerCourse != "on") {
				echo '<input name="cerCourse" id="cer1" type="checkbox" onchange="this.checked == true ? document.querySelector(\'#certi--input__div\').style.display = \'block\' : document.querySelector(\'#certi--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="cerCourse" id="cer1" type="checkbox" value="on" checked onchange="this.checked == true ? document.querySelector(\'#certi--input__div\').style.display = \'block\' : document.querySelector(\'#certi--input__div\').style.display = \'none\' ">';
			} echo '</div></div>
			<div id="tuition--input__div"';
			if($tuition == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '>
				<div ';
			echo '>
				<label for="grade" class="center">Type or Please select which Grade you would like to teach</label>
				<input class="form-text input" list="grade" name="grade" id="tgrade">
			    <datalist id="grade">
				 <option value="1 to 5">
				 <option value="6 to 8">
				 <option value="9, 10, 11 and 12(Regular Curriculum)">
				 <option value="11 and 12(JEE Mains/NEET Level)">
			    </datalist>
			    <label class="center" for="board" >Type or Please select the Education Board you can handle</label>
				<input class="form-text input" list="board" name="board" id="tboard">
			    <datalist id="board">
				<option value="CBSE">
				<option value="ICSE">
			    </datalist>
			    <label for="tuisubject" class="center">Type or Please select the Subjects you can teach</label>
				<input class="form-text input" list="tuisubject" name="tuisubject" id="ttuisubject">
			    <datalist id="subject">
				<option value="Physics">
				<option value="Chemistry">
			    </datalist>
			    <label for="secsubject" class="center">Type or Please select the Seconadary Subjects you can teach</label>
				<input class="form-text input" list="secsubject" name="secsubject" id="tsecsubject">
			    <datalist id="secsubject">
				<option value="Physics">
				<option value="Chemistry">
			    </datalist>
				<label for="tuispecialization" class="center">Specialization: </label>
				<input name="tuispecialization" class="form-text input" id="tuispecialization" type="text" placeholder="Enter specialization">
				<label for="tuihour" class="center">Hours you can Teach</label>
				<input name="tuihour" class="form-text input" id="tuihour" type="text" placeholder="Enter Hours">
				
			
            </div></div>
			<div id="certi--input__div"';
			if($cerCourse == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '>
				<div ';
			echo '>
				<label class="center" for="certicourse" class="center">Type or Please select Certification Courses you would like to teach</label>
				<input class="form-text input" list="grade" name="certicourse" id="certicourse">
			<datalist id="certicourse">
				<option value="Physics">
				<option value="CS">
				<option value="Chemistry">
				<option value="Maths">
			  </datalist>
			  <label for="certisubject" class="center">Type or Please select the Subjects you can teach</label>
				<input class="form-text input" list="certisubject" name="certisubject" id="certisubject">
			<datalist id="certisubject">
				<option value="Physics">
				<option value="Chemistry">
			  </datalist>
				<label for="certispecialization" class="center">Certification Specialization: </label>
				<input name="certispecialization" class="form-text input" id="certispecialization" type="text" placeholder="Enter specialization">
				<label for="certihour" class="center">Hours you can Teach</label>
				<input name="certihour" class="form-text input" id="certihour" type="text" placeholder="Enter Hours">
				
				
            </div>
		</div>
			<div id="pro--input__div"';
			if($proCourse == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '>
				<div ';
			echo '>
				<label class="center" for="procourse" class="center">Type or Please select which Professional Course you would love to teach</label>
				<input class="form-text input" list="procourse" name="procourse" id="procourse">
			<datalist id="procourse">
			<option value="Physics">
			<option value="CS">
			<option value="Chemistry">
			<option value="Maths">
			  </datalist>
			  <label for="prosubject" class="center">Type or Please select the Subjects you can teach in Professional Course category</label>
				<input class="form-text input" list="prosubject" name="prosubject" id="prosubject">
			<datalist id="prosubject">
				<option value="Physics">
				<option value="Chemistry">
			  </datalist>
				<label for="prospecialization" class="center">Professional Specialization: </label>
				<input name="prospecialization" class="form-text input" id="prospecialization" type="text" placeholder="Enter Professional Course specialization">
				<label for="prohour" class="center">Hours you can Teach</label>
				<input name="prohour" class="form-text input" id="prohour" type="text" placeholder="Enter Hours">
				
            </div>
		</div>
			<button type="submit" class="arrow-btn center">Submit</button><br>
		</form>';
		include_once 'footer.php';
	} else {
		if(isset($_POST['otp'])) {
            $otp = mysqli_real_escape_string($con, htmlspecialchars($_POST['otp'], ENT_QUOTES));
            $one = 1;
            if($otp == $verify) {
              $sql2 = "UPDATE apnaTeachers SET verifyIs = ? WHERE id = ?;";
              $stmt2 = $con->stmt_init();
              $stmt2->prepare($sql2);
              $stmt2->bind_param("si", $one, $id);
              $stmt2->execute();
              $subject = "Apnasikshalaya email verification";
              $body = "Dear $name, your email is verified successfully.";
              $headers = "From: no_reply@apnasikshalaya.com" . "\r\n" ."CC: support@apnasikshalaya.com";
              mail($email, $subject, $body, $headers);
              header("Location: https://apnasikshalaya.com/teacher_profile");
              exit();
            } else {
              header("Location: /teacher_email_verify?email=$email&status=invalid_otp");
              exit();
            }
          } else {
            header("Location: /teacher_email_verify?email=$email&status=not_verify");
            exit();
          }
	}
}
}