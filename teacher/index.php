<?php
include_once '../sn/con.php';
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
  $_SESSION['user'] = $email;
  $_SESSION['pass'] = $password;
  $_SESSION['Role'] = "teacher";
  echo "session set";
} else {
  header("Location: /index.php?from=signinteacher&error=googleidusernotfound");
  exit();
 }
} else {
$sql = "SELECT * FROM apnaTeachers WHERE emailIs = ? && passIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows()==1){
  if(isset($_SESSION['verifyrowid'])){
    $visitorrowid = $_SESSION['verifyrowid'];
    $desig = "teacher";
    $sql = "UPDATE visitorsIs SET desigIs = '$desig' AND emailIs = ' $email' WHERE id = '$visitorrowid';";
    mysqli_query($con,$sql);
  }
  $stmt->bind_result($id, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
	$stmt->fetch();
  $view = "show";
  
} else {
 header('Location: /index.php?from=signinteacher&error=usernotfoundnormal');
 exit();
}
}
if($view == "show"){
  echo '<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Teacher Name | Apna Sikshalaya</title>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Boostrap Core CSS-->        
        <!-- Animate CSS -->
        <link href="css/animate.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Qwigley" />
        <!-- Font awesome -->
        <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/footer.css">
   </head>';
  include_once './header.php';
  echo'
  <link rel="stylesheet" href="css/bootstrap.min.css"> 
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="../css/footerstyle.css">
  <style>
    hr {margin: 0 !important;}
  </style>
   <body>
   
   <!-- Start wrapper -->
   <div class="wrapper">
     <div class="col-md-12">
         <div class="anav-title wow fadeIn" data-wow-delay="0.1s">'.$name.'</div>
           <div class="anav-title2"> - '.$name.' -  </div>

            <div class="anav-div">
                <ul class="anav-ul">
                    <li class="active">
                        <a draggable="false" href="index.php">Home</a>
                    </li>
                
                    <li>
                      <a draggable="false" href="courses.php">Courses</a>
                    </li>
                    <li>
                      <a draggable="false" href="tuitions.php">Tuitions</a>
                    </li>
                    <li>
                      <a draggable="false"  href="resume.php">Resume</a>
                    </li>
                    <li>
                      <a draggable="false" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /navbar-collapse -->
         <!-- End nav -->

         <!-- Start main image and the text below -->
         <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s">
              <img draggable="false" src="img/main-banner.jpg" alt="img" class="resp main-image"/>
                  <h1>Graphics design</h1>
                  <div class="hr"></div>
                  <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  </h2>
                  <div class="text-center">
                     <a draggable="false" href="courses.php" class="arrow-btn" style="color: #fff; text-decoration: none;">View courses</a>
                  </div>  
          </div>
          <!-- End main image and the text below -->

          <!-- Start left column -->
          <div class="box-home col-md-6">
               <h3>
               <span class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent sagittis libero et aliquam volutpat. 
               <a draggable="false" href="career.php">more career info <i class="fa fa-angle-right"></i></a>
               </span>
               </h3>
          </div>
          <!-- End left column -->
             
          <!-- Start right image -->
          <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
             <div class="first">
             <div class="square wow fadeInDown" data-wow-delay=".5s"></div>
             </div>
             <img draggable="false" src="img/photo.jpg" alt="img" class="photo-home"/> 
          </div>
          <!-- End right image -->
   
      </div>
      <!-- End col-md-12 -->
      <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s">
      <form action="#" method="POST" class="feed-back-from">
             <input type="hidden" name="action" value="upload">
             <h1 class="feed-back-label">Write a review</h1>
             <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  </h2>
              <textarea id="feedBack" name="feed-back" placeholder="Write Something" rows="3" cols="33" class="form-area"></textarea>
              <button class="arrow-btn" style="width:100%">Submit</button>
          </form>
</div>
   </div>
   <!-- End wrapper -->
      ';  include_once '../footer.php'; 
      echo'
   <!-- jQuery Version 1.11.0 -->
   <script src="js/jquery-1.11.0.js"></script>
   <!-- Boostrap JS -->
   <script src="js/bootstrap.min.js"></script>
   <!-- Smooth scroll JS -->
   <script src="js/smoothscroll.js"></script>
   
   <!-- Wow JavaScript -->
   <script src="js/wow.js"></script>
    
   <script>
   new WOW().init();
   </script>


</body>
</html>';
}