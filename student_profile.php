<?php
include_once './sn/con.php';
session_start();
$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));

$sql = "SELECT * FROM apnaStudents WHERE emailIs = ? && passIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows() != 1) {
	if(isset($_SESSION['auth'])) {
		$stmt->bind_result($id, $googleId, $name, $gender, $contact, $altContact, $dob, $email, $password, $address, $address2, $city, $state, $dist, $pin, $quality, $institute, $test, $tuition, $proCourse, $cerCourse, $comCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra, $lastLogin, $firstuploadtime, $thumbnail, $creditScore);
		$stmt->fetch();
		if($googleId != $_SESSION['auth']) {
			// header("Location: /index?from=signin&status=error");
			// exit();
			echo '1';
		} else {
			$reqPass = 1;
		}
	} else {
		echo '2';
		// header("Location: /index?from=signin&status=error");
		// exit();
	}
} else {
	$stmt->bind_result($id, $googleId, $name, $gender, $contact, $altContact, $dob, $email, $password, $address, $address2, $city, $state, $dist, $pin, $quality, $institute, $test, $tuition, $proCourse, $cerCourse, $comCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra, $lastLogin, $firstuploadtime, $thumbnail, $creditScore);
	$stmt->fetch();
	$reqPass = 0;
}
	if($verify == 1) {
		echo '<!DOCTYPE html>';
		include_once './header.php';
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
		echo '<form class="form" method="POST" action="/admin/submit">
			<h2 class="center">Welcome '.$name.'</h2>
			<p class="center">Please fill all the information</p>
			<input type="hidden" name="from" value="student">
			<input type="hidden" name="student" value="'.$id.'">
			<input type="hidden" name="action" value="update">';
			if($reqPass == 1) {
				echo '<label class="center" for="pass">Create you apnasikshalaya password for more security</label>
				<input type="password" name="password" class="form-text input" id="pass" required>';
			}
			echo '<label class="center" for="email">Email</label>';
			if($email == null) {
				echo '<input type="email" name="email" class="form-text input" id="email" required>';
			} else {
				echo '<input name="email" class="form-text input" value="'.$email.'" readonly id="email">';
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
			} echo '<label class="center" for="quality">Educational qualification</label>';
			if($quality == null) {
				echo '<select name="quality" required id="quality" class="form-text input"
				onchange="if(this.value == \'Nursary\' || this.value == \'Primary\' || this.value == \'Secondary\' || this.value == \'Higher Secondary\') {
					document.querySelector(\'#school--tuition__div\').style.display = \'block\';
					document.querySelector(\'#college--tuition__div\').style.display = \'none\';
				} else {
					document.querySelector(\'#college--tuition__div\').style.display = \'block\';
					document.querySelector(\'#school--tuition__div\').style.display = \'none\';
				}">
						<option value="Nursary">Nursary</option>
						<option value="Primary">Primary</option>
						<option value="Secondary">Secondary</option>
						<option value="Higher Secondary">Higher Secondary</option>
						<option value="Graduate">Graduate</option>
						<option value="Master">Master</option>
						<option value="Doctor">Doctor</option>
						<option value="Post Doctor">Post Doctor</option>
					</select>';
			} else {
				echo '<input name="quality" class="form-text input" value="'.$quality.'" readonly id="quality">';
			} echo '<label class="center" for="institute">Institute</label>';
			if($institute == null) {
				echo '<input name="institute" required class="form-text input" id="institute" placeholder="Enter name of your institute">';
			} else {
				echo '<input name="institute" class="form-text input" value="'.$institute.'" readonly id="institute">';
			} echo '<div class="checkbox--main__div">
			<div class="checkbox--div">
			<label for="test">Interested in <b>Test Series</b></label>';
			if($test != "on") {
				echo '<input name="test" id="test" type="checkbox" onchange="this.checked == true ? document.querySelector(\'#test--input__div\').style.display = \'block\' : document.querySelector(\'#test--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="test" id="test" type="checkbox" checked onchange="this.checked == true ? document.querySelector(\'#test--input__div\').style.display = \'block\' : document.querySelector(\'#test--input__div\').style.display = \'none\' ">';
			} echo '</div><div class="checkbox--div">
			<label for="tuition">Interested in <b>Tuition Service</b></label>';
			if($tuition != "on") {
				echo '<input name="tuition" id="tuition" type="checkbox" onchange="this.checked == true ? document.querySelector(\'#tuition--input__div\').style.display = \'block\' : document.querySelector(\'#tuition--input__div\').style.display = \'none\' ">';
			} else {
				echo '<input name="tuition" id="tuition" type="checkbox" checked onchange="this.checked == true ? document.querySelector(\'#tuition--input__div\').style.display = \'block\' : document.querySelector(\'#tuition--input__div\').style.display = \'none\' ">';
			} echo '</div><div class="checkbox--div">
			<label for="pro">Interested in <b>Professional Courses</b></label>';
			if($proCourse != "on") {
				echo '<input name="proCourse" id="pro" type="checkbox">';
			} else {
				echo '<input name="proCourse" id="pro" type="checkbox" checked>';
			} echo '</div><div class="checkbox--div">
			<label for="cer">Interested in <b>Certification Courses</b></label>';
			if($cerCourse != "on") {
				echo '<input name="cerCourse" id="cer" type="checkbox">';
			} else {
				echo '<input name="cerCourse" id="cer" type="checkbox" checked>';
			} echo '</div><div class="checkbox--div">
			<label for="com">Interested in <b>Competitive Courses</b></label>';
			if($comCourse != "on") {
				echo '<input name="comCourse" id="com" type="checkbox">';
			} else {
				echo '<input name="comCourse" id="com" type="checkbox" checked>';
			} echo '</div><div class="checkbox--div">
			<label for="crash">Interested in <b>Crash Courses</b></label>';
			if($crashCourse != "on") {
				echo '<input name="crashCourse" id="crash" type="checkbox">';
			} else {
				echo '<input name="crashCourse" id="crash" type="checkbox" checked>';
			} echo '</div><div class="checkbox--div">
			<label for="study">Interested in <b>Study Materials</b></label>';
			if($studyMaterial != "on") {
				echo '<input name="studyMaterial" id="study" type="checkbox">';
			} else {
				echo '<input name="studyMaterial" id="study" type="checkbox" checked>';
			}
			echo '</div></div>
			<div id="test--input__div"';
			if($test == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '>
				<label for="testname" class="center">Prepairing for: </label>
					<select name="testname" id="testname" class="form-text input">
						<option value="NEET">NEET</option>
						<option value="CAT">CAT</option>
						<option value="UPSC">UPSC</option>
					</select>
				<label for="appearingon" class="center">Appearing on: </label>
					<select name="appearingon" id="appearingon" class="form-text input">
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
						<option value="2026">2026</option>
						<option value="2027">2027</option>
						<option value="2028">2028</option>
						<option value="2029">2029</option>
						<option value="2030">2030</option>
					</select>
				<label for="appearedbefore" class="center">Previously appeared: </label>
					<input name="appearedbefore" class="form-text input" id="appearedbefore" type="number" placeholder="Number of times you previously appeared" min="0">
			</div>
			<div id="tuition--input__div"';
			if($tuition == "on") {
				echo 'style="display: block;"';
			} else {
				echo 'style="display: none;"';
			}
			echo '><div id="school--tuition__div"'; 
			if($quality == "Nursary" || $quality == "Primary" || $quality == "Secondary" || $quality == "Higher Secondary") {
				echo ' style="display: block;"';
			} else {
				echo ' style="display: none;"';
			}
			echo '>
				<label for="className" class="center">Class name: </label>
					<select name="className" id="className" class="form-text input">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
				<label for="guardianName" class="center">Guardian Name: </label>
				<input name="guardianName" class="form-text input" id="guardianName" type="text" placeholder="Enter guardian name">
				<label for="boardName" class="center">Board Name: </label>
					<input name="boardName" id="boardName" list="boardNameList" class="form-text input">
					<datalist id="boardNameList">
						<option value="CBSE"></option>
						<option value="ICSE"></option>
						<option value="State Board"></option>
					</datalist>
                </div>
				<div id="college--tuition__div"'; 
			if($quality == "Graduate" || $quality == "Master" || $quality == "Doctor" || $quality == "Post Doctor") {
				echo ' style="display: block;"';
			} else {
				echo ' style="display: none;"';
			}
			echo '>
				<label for="yearName" class="center">Year: </label>
					<select name="yearName" id="yearName" class="form-text input">
						<option value="1">1st year</option>
						<option value="2">2nd year</option>
						<option value="3">3rd year</option>
						<option value="4">4th year</option>
					</select>
				<label for="specialization" class="center">Specialization: </label>
				<input name="specialization" class="form-text input" id="specialization" type="text" placeholder="Enter specialization">
                </div>
			</div>
			<button type="submit" class="arrow-btn center">Submit</button><br>
		</form>';
		// include_once 'footer.php';
	} else {
		if(isset($_POST['otp'])) {
			$otp = mysqli_real_escape_string($con, htmlspecialchars($_POST['otp'], ENT_QUOTES));
			$one = 1;
			if($otp == $verify) {
				$sql2 = "UPDATE apnaStudents SET verifyIs = ? WHERE id = ?;";
				$stmt2 = $con->stmt_init();
				$stmt2->prepare($sql2);
				$stmt2->bind_param("si", $one, $id);
				$stmt2->execute();
				$subject = "Apnasikshalaya email verification";
				$body = "Dear $name, your email is verified successfully.";
				$headers = "From: no_reply@apnasikshalaya.com" . "\r\n" ."CC: support@apnasikshalaya.com";
				mail($email, $subject, $body, $headers);
				header("Location: /student_profile");
				exit();
			} else {
				header("Location: email_verify?email=$email&status=invalid_otp");
				exit();
			}
		} else {
			header("Location: email_verify?email=$email&status=not_verify");
			exit();
		}
	}
