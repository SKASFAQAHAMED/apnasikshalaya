<?php
include_once "../sn/con.php";
session_start();
$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
$Role = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['Role'], ENT_QUOTES));
if ($Role == "teacher") {
  $sql = "SELECT id, nameIs, thumbnailIs FROM apnaTeachers WHERE emailIs = ? && passIs = ?;";
  $stmt = $con->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("ss", $user, $pass);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows() == 1) {
    $loggedin = true;
    $stmt->store_result();
    $stmt->bind_result($teacherId, $teacherName, $dp);
    $stmt->fetch();
    $Role = "teacher";
  } else {
    $loggedin = false;
  }
} else {
  $loggedin = false;
}
if(!isset($_SESSION['verifyrowid'])){ 
  //here the code goes for storing the ip adress in the verify table with other information 
  $browser=new Wolfcast\BrowserDetection;
  $browser_name=$browser->getName();
  $browser_version=$browser->getVersion();
  $detect=new Mobile_Detect();
  //detecting device
  if($detect->isMobile()){
    $type='Mobile';
  }elseif($detect->isTablet()){
    $type='Tablet';
  }else{
    $type='PC';
  }
  //detecting operating system
  if($detect->isiOS()){
    $os='IOS';
  }elseif($detect->isAndroidOS()){
    $os='Android';
  }else{
    $os='Window';
  }
  //getting the ip adress
  //below script is used to get clients ip address
  function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }
  $ipaddres = get_client_ip();
  //now we will get the country according to the ip
  $ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ipaddres));
  $country = $ipdat->geoplugin_countryName;
  //remember to get the id of the row the datails are stored in
  $extra = "show";
  mysqli_query($con, "INSERT INTO visitorsIs (ipaddressIs, deviceIs, osIs, countryIs, extra) VALUES ('$ipaddres', '$type', '$os', '$country', '$extra')");
          $last_id = mysqli_insert_id($con);
          $_SESSION['verifyrowid'] = $last_id;
  //end
  // }
  // include_once "configapi.php";
  // if (isset($_SESSION['access_token'])) {
  //   header('Location: /');
  //   exit();
  } else {
    $visitorId = $_SESSION['verifyrowid'];
    $sql8 = "UPDATE visitorsIs SET desigIs = ? WHERE id = ?;";
    $stmt8 = $con->stmt_init();
    $stmt8->prepare($sql8);
    $stmt8->bind_param("si", $teacher, $visitorId);
    $stmt8->execute();
  }






// include_once "configapi.php";
// if (isset($_SESSION['access_token'])) {
//   header('Location: /');
//   exit();
// }
// $loginURL = $gClient->createAuthUrl();







// require_once "../configapi.php";
// 	if(isset($_GET["code"])){
// 		$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
// 		if(!isset($token['error'])){
// 			$google_client->setAccessToken($token['access_token']);
// 			$_SESSION['access_token']=$token['access_token'];
// 			$google_service = new Google_Service_Oauth2($google_client);
// 			$data = $google_service->userinfo->get();
// 			$_SESSION['user_email_address'] =$data['email'];
// 			$_SESSION['user_first_name'] =$data['given_name'];
// 			$_SESSION['user_last_name'] =$data['family_name'];
// 			$_SESSION['user_image'] =$data['picture'];
// 			$_SESSION['login_button'] =false;
// 		}
// 	}
// 	if(isset($_SESSION['login_button'])){
// 		$login_button=$_SESSION['login_button'];
// 	} else{
// 		$login_button = true;
// 	}
?>



<!-- below code is used to get the dynamic url for google api login -->
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="174728225070-v2j1f90t8snlkggek8jn1evtu5h46987.apps.googleusercontent.com">
  <link rel="shortcut icon" type="image/png" href="../images/s-icon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="CriO Family">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/header.css">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>
<body>
<div class="container-fluid" style="z-index: 9;">
  <div class="row">
    <div class="col-md-1 col-sm-1 col-xs-2 wow animate__animated animate__fadeInUp smoothScroll">
      <img src="images/logo.png" class="nav-logo" draggable="false" data-toggle="modal" data-target="#myLogoModel">
    </div>
    <div class="col-md-1 col-sm-1 col-xs-2 wow animate__animated animate__fadeInUp smoothScroll">
      <a href="/" style="text-decoration:none;">
        <button id="backToHome" class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn" style="margin-left: 12px;">
          <i class="fas fa-home"></i>
        </button></a>
    </div>
    <div class="col-md-0 col-sm-1 col-xs-2 mobile-show"></div>
    <div class="col-md-1 col-sm-1 col-xs-2 wow animate__animated animate__fadeInUp smoothScroll mobile-show">
    <button role="button" aria-expanded="false" class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn" data-toggle="modal" data-target="#cataModel"><i class="fas fa-book"></i></button>
    </div>
    <div class="col-md-8 col-sm-8 col-xs-0 mobile-hide" style="text-align: center;">
      <form action="/search.php" method="GET">
        <input id="header-id" class="wow animate__animated animate__fadeInUp smoothScroll nav-search-input app_text_search" placeholder="Click me and start typing" name="query" required="">
        <button id="searchbutton" class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn" style="margin-left: 12px;">
          <span>Search </span><i class="fa fa-search"></i>
        </button>
      </form>
    </div>
    <div class="col-md-1 col-sm-1 col-xs-0 mobile-hide">
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <button class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn">
            <a href="/teacher/index">
          <?php if ($dp != null) {
            echo '<img src="' . $dp . '" class="header__dp" height="24" width="24">';
          } else {
            echo '<i class="fas fa-user-graduate"></i>';
          }
          ?>
          </a>
          </button>
              </a>
            </li>
          </ul>
    </div>
    <div class="col-md-1 col-sm-1 col-xs-0 mobile-hide">
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a href="./logout.php"><button id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn" data-toggle="modal"><i class="fas fa-sign-out-alt"></i></button></a>
            </li>
          </ul>
    </div>
    <!-- <div class="col-md-2 col-sm-2 col-xs-4 wow animate__animated animate__fadeInUp smoothScroll" style="text-align:center;">
    <?php
      if ($loggedin && $Role == "teacher") {
        echo '<button class="arrow-btn nav-arrow"><a href="/teacher/index">';
        if (strlen($teacherName) < 9) {
          $teacheruserName = explode(" ",$teacherName);
          $usernameshow =  $teacheruserName[0];
          echo $teacherName;
        } else {
          $teacheruserName = explode(" ",$teacherName);
          $usernameshow =  $teacheruserName[0];
          echo substr($teacherName, 0, 6) . '...';
        }
        echo '  <i class="fas fa-user-graduate"></i></a></button>';
      } else {
        echo '<button class="arrow-btn nav-arrow" data-toggle="modal" data-target="#dropDownModel">Sign Up  <i class="fas fa-user-graduate"></i></button>';
      }
      ?>
    </div>-->
    <?php 
    // if ($loggedin) {
    //   echo '<ul class="navbar-nav mx-auto col-md-1 col-sm-1 col-xs-0 mobile-hide">
    //   <li class="nav-item dropdown">
    //       <button class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn">
    //         <a href="/teacher/index">';
    //       if ($dp != null) {
    //         echo '<img src="' . $dp . '" class="header__dp" height="24" width="24">';
    //       } else {
    //         echo '<i class="fas fa-user-graduate"></i>';
    //       }
    //       echo '</a>
    //       </button>
    //       <ul class="dropdown-menu dropdown-menu_mid2" aria-labelledby="navbarDropdownMenuLink">
    //       <li>
    //         <p>Welcome '.$usernameshow.'</p>
    //       </li>';
    //       $sql5 = "SELECT DISTINCT cataIs FROM apnaCourses WHERE extra = ?;";
    //         $stmt5 = $con->stmt_init();
    //         $stmt5->prepare($sql5);
    //         $stmt5->bind_param("s", $show);
    //         $stmt5->execute();
    //         $stmt5->store_result();
    //         if($stmt5->num_rows() != 0) {
    //           echo '<li class="dropdown-submenu">
    //             <a class="dropdown-item dropdown-toggle" href="/video_index?id='.$id.'"><i class="fas fa-chevron-circle-left"></i> Courses</a>
    //             <ul class="dropdown-menu dropdown-menu_right">
    //               <li><p>______________________________________________</p></li>';
    //               $stmt4->bind_result($subCata);
    //               while($stmt4->fetch()) {
    //                 echo '<li><a class="dropdown-item" href="/search.php?query='.$subCata.'">'.$subCata.'</a></li>';
    //               }
    //                 echo '<li><p>______________________________________________</p></li>
    //             </ul>
    //             </li>';
    //         } else {
    //            echo '<li class="dropdown-submenu">
    //            <a class="dropdown-item dropdown-toggle" href="/student/#courses"><i class="fas fa-chevron-circle-left"></i> Courses</a>
    //            <ul class="dropdown-menu dropdown-menu_right">
    //              <li><p>______________________________________________</p></li>
    //              <li><p>There is no course in your portfolio.</p></li>
    //              <li><a href="/all_courses?type=certification" class="dropdown-item">Explore certification courses</a></li>
    //              <li><a href="/all_courses?type=professional" class="dropdown-item">Explore professional courses</a></li>
    //              <li><p>______________________________________________</p></li>
    //             </ul>
    //             </li>';
    //         }
    //         $sql6 = "SELECT DISTINCT cataIs FROM apnaCourses WHERE extra = ?;";
    //         $stmt6 = $con->stmt_init();
    //         $stmt6->prepare($sql6);
    //         $stmt6->bind_param("s", $show);
    //         $stmt6->execute();
    //         $stmt6->store_result();
    //         if($stmt6->num_rows() != 0) {
    //           echo '<li class="dropdown-submenu">
    //             <a class="dropdown-item dropdown-toggle" href="/video_index?id='.$id.'"><i class="fas fa-chevron-circle-left"></i> Tuition</a>
    //             <ul class="dropdown-menu dropdown-menu_right">
    //               <li><p>______________________________________________</p></li>';
    //               $stmt4->bind_result($subCata);
    //               while($stmt4->fetch()) {
    //                 echo '<li><a class="dropdown-item" href="/search.php?query='.$subCata.'">'.$subCata.'</a></li>';
    //               }
    //                 echo '<li><p>______________________________________________</p></li>
    //             </ul>
    //             </li>';
    //         } else {
    //            echo '<li class="dropdown-submenu">
    //            <a class="dropdown-item dropdown-toggle" href="/student/#tuition"><i class="fas fa-chevron-circle-left"></i> Tuition</a>
    //            <ul class="dropdown-menu dropdown-menu_right">
    //              <li><p>______________________________________________</p></li>
    //              <li><p>There is no tuition in your portfolio.</p></li>
    //              <li><a href="/tuition_index" class="dropdown-item">Explore tuitions</a></li>
    //              <li><p>______________________________________________</p></li>
    //             </ul>
    //             </li>';
    //         }
    //         $sql7 = "SELECT eventId, eventName FROM student_subs_event WHERE extra = ? AND emailIs = ?;";
    //         $stmt7 = $con->stmt_init();
    //         $stmt7->prepare($sql7);
    //         $stmt7->bind_param("ss", $show, $user);
    //         $stmt7->execute();
    //         $stmt7->store_result();
    //         if($stmt7->num_rows() != 0) {
    //           echo '<li class="dropdown-submenu">
    //             <a class="dropdown-item dropdown-toggle" href="/student/#events"><i class="fas fa-chevron-circle-left"></i> Live Events</a>
    //             <ul class="dropdown-menu dropdown-menu_right">
    //               <li><p>______________________________________________</p></li>';
    //               $stmt7->bind_result($eventId, $eventName);
    //               while($stmt7->fetch()) {
    //                 echo '<li><a class="dropdown-item" href="/search.php?query='.$eventId.'">'.$eventName.'</a></li>';
    //               }
    //                 echo '<li><p>______________________________________________</p></li>
    //             </ul>
    //             </li>';
    //         } else {
    //            echo '<li class="dropdown-submenu">
    //            <a class="dropdown-item dropdown-toggle" href="/student/#events"><i class="fas fa-chevron-circle-left"></i> Live Events</a>
    //            <ul class="dropdown-menu dropdown-menu_right">
    //              <li><p>______________________________________________</p></li>
    //              <li><p>There is no events in your portfolio.</p></li>
    //              <li><a href="/live_events" class="dropdown-item">Explore live events</a></li>
    //              <li><p>______________________________________________</p></li>
    //             </ul>
    //             </li>';
    //         }
    //       echo '<li class="dropdown-submenu">
    //       <a class="dropdown-item dropdown-toggle"><i class="fas fa-chevron-circle-left"></i> More</a>
    //       <ul class="dropdown-menu dropdown-menu_right">
    //         <li><p>______________________________________________</p></li>
    //         <li><a href="/ars_about" class="dropdown-item"><i class="fas fa-info-circle"></i> About us</a></li>
    //         <li><a href="/contact_us" class="dropdown-item"><i class="fas fa-address-card"></i> Contact us</a></li>
    //         <li><a href="/terms_and_conditions" class="dropdown-item"><i class="fas fa-scroll"></i> All Policies</a></li>
    //         <li><a href="/'.$Role.'/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Log out</a></li>
    //         <li><p>______________________________________________</p></li>
    //        </ul>
    //        </li>
    //       <li>
    //         <p>__________________________</p>
    //       </li>
    //     </ul>
    //   </li>
    // </ul>';
    // } else {
    //   echo '<ul class="navbar-nav mx-auto col-md-1 col-sm-1 col-xs-0 mobile-hide">
    //   <li class="nav-item dropdown">
    //     <button class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn" data-toggle="modal" data-target="#dropDownModel">
    //       <i class="fas fa-user-circle"></i>
    //     </button>
    //     <ul class="dropdown-menu dropdown-menu_mid2" aria-labelledby="navbarDropdownMenuLink">
    //       <li><p>__________________________</p></li>
    //       <li data-toggle="modal" data-target="#signUpModel">
    //         <a class="dropdown-item" href="#"><i class="fas fa-user-graduate"></i> Sign Up</a>
    //       </li>
    //       <li data-toggle="modal" data-target="#signInModel">
    //         <a class="dropdown-item" href="#"><i class="fas fa-sign-in-alt"></i> Sign In</a>
    //       </li>
    //       <li data-toggle="modal" data-target="#signInModel">
    //       <a href="'.$google_client->createAuthUrl().'" class="dropdown-item"><i class="fab fa-google"></i> Google Auth</a>
    //       </li>
    //       <li><p>__________________________</p></li>
    //     </ul>
    //   </li>
    // </ul>';
    // }
    ?>
    <!--div class="col-md-1 col-sm-1 col-xs-2 wow animate__animated animate__fadeInUp smoothScroll">
            <button class="arrow-btn nav-arrow" onclick="darkMode()"><i class="fas fa-moon" id="moon-sun"></i></button>
        </div-->
    <div class="col-md-0 col-sm-0 col-xs-2 wow animate__animated animate__fadeInUp smoothScroll mobile-show">
      <button class="arrow-btn nav-arrow" onclick="
        if(document.getElementById('total_search_div').style.opacity == '0') {
          document.getElementById('total_search_div').style.maxHeight = '60px';
          document.getElementById('total_search_div').style.opacity = '1';
        } else {
          document.getElementById('total_search_div').style.maxHeight = '0';
          document.getElementById('total_search_div').style.opacity = '0';
        }
      "><i class="fa fa-search"></i></button>
    </div>
    <div class="col-md-0 col-sm-0 col-xs-12 wow animate_animated animate_fadeInUp smoothScroll mobile-show" style="max-height: 0; transition: all 0.4s; opacity: 0;" id="total_search_div">
      <form style="text-align: center; display: flex; justify-content: center;">
        <input class="app_text_search wow animate__animated animate__fadeInUp smoothScroll nav-search-input form-text xs-inline-input" style="width: 60%;" placeholder="Search anything">
        <button class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn" data-wow-delay="0.8s" style="margin-left: 12px; width: 40px;">
          <span></span><i class="fas fa-arrow-right"></i>
        </button>
      </form>
    </div>
    <div class="col-md-1 col-sm-1 col-xs-2 wow animate__animated animate__fadeInUp smoothScroll mobile-show">
      <?php 
        if($loggedin) {
          echo '<button class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn"><a href="/teacher/index"><i class="fas fa-user-circle"></i></a></button>';
        } else {
          echo '<button class="wow animate__animated nav-arrow animate__fadeInUp smoothScroll arrow-btn" data-toggle="modal" data-target="#dropDownModel"><i class="fas fa-user-circle"></i></button>';
        }
      ?>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="dropDownModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Welcome!</h5>
        <button type="button" class="arrow-btn" data-dismiss="modal" style="margin-top:-24px !important; float:right;">&#10006;</button>
      </div>
      <div class="modal-body">
        <div class="model-google">
          <!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" data-width="300" data-height="48" data-longtitle="true"></div> -->
          <a href="">google sign in testing</a>
        </div><br>
        <div class="forms model-email">
          <button class="arrow-btn" style="margin-top:0 !important;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#signUpModel">Sign Up</button>
          <button class="arrow-btn" style="margin-top:0 !important;" type="button" data-dismiss="modal" data-toggle="modal" data-target="#signInModel">Sign In</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="cataModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size:1.8rem; font-weight:bold;">All Categories</h5>
        <button type="button" class="arrow-btn" data-dismiss="modal" style="margin-top:-24px !important; float:right;">&#10006;</button>
      </div>
      <div class="modal-body">
     <?php
     $i = 1;
       if($_GET['type'] == "certification") {
       $type = "Certification";
       $sql2 = "SELECT DISTINCT cataIs FROM apnaCourses WHERE typeIs = ?;";
       $stmt2 = $con->stmt_init();
       $stmt2->prepare($sql2);
       $stmt2->bind_param("s", $type);
       } elseif($_GET['type'] == "professional") {
       $type = "Professional";
       $sql2 = "SELECT DISTINCT cataIs FROM apnaCourses WHERE typeIs = ?;";
       $stmt2 = $con->stmt_init();
       $stmt2->prepare($sql2);
       $stmt2->bind_param("s", $type);
       } else {
       $sql2 = "SELECT DISTINCT cataIs FROM apnaCourses;";
       $stmt2 = $con->stmt_init();
       $stmt2->prepare($sql2);
       }
       $stmt2->execute();
       $stmt2->store_result();
       $stmt2->bind_result($cata);
       while($stmt2->fetch()) {
       		if($i%6 == 1) {
       			echo '<div class="section_one">
       				<ol>
       					<li>
       						<a href="/search?query='.$cata.'" class="a-white" style="text-decoration: none;">'.substr($cata,0,18).'</a>
       					</li>';
       		}
       		elseif($i%6 == 0) {
       			echo '<li>
       					<a href="/search?query='.$cata.'" class="a-white" style="text-decoration: none;">'.substr($cata,0,18).'</a>
       				</li>
       				</ol>
       				</div>';
       		} else {
       			echo '<li>
       					<a href="/search?query='.$cata.'" class="a-white" style="text-decoration: none;">'.substr($cata,0,18).'</a>
       				</li>';
       		}
       		$i++;
       }
       ?>
      </ol>
      </div>
      
      </div>
    
    </div>
  </div>
<!--SignUp Model-->
<div class="modal" tabindex="-1" role="dialog" id="signUpModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Sign Up</h5>
        <button type="button" class="arrow-btn" data-dismiss="modal" style="margin-top:-24px !important; float:right;">&#10006;</button>
      </div>
      <div class="modal-body">
        <form action="/admin/submit.php" method="post" class="forms model-signup">
          <input type="hidden" name="from" value="signup">
          <label for="type">Select signup type</label>
          <select class="form-text" name="type" required="" id="type">
            <option value="student">Register as Learner</option>
            <option value="mentor">Register as Mentor/Teacher</option>
          </select>
          <label for="name">Name</label>
          <input type="text" placeholder="Enter your name" name="name" class="form-text" required="" id="name">
          <label for="tel">Phone number</label>
          <input type="number" placeholder="Enter Phone Number" name="phone" class="form-text" required="" id="tel" min="1000000000" max="9999999999">
          <label for="dob">Date of birth</label>
          <input type="date" placeholder="Enter Dob" name="dob" class="form-text" required="" id="dob">
          <label for="email">Email</label>
          <input type="email" placeholder="Enter Email id" name="email" class="form-text" required="" id="emaill">
          <label for="pass">Password</label>
          <input type="password" placeholder="Enter Password" name="pass" class="form-text" required="" id="passs">
          <input class="arrow-btn" value="Sign Up" style="float:right;" type="submit">
        </form>
      </div>
    </div>
  </div>
</div>
<!--End SignIn Model-->
<div class="modal" tabindex="-1" role="dialog" id="signInModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Sign IN</h5>
        <button type="button" class="arrow-btn" data-dismiss="modal" style="margin-top:-24px !important; float:right;">&#10006;</button>
      </div>
      <div class="modal-body">

        <form action="/admin/submit.php" method="post" class="forms model-signin">
          <div class="row signin-form">
            <div class="col-12 signin-form-group">
              <label class="radio-inline">
                <input type="radio" name="designation" value="student" checked="true">Student
              </label>
              <label class="radio-inline signin-form-group">
                <input type="radio" name="designation" value="teacher">Teacher
              </label>
            </div>
            <input type="hidden" name="from" value="signin">
            <div class="col-12 signin-form-group">
              <label for="email">Email</label>
              <input type="email" placeholder="Enter Email id" name="email" class="form-text" required="" id="email">

            </div>
            <div class="col-12 signin-form-group">

              <label for="pass">Password</label>
              <input type="password" placeholder="Enter Password" name="pass" class="form-text" required="" id="pass">
            </div>
            <div class="col-12">
              <input class="arrow-btn" value="Sign In" style="float:right;" type="submit">
            </div>
            <!-- Below button is used to signin with google -->
           
          </div>
        </form>
        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotmodal" class="forget-password">Forgot your password</a>
      </div>
    </div>
  </div>
</div>
<!--End SignUp Model-->
<!-- Forgot password modal -->
<div class="modal" tabindex="-1" role="dialog" id="forgotmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset your password</h5>
      </div>
      <div class="modal-body">
        <form action="forgot.php" method="post" class="forms model-signin">
          <input type="hidden" name="from" value="signin">
          <label for="email">Email</label>
          <input type="email" placeholder="Enter Email id" name="email" class="form-text" required="">
          <input class="arrow-btn" value="Reset your password" style="float:right;" type="submit" placeholder="reset">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Forgot password modal ends here -->
<!--Bigh Logo Model-->
<div class="modal" tabindex="-1" role="dialog" id="myLogoModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Welcome To Apna Sikshalaya!</h5>
        <button type="button" class="arrow-btn" data-dismiss="modal" style="margin-top:-24px !important; float:right;">&#10006;</button>
      </div>
      <div class="modal-body">
        <img src="../images/logo.png" id="apna--big__logo" class="model-logo" draggable="false" data-toggle="modal" data-target="#myLogoModel">
        <a href="/" style="text-decoration:none;">
          <div class="arrow-btn">Back To Home</div>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- loader -->
<div id="ftco-loader" class="show fullscreen" style="text-align: center;">
  <img draggable="false" class="loadinggif" src="../images/loading.gif">
  <img draggable="false" class="loadingimg" src='../images/logo.png'>
  <!--p>Be your own label</p-->
</div>
<!--End Of Logo Showing-->
<script>
  function onSignIn(googleUser) {
    // Useful data for your client-side scripts:
    var profile = googleUser.getBasicProfile();
    console.log("ID: " + profile.getId());
    console.log("Full Name: " + profile.getName());
    console.log("Given Name: " + profile.getGivenName());
    console.log("Family Name: " + profile.getFamilyName());
    console.log("Image URL: " + profile.getImageUrl());
    console.log("Email: " + profile.getEmail());
    // The ID token you need to pass to your backend:
    var id_token = googleUser.getAuthResponse().id_token;
    console.log("ID Token: " + id_token);
  }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
  var ph = ["Search for just anything", "Search your fav topic", "Search your fav teacher", "Search for knowledge", "Search your interest", "Search for just anything", "Search your fav topic", "Search your fav teacher", "Search for knowledge", "Search your interest"],
    searchBar = $(".app_text_search"),
    phCount = 0;

  function randDelay(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
  }

  function printLetter(string, el) {
    var arr = string.split(""),
      input = el,
      origString = string,
      curPlace = $(input).attr("placeholder"),
      placeholder = curPlace + arr[phCount];
    setTimeout(function() {
      $(input).attr("placeholder", placeholder);
      phCount++;
      if (phCount < arr.length) {
        printLetter(origString, input);
      }
    }, randDelay(50, 90));
  }

  function placeholder() {
    Math.random();
    var i = Math.floor(Math.random() * 10);
    $(searchBar).attr("placeholder", "");
    printLetter(ph[i], searchBar);
  }
  placeholder();
  window.setInterval(function() {
    phCount = 0;
    placeholder();
  }, 4000);
</script>
</body>
</html>