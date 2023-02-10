<!--
This website is designed & developed by
     ___           _________ _________ _________  ________ _________  ________ _________  ___           __
    / _ \         / / __   //___  ___//___  ___/ / ______//___  ___/ / ______//___  ___/ / _ \         / /
   / / \ \       / / /__/ /    / /       / /    / /__        / /    / /          / /    / / \ \       / /
  / /   \ \     / /  ____/    / /       / /    / ___/       / /    / /          / /    / /   \ \     / /
 / /_____\ \   / / \ \       / /    ___/ /___ / /       ___/ /___ / /______ ___/ /___ / /_____\ \   / /_____
/___________\ /_/   \_\     /_/    /________//_/       /________//________//________//___________\ /_______/
                          ________          _________         _________         _______    
                         /  _____/         / / __   /        /___  ___/        / __   /   
                        / /               / / /__/ /            / /           / /  / /    
                       / /               / /  ____/            / /           / /  / /     
                      / /______         / / \ \            ___/ /___        / /__/ /       
                     /________/        /_/   \_\          /________/       /______/       
Visit crioit.com for more info.
-->
<?php
include_once '../sn/con.php';
session_start();
$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
$googleId = $_SESSION['googleId'];
$auth=$_SESSION['auth'];
$sql = "SELECT * FROM apnaStudents WHERE emailIs = ? && passIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows() != 1) {
	$sql3 = "SELECT * FROM apnaStudents WHERE emailIs = ? && googleId = ?;";
	$stmt3 = $con->stmt_init();
	$stmt3->prepare($sql3);
	$stmt3->bind_param("ss", $user, $googleId);
	$stmt3->execute();
	$stmt3->store_result();
	if($stmt3->num_rows() != 1) {
		header("Location: /index?from=signin&status=error");
		exit();
	}
	$stmt3->bind_result($id, $googleId, $name, $gender, $contact, $altContact, $dob, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $quality, $institute, $test, $tuition, $proCourse, $cerCourse, $comCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra, $lastlogin, $firstlogin, $thumbnail, $creditscore);
	$stmt3->fetch();
	$_SESSION['pass'] = $password;
} else {
	$stmt->bind_result($id, $googleId, $name, $gender, $contact, $altContact, $dob, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $quality, $institute, $test, $tuition, $proCourse, $cerCourse, $comCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra, $lastlogin, $firstlogin, $thumbnail, $creditscore);
	$stmt->fetch();
}
	//here add the code where the users designation and email is stored in the 
			// verify table where the row id is in the session verifyrowid
			if(isset($_SESSION['verifyrowid'])){
				$visitorrowid = $_SESSION['verifyrowid'];
				$desig = "student";
				$sql = "UPDATE visitorsIs SET desigIs = '$desig' AND emailIs = ' $email' WHERE id = '$visitorrowid';";
				mysqli_query($con,$sql);
			}
	if($verify == 1) {
	if($name == null || $gender == null || $contact == null || $altContact == null || $dob == null || $email == null || $address == null || $city == null || $state == null || $pin == null || $quality == null || $institute == null) {
		header("Location: /student_profile?status=data");
		exit();
	} if($test == null && $tuition == null && $proCourse == null && $cerCourse == null && $comCourse == null && $crashCourse == null && $studyMaterial == null) {
		header("Location: /student_profile?status=interest");
		exit();
	}
	echo '<!DOCTYPE html>';
		include_once './header.php';
		echo '<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome back '.$name.'</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/user-solid.svg">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/owl.theme.default.css">
	<link rel="stylesheet" href="../css/header.css">
	<link rel="stylesheet" href="../css/footer.css">
	<link rel="stylesheet" href="../css/footerstyle.css">
	<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	</head>
	<body>
	<div id="colorlib-page">
		<div class="container-wrap">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
		<div class="stick">
			<div class="text-center">
				<div class="author-img" style="background-image: url(images/user-solid.svg);"></div>
				<h1 id="colorlib-logo"><a href="index.html">'.$name.'</a></h1>
				<span class="position">'.$email.'</span>
				<a href="./logout.php">Logout</a>
			</div>
			<nav id="colorlib-main-menu" role="navigation" class="navbar">
				<div id="navbar" class="collapse">
					<ul>
						<li class="active"><a href="#" data-nav-section="home">Home</a></li>
						<li><a href="#" data-nav-section="courses">Courses</a></li>
						<li><a href="#" data-nav-section="classes">Online Classes</a></li>
						<li><a href="#" data-nav-section="mokTests">Mock Tests</a></li>
						<li><a href="#" data-nav-section="onlineTest">Online Test</a></li>
						<li><a href="#" data-nav-section="homeTution">Home Tution</a></li>
						<li><a href="#" data-nav-section="syllabus">Syllabus</a></li>
						<li><a href="#" data-nav-section="studyMaterial">Study Material</a></li>
						<li><a href="#" data-nav-section="consultancy">Consultancy For You</a></li>
						<li><a href="#" data-nav-section="teacherAvailable">Teachers Available</a></li>
						<li><a href="#" data-nav-section="contact">Profile</a></li>
					</ul>
				</div>
			</nav>
			</div>
		</aside>
		<div id="colorlib-main">
			<section id="colorlib-hero" class="js-fullheight" data-section="home">';
			if($_GET['status'] == "profile_update") {
				echo '<div class="alert alert-success" role="alert">Profile updated successfully.</div>';
			}
				echo '<div class="flexslider js-fullheight">
					<ul class="slides">
				   	<li style="background-image: url(images/img_bg_1.jpg); border-radius: 12px;">
				   		<div class="overlay"></div>
				   		<div class="container-fluid">
				   			<div class="row show-case">
					   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 col-sm-12 col-xs-12 js-fullheight slider-text">
					   				<div class="slider-text-inner js-fullheight">
					   					<div class="desc">
						   					<h1>Suggested <br>Teacher 1</h1>
						   					<h2>Best teacher recomanded by Avinash Da</h2>
												<p class="arrow-btn"><a class=" btn-learn">View Portfolio</a></p>
											</div>
					   				</div>
					   			</div>
					   		</div>
				   		</div>
				   	</li>
				   	<li style="background-image: url(images/img_bg_2.jpg); border-radius: 12px;">
				   		<div class="overlay"></div>
				   		<div class="container-fluid">
				   			<div class="row show-case">
					   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 col-sm-12 col-xs-12 js-fullheight slider-text">
					   				<div class="slider-text-inner">
					   					<div class="desc">
						   					<h1>Suggested <br>Teacher 2</h1>
												<h2>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
												<p class="arrow-btn"><a class=" btn-learn">View Portfolio</a></p>
											</div>
					   				</div>
					   			</div>
					   		</div>
				   		</div>
				   	</li>
				  	</ul>
			  	</div>
			</section>
<!--courses-->
			<section class="colorlib-experience" data-section="courses">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Courses</span>
							<h2 class="colorlib-heading animate-box">Your Courses</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
				         <div class="timeline-centered">
					        <div class="row product">
								<div class="img col-md-4"><a href="#"><img src="images/download.jpeg" alt=""></a></div>
								 <div class="details col-md-8">
								   <a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
								  
								   <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
								   <div class="progress">
									<div class="progress-bar color-1" role="progressbar" aria-valuenow="75"
									 aria-valuemin="0" aria-valuemax="100" style="width:60%">
								   <span>60%</span>
									 </div>
							   </div>
								 </div>
							   </div>
						
								<div class="row product">
								 <div class="img col-md-4"><a href="#"><img src="images/images (2).jpeg" alt=""></a></div>
								  <div class="details col-md-8">
									<a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
									<div class="price">
									
									<p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
									<div class="progress">
										<div class="progress-bar color-2" role="progressbar" aria-valuenow="75"
										 aria-valuemin="0" aria-valuemax="100" style="width:75%">
									   <span>75%</span>
										 </div>
								   </div>
								  </div>
								</div>
								</div>
								<div class="row product">
								 <div class="img col-md-4"><a href="#"><img src="images/images (3).jpeg" alt=""></a></div>
								  <div class="details col-md-8">
									<a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
									
									<p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
											<div class="progress">
								 	<div class="progress-bar color-3" role="progressbar" aria-valuenow="75"
								  	aria-valuemin="0" aria-valuemax="100" style="width:65%">
								    <span>65%</span>
								  	</div>
								</div>
								  </div>
								</div>
								<div class="row product">
								 <div class="img col-md-4"><a href="#"><img src="images/download.jpeg" alt=""></a></div>
								  <div class="details col-md-8">
									<a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
								 
									<p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
									<div class="progress">
										<div class="progress-bar color-4" role="progressbar" aria-valuenow="75"
										 aria-valuemin="0" aria-valuemax="100" style="width:85%">
									   <span>85%</span>
										 </div>
								   </div>
								  </div>
								</div>
								<div class="row">
									<div class="col-md-12 animate-box">
										<p class="arrow-btn"><a href="#" class="btn-lg btn-load-more">View More</a></p>
									</div>
								</div>
					      </div>
					   </div>
				   </div>
				</div>
			</section>
			<!--classes-->
			<section class="colorlib-about" data-section="classes">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-12">
							<div class="row row-bottom-padded-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="col-md-12">
									<div class="about-desc">
										<span class="heading-meta">Classes</span>
										<h2 class="colorlib-heading">Your Online Classes</h2>
										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
									<div class="services color-1">
										
										<h3>Graphic Design</h3>
										<span class="icon2">Date-12/1/21</span>
										<span class="icon2">Time-12.20</span>
									</div>
								</div>
								<div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
									<div class="services color-2">
										<h3>Web Design</h3>
										<span class="icon2">Date-12/1/21</span>
										<span class="icon2">Time-12.20</span>
									</div>
								</div>
								<div class="col-md-4 animate-box" data-animate-effect="fadeInTop">
									<div class="services color-3">
										<h3>Software</h3>
										<span class="icon2">Date-12/1/21</span>
										<span class="icon2">Time-12.20</span>
									</div>
								</div>
								<div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
									<div class="services color-1">
										
										<h3>Graphic Design</h3>
										<span class="icon2">Date-12/1/21</span>
										<span class="icon2">Time-12.20</span>
									</div>
								</div>
								<div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
									<div class="services color-2">
										<h3>Web Design</h3>
										<span class="icon2">Date-12/1/21</span>
										<span class="icon2">Time-12.20</span>
									</div>
								</div>
						
								<div class="col-md-4 animate-box" data-animate-effect="fadeInBottom">
									<div class="services color-4">
										<h3>Application</h3>
										<span class="icon2">Date-12/1/21</span>
										<span class="icon2">Time-12.20</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 animate-box">
									<p class="arrow-btn"><a href="#" class="btn-lg btn-load-more">All Classes</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--Live Events-->
			
			<section class="colorlib-services" data-section="mokTests">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Events</span>
							<h2 class="colorlib-heading">Here are the events you are Subscribed</h2>
							<span class="heading-meta">(cancelled events will be deleted automatically)</span>
						</div>
					</div>
					<div class="row row-pt-md">';
					$userEmail = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
					$sql = "SELECT * FROM student_subs_event WHERE emailIs = ?;";
					$stmt = $con->stmt_init();
					$stmt->prepare($sql);
					$stmt->bind_param("s", $userEmail);
					$stmt->execute();
					$stmt->store_result();
                    $stmt->bind_result($subsid, $eventid, $eventName, $emailIs, $dateis, $timeIs, $nameIs, $phoneIs, $eventlink, $extra);
					while ($stmt->fetch()){
					echo'
					
						<div class="col-md-4 text-center animate-box">
							<div class="services color-1">
								<span class="icon">
									<i class="icon-bulb"></i>
								</span>
								<div class="desc">
									<h3>'.$eventName.'</h3>
									<p>Date-'.$dateis.'</p>
									<p>Time-'.$timeIs.'</p>
                                <button class="arrow-btn"><a draggable="false" href="'.$eventlink.'">Join Now</a></button>
								</div>
							</div>
						</div>
					';
					}
echo'           </div>
				</div>
			</section>
<!--Mok tests-->
			
			<section class="colorlib-services" data-section="mokTests">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Mok Tests</span>
							<h2 class="colorlib-heading">Here are some of Mock Tests</h2>
						</div>
					</div>
					<div class="row row-pt-md">
						<div class="col-md-4 text-center animate-box">
							<div class="services color-1">
								<span class="icon">
									<i class="icon-bulb"></i>
								</span>
								<div class="desc">
									<h3>Innovative Ideas</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-2">
								<span class="icon">
									<i class="icon-data"></i>
								</span>
								<div class="desc">
									<h3>Software</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-3">
								<span class="icon">
									<i class="icon-phone3"></i>
								</span>
								<div class="desc">
									<h3>Application</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-4">
								<span class="icon">
									<i class="icon-layers2"></i>
								</span>
								<div class="desc">
									<h3>Graphic Design</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-5">
								<span class="icon">
									<i class="icon-data"></i>
								</span>
								<div class="desc">
									<h3>Software</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-6">
								<span class="icon">
									<i class="icon-phone3"></i>
								</span>
								<div class="desc">
									<h3>Application</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<!--online tests-->
			<section class="colorlib-skills" data-section="onlineTest">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Your Tests</span>
							<h2 class="colorlib-heading animate-box">Online Tests</h2>
						</div>
					</div>
					<div class="row row-pt-md">
						<div class="col-md-4 text-center animate-box">
							<div class="services color-1">
							
								<div class="desc">
									<h3>Innovative Ideas</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-2">
							
								<div class="desc">
									<h3>Software</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-3">
								
								<div class="desc">
									<h3>Application</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-4">
							
								<div class="desc">
									<h3>Graphic Design</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-5">
								
								<div class="desc">
									<h3>Software</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
						<div class="col-md-4 text-center animate-box">
							<div class="services color-6">
							
								<div class="desc">
									<h3>Application</h3>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--home tution-->
			<section class="colorlib-experience" data-section="homeTution">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Tutions</span>
							<h2 class="colorlib-heading animate-box">Your Online Tutions</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
				         <div class="timeline-centered">
					        <div class="row product">
								<div class="img col-md-4"><a href="#"><img src="images/download.jpeg" alt=""></a></div>
								 <div class="details col-md-8">
								   <a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
								  
								   <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
								   <p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								 </div>
							   </div>
						
								<div class="row product">
								 <div class="img col-md-4"><a href="#"><img src="images/images (2).jpeg" alt=""></a></div>
								  <div class="details col-md-8">
									<a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
									<div class="price">
									
									<p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								  </div>
								</div>
								</div>
								<div class="row product">
								 <div class="img col-md-4"><a href="#"><img src="images/images (3).jpeg" alt=""></a></div>
								  <div class="details col-md-8">
									<a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
									
									<p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								  </div>
								</div>
								<div class="row product">
								 <div class="img col-md-4"><a href="#"><img src="images/download.jpeg" alt=""></a></div>
								  <div class="details col-md-8">
									<a href="#" style="text-decoration: none;"><h4>Tittle Goes here</h4></a>
								 
									<p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
									<p>Date-12/3/21</p>
									<p>Time-5.20</p>
                                <button class="arrow-btn"><a draggable="false" href="#">Join Now</a></button>
								  </div>
								</div>
								<div class="row">
									<div class="col-md-12 animate-box">
										<p class="arrow-btn"><a href="#" class="btn-lg btn-load-more">View More</a></p>
									</div>
								</div>
					      </div>
					   </div>
				   </div>
				</div>
			</section>
<!--syllabus-->
			<section class="colorlib-education" data-section="syllabus">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Syllabus</span>
							<h2 class="colorlib-heading animate-box">Your Syllabus</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
							<div class="fancy-collapse-panel">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingOne">
									        <h4 class="panel-title">
									            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Master Degree Graphic Design
									            </a>
									        </h4>
									    </div>
									    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									         <div class="panel-body">
									            <div class="row">
										      		<div class="col-md-6">
										      			<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
										      		</div>
										      		<div class="col-md-6">
										      			<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
										      		</div>
										      	</div>
									         </div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingTwo">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Bachelor Degree of Computer Science
									            </a>
									        </h4>
									    </div>
									    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									        <div class="panel-body">
									            <p>Far far away, behind the word <strong>mountains</strong>, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
													<ul>
														<li>Separated they live in Bookmarksgrove right</li>
														<li>Separated they live in Bookmarksgrove right</li>
													</ul>
									        </div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingThree">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Diploma in Information Technology
									            </a>
									        </h4>
									    </div>
									    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
									        <div class="panel-body">
									            <p>Far far away, behind the word <strong>mountains</strong>, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>	
									        </div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingFour">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Diploma in Information Technology
									            </a>
									        </h4>
									    </div>
									    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
									        <div class="panel-body">
									            <p>Far far away, behind the word <strong>mountains</strong>, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>	
									        </div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingFive">
									        <h4 class="panel-title">
									            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">High School Secondary Education
									            </a>
									        </h4>
									    </div>
									    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
									        <div class="panel-body">
									            <p>Far far away, behind the word <strong>mountains</strong>, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>	
									        </div>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
	<!--studyMaterial-->
			<section class="colorlib-work" data-section="studyMaterial">
				<div class="colorlib-narrow-content">
					<div class="row">
				<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
					<span class="heading-meta">Download study materials</span>
					<h2 class="colorlib-heading animate-box">Study Materials</h2>
				</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
							<div class="project" style="background-image: url(images/img-1.jpg);">
								<div class="desc">
									<div class="con">
										<h3><a href="work.html">Title</a></h3>
										<span>Download Pdf</span>
									
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInRight">
							<div class="project" style="background-image: url(images/img-2.jpg);">
								<div class="desc">
									<div class="con">
										<h3><a href="work.html">Title</a></h3>
										<span>Download Pdf</span>
									
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInTop">
							<div class="project" style="background-image: url(images/img-3.jpg);">
								<div class="desc">
									<div class="con">
										<h3><a href="work.html">Title</a></h3>
										<span>Download Pdf</span>
									
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInBottom">
							<div class="project" style="background-image: url(images/img-4.jpg);">
								<div class="desc">
									<div class="con">
										<h3><a href="work.html">Title</a></h3>
										<span>Download Pdf</span>
									
									</div>
								</div>
							</div>
						</div>
				
					</div>
					<div class="row">
						<div class="col-md-12 animate-box">
							<p class="arrow-btn"><a href="#" class="btn-lg btn-load-more">Load more <i class="icon-reload"></i></a></p>
						</div>
					</div>
				</div>
			</section>
<!--consultancy-->
			<section class="colorlib-blog" data-section="consultancy">
				<div class="colorlib-narrow-content">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
					<span class="heading-meta">Consultancy</span>
					<h2 class="colorlib-heading animate-box">Online Consultancy</h2>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae accusantium laboriosam quibusdam numquam dolores consectetur asperiores ipsum quasi, debitis veritatis quo, ad labore odio dolore, placeat incidunt! Dicta, aliquam culpa!</p>
				</div>
			</div>
</div>
</section>
<!--teacher-->
			<section class="colorlib-blog" data-section="teacherAvailable">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Teacher Available</span>
							<h2 class="colorlib-heading">Teachers For You</h2>
						</div>
					</div>
					<div class="row">
						<div class="portfolio-items grid owl-carousel" style="border-radius: 12px; overflow: hidden; box-shadow: 0 16px 22px 0 rgba(90,91,95,0.3);">
						   <div class="portfolio-item summer col-xs-12 col-sm-12 col-md-4 thumbs">
							 <figure class="effect-moses wow fadeIn" data-wow-delay="0.1s">
							  <a href="index.html">
						 <img src="images/teacher1.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>
						   </div><!-- /portfolio-item -->
	   
						   <div class="portfolio-item autumn col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher2.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>       
						   </div><!-- /portfolio-item -->
	   
						   <div class="portfolio-item spring col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher3.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>       
						   </div><!-- /portfolio-item -->
	   
						   <div class="portfolio-item spring col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher2.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						 </figure>       
						   </div><!-- /portfolio-item -->
				 
						   <div class="portfolio-item summer col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher1.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>     
						   </div><!-- /portfolio-item -->
	   
						   <div class="portfolio-item summer col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher3.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>       
						   </div><!-- /portfolio-item -->
	   
						   <div class="portfolio-item autumn col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher1.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>        
						   </div><!-- /portfolio-item -->
	   
						   <div class="portfolio-item autumn col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher2.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>      
						   </div><!-- /portfolio-item -->
						   
						   <div class="portfolio-item spring col-xs-12 col-sm-12 col-md-4 thumbs">
							  <figure class="effect-moses wow fadeIn">
							  <a href="index.html">
						 <img src="images/teacher3.png" alt=""/>
						 <figcaption>
							<h2>Teacher Name</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						 </figcaption>
							  </a>
						  </figure>  
						   </div><!-- /portfolio-item -->
						</div><!-- /portfolio-items -->
					  </div><!-- /row -->
				 
				</div>
			</section>
			<section class="colorlib-contact" data-section="contact">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<span class="heading-meta">Your portfolio</span>
							<h2 class="colorlib-heading">Profile</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
						<p><b>Contact no: </b>'.$contact.'. <br><b>Gender: </b>'.$gender.'<br><b>Alternative contact no: </b>'.$altContact.'. <br><b>Date of birth: </b>'.$dob.'. <br><b>Address: </b>'.$address.'. <br><b>City: </b>'.$city.'. <br><b>State: </b>'.$state.'. <br><b>Pin code: </b>'.$pin.'. <br><b>Educational Qualification: </b>'.$quality.'. <br><b>Institute: </b>'.$institute.'</p><br><br>
						</div>
						<div class="col-md-6 col-md-push-1">';
						if($test == "on") {
							echo '<p>Thank you for showing your interest in <b>Test Series</b>.</p>';
						} else {
							echo '<p><a href="#">Click here</a> to know how test series will help you.</p>';
						} if($tuition == "on") {
							echo '<p>Thank you for showing your interest in <b>Tuition Services</b>.</p>';
						} else {
							echo '<p><a href="#">Click here</a> to know how tuition services will help you.</p>';
						} if($proCourse == "on") {
							echo '<p>Thank you for showing your interest in <b>Professional Courses</b>.</p>';
						} else {
							echo '<p><a href="#">Click here</a> to know how professional courses will help you.</p>';
						} if($cerCourse == "on") {
							echo '<p>Thank you for showing your interest in <b>Certification Courses</b>.</p>';
						} else {
							echo '<p><a href="#">Click here</a> to know how certification courses will help you.</p>';
						} if($comCourse == "on") {
							echo '<p>Thank you for showing your interest in <b>Competitive Courses</b>.</p>';
						} else {
							echo '<p><a href="#">Click here</a> to know how competitive courses will help you.</p>';
						} if($crashCourse == "on") {
							echo '<p>Thank you for showing your interest in <b>Crash Courses</b>.</p>';
						} else {
							echo '<p><a href="#">Click here</a> to know how crash courses will help you.</p>';
						} if($studyMaterial == "on") {
							echo '<p>Thank you for showing your interest in <b>Study Materials</b></p>';
						} else {
							echo '<p><a href="#">Click here</a> to know how study materials will help you.</p>';
						}
						echo '
							<a href="/student_profile" class="arrow-btn">Update Profile</a>
							<a href="./logout.php" class="arrow-btn">Logout</a>
						<br><br>
					</div>
					</div>
				</div>
			</section>
		</div><!-- end:colorlib-main -->
	</div><!-- end:container-wrap -->
	</div><!-- end:colorlib-page -->
	<div class="footer--div">';
	// include_once '../footer.php';
	echo '</div><!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Counters -->
	<script src="js/jquery.countTo.js"></script>
	
	
	<!-- MAIN JS -->
	<script src="js/main.js"></script>
	</body>
</html>';
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
				header("Location: /email_verify?email=$email&status=invalid_otp");
				exit();
			}
		} else {
			header("Location: /email_verify?email=$email&status=not_verify");
			exit();
		}
	}
