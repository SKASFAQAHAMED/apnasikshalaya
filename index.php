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
include_once('./sn/con.php');
if (isset($_GET['from'])) {
    $from = mysqli_real_escape_string($con, htmlspecialchars($_GET['from'], ENT_QUOTES));
} else {
    $from = null;
}
if (isset($_GET['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
} else {
    $action = null;
}
if (isset($_GET['status'])) {
    $status = mysqli_real_escape_string($con, htmlspecialchars($_GET['status'], ENT_QUOTES));
} else {
    $status = null;
}
$one = 1;
$sql = "SELECT * FROM apnaHomepage";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $topHeading, $topImage, $midHeading, $midContent, $midImage, $card1, $card1content, $card2, $card2content, $card3, $card3content, $card4, $card4content, $card5, $card5content, $card6, $card6content, $card7, $card7content, $teacher1, $teacher2, $teacher3, $teacher4, $courseHeading, $courseContent, $course1, $course2, $course3, $course4, $extra);
$stmt->fetch();
$sql2 = "SELECT popupContent, popupImg, popupTime FROM apna_popups WHERE id = ?;";
$stmt2 = $con->stmt_init();
$stmt2->prepare($sql2);
$stmt2->bind_param("i", $one);
$stmt2->execute();
$stmt2->store_result();
$stmt2->bind_result($popupContent, $popupImg, $popupTime);
$stmt2->fetch();
echo '<!DOCTYPE html>
<html lang="en">
<head>
<title>Apna Sikshalaya || Learning with Creativity</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/animation.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/popup.css">
<style>
	.body {background-color: #fff; transition: all 0.6s;}
	.body-dark {background-color: #303030; transition: all 0.6s;}
	.swiper-cube .swiper-slide {border-radius: 12px; overflow: hidden;}
	.arrow-btn, .arrow-btn:hover {text-decoration: none;}
	.swiper-slide-shadow-right, .swiper-slide-shadow-left {border-radius: 12px; overflow: hidden;}
	.alert {background: #000; padding: 9px; font-size: 2rem; font-weight: 900; color: #fff; width: 60%; margin: auto;}
</style>
</head>';
include_once 'header.php';
echo '<body style="overflow-x: hidden; padding-right: 0 !important;" id="body" class="body">
<div class="popup">
<div class="popup-overlay"></div>
<div class="main-popup">
  <div class="popup-content">
    <div class="top1">
      <img class="iconi" draggable="false" src="./admin/popups/' . $popupImg . '">
      <button class="arrow-btn close-btn" style="padding: 6px;"><span style="font-weight: 600; color: #fff;">&#10060;</span></button>
    </div>
    <div class="middle">
      <p>' . $popupContent . '</p>
    </div>
 
  </div>
</div>
</div>
<div class="container-fluid">
     <div class="row">
          <section id="home" class="parallax-section" style="background-image:url(\'./admin/homepageimgs/' . $topImage . '\')">
               <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="home-wrapper" id="home-wrapper">
                         <h3 class="wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">APNA SIKSHALAYA</h3>
                         <img src="images/lines.svg" class="wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                         <h1 class="wow animate__animated animate__fadeInUp" data-wow-delay="0.6s">' . $topHeading . '</h1>';
if ($from == "newsletter") {
    if ($status == "success") {
        echo '<div class="alert alert-success" role="alert">Thank you for the subscription.</div>';
    } elseif ($status == "emailerror") {
        echo '<div class="alert alert-primary" role="alert">You are already subscribed.</div>';
    } else {
        echo '<div class="alert alert-error" role="alert">Please try again.</div>';
    }
} elseif ($from == "signin") {
    if ($status == "error") {
        echo '<div class="alert alert-error" role="alert">Invalid credentials.</div>';
    }
} elseif ($from == "signup") {
    if ($status == "error") {
        echo '<div class="alert alert-error" role="alert">Email exists. Please signin.</div>';
    } elseif ($status == "teacher") {
        echo '<div class="alert alert-success" role="alert">Thank you for signing in. Our team will contact you soon.</div>';
    } elseif ($status == "notfound") {
        echo '<div class="alert alert-error" role="alert">Unknown error occured.</div>';
    } elseif ($status == "emailerror") {
        echo '<div class="alert alert-error" role="alert">Email exists. Please signin.</div>';
    }
} elseif ($from == "email") {
    if ($status == "error") {
        echo '<div class="alert alert-error" role="alert">No email found. Please try again.</div>';
    }
}
echo '<!--button class="wow animate__animated animate__fadeInUp smoothScroll arrow-btn" data-toggle="modal" data-target="#studentFormModel" data-wow-delay="0.8s">Student Reg
                         </button>
                        <button class="wow animate__animated animate__fadeInUp smoothScroll arrow-btn" data-toggle="modal" data-target="#teacherFormModel" data-wow-delay="0.8s">Teacher Reg
                         </button>
                         <button class="wow animate__animated animate__fadeInUp smoothScroll arrow-btn" data-toggle="modal" data-target="#instituteFormModel" data-wow-delay="0.8s">Institute Reg
                         </button-->
                    </div>
               </div>
          </section>
     </div>
</div>
<section id="about" class="parallax-section">
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-4 col-sm-8">
                    <img draggable="false" src="./admin/homepageimgs/' . $midImage . '" class="wow animate__animated animate__fadeInUp img-responsive" data-wow-delay="0.2s" alt="about image">
               </div>
               <div class="col-md-8 col-sm-12">
                    <div class="about-thumb">
                         <div class="wow animate__animated animate__fadeInUp section-title" data-wow-delay="0.6s">
                              <h3>Why us?</h3>
                              <h2>' . $midHeading . '</h2>
                         </div>
                         <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0.8s">
                              <p>' . $midContent . '</p>
                         </div>
                         <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                         
                         <h4 style="display: inline; padding-right:20px;">Want to know more about us?</h4> <a draggable="false" href="/ars_about"> <button style="margin:0 margin-top:20px;" class="arrow-btn">About us <i class="fa fa-angle-double-right"></i></button></a>
                    </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<section id="courses" class="parallax-section">
     <div class="container-fluid">
         <div class="row">
                <figure class="col-md-4 col-sm-6 col-xs-6 effect-julia left-top-border-radius right-top-border-radius1">
                    <a draggable="false" href="/all_courses?type=certification">
                        <img src="images/new/courses.jpg" alt="img21"/>
                        <figcaption>
                            <div style="position: absolute; top: 10px;">
                                <p class="poppins">' . $card1 . '</p>
                                <p>' . $card1content . '</p>
                            </div>
                        </figcaption>  
                    </a>        
                </figure>
                <figure class="col-md-4 col-sm-6 col-xs-6 effect-julia right-top-border-radius2">
                    <a draggable="false" href="/all_courses?type=professional">
                        <img src="images/new/pcourses.jpg" alt="img21"/>
                        <figcaption>
                            <div style="position: absolute; top: 10px;">
                                <p class="poppins">' . $card2 . '</p>
                                <p>' . $card2content . '</p>
                            </div>
                        </figcaption>  
                    </a>        
                </figure>
                <figure class="col-md-4 col-sm-12 col-xs-12 effect-julia right-top-border-radius">
                    <a draggable="false" href="/tuition_index">
                        <img src="images/new/tution.jpg" alt="img21" class="sm-width-100"/>
                        <figcaption>
                            <div style="position: absolute; top: 10px; width: 320px;">
                                <p class="poppins">' . $card3 . '</p>
                                <p>' . $card3content . '</p>
                            </div>
                        </figcaption>  
                    </a>        
                </figure>
                <figure class="col-md-3 col-sm-6 col-xs-6 effect-julia left-bottom-border-radius">
                    <a draggable="false" href="/page_not_found">
                        <img src="images/new/consultancy.jpg" alt="img"/>
                        <figcaption>
                            <div style="position: absolute; top: 10px;">
                                <p class="poppins">' . $card4 . '</p>
                                <p>' . $card4content . '</p>
                            </div>
                        </figcaption>  
                    </a>        
                </figure>
                <figure class="col-md-3 col-sm-6 col-xs-6 effect-julia">
                    <a draggable="false" href="/blogger">
                        <img src="images/new/blogs.jpg" alt="img"/>
                        <figcaption>
                            <div style="position: absolute; top: 10px;">
                                <p class="poppins">' . $card5 . '</p>
                                <p>' . $card5content . '</p>
                            </div>
                        </figcaption>  
                    </a>        
                </figure>
                <figure class="col-md-3 col-sm-6 col-xs-6 effect-julia left-bottom-border-radius2">
                    <a draggable="false" href="/live_events">
                        <img src="images/new/live events.jpg" alt="imgg"/>
                        <figcaption>
                            <div style="position: absolute; top: 10px;">
                                <p class="poppins">' . $card6 . '</p>
                                <p>' . $card6content . '</p>
                            </div>
                        </figcaption>  
                    </a>        
                </figure>
                <figure class="col-md-3 col-sm-6 col-xs-6 effect-julia right-bottom-border-radius">
                    <a href="/contact_us" draggable="false">
                        <img  src="images/new/contact.jpg" alt="img21"/>
                        <figcaption>
                            <div style="position: absolute; top: 10px;">
                                <p class="poppins">' . $card7 . '</p>
                                <p>' . $card7content . '</p>
                            </div>
                        </figcaption>  
                        </a>
                </figure>
         </div>
     </div>
</section>
<section id="work" class="parallax-section">
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-12 col-sm-12">
                    <!-- SECTION TITLE -->
                    <div class="wow animate__animated animate__fadeInUp section-title" data-wow-delay="0.2s">
                         <h2>OUR MENTORS</h2>
                         <p> </p>
                    </div>
               </div>
               <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.4s">
                    <!-- WORK THUMB -->
                    <a href="/teacher" style="text-decoration:none;">
                    <div class="work-thumb">
                              <img draggable="false" src="images/new/teacher3.png" class="img-responsive"  alt="Fine Arts">
                    </div>
                    <h4>' . $teacher1 . '</h4>
                    </a>
               </div>
               <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.6s">
                    <!-- WORK THUMB -->
                    <a href="/teacher" style="text-decoration:none;">
                    <div class="work-thumb">
                              <img src="images/new/teacher3.png" class="img-responsive" draggable="false" alt="Logo Design">                       
                    </div>
                    <h4>' . $teacher2 . '</h4></a>
               </div>
               <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.8s">
                    <!-- WORK THUMB -->
                    <a href="/teacher" style="text-decoration:none;">
                    <div class="work-thumb">
                              <img src="images/new/teacher3.png" class="img-responsive" draggable="false" alt="Photography">
                    </div>
                    <h4>' . $teacher3 . '</h4> </a>
               </div>
               <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.8s">
                    <!-- WORK THUMB -->
                    <a href="/teacher" style="text-decoration:none;">
                    <div class="work-thumb">
                         <a href="images/new/teacher1.png" class="image-popup">
                              <img src="images/new/teacher4.png" class="img-responsive" draggable="false" alt="Photography">
                         
                    </div>
                    <h4>' . $teacher4 . '</h4></a>
               </div>
          </div>
     </div>
</section>
<section id="count">
     <div class="container-fluid">
 
          <div class="row wow animate__animated animate__fadeInUp" data-wow-delay="0.8s">
               <div class="col-md-3 col-sm-3 col-xs-6">
                    <h1>450+</h1>
                    <p>Students Enrolled</p>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                    <h1>50+</h1>
                    <p>Teachers Onboard</p>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                    <h1>2</h1>
                    <p>Institutes Connected</p>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
               <a draggable="false" href="./growth.php" disabled> <button class="arrow-btn" style="line-height: 1.5;" disabled >
                             Our growth <i class="fa fa-angle-double-right"></i>
                    </button></a>
               </div>
          
         </div>
     </div>
</section>
<section id="classes">
    <div class="container-fluid">
        <div class="row wow animate__animated animate__fadeInUp" data-wow-delay="0.8s">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h1 class="a-plus">A+</h1>
                <h3>' . $courseHeading . '</h3>
                <p>' . $courseContent . '</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12" >
                <div class="swiper-container coursesSwiper" style="">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"> <a href="course_preview">
                          <img src="images/course1.png" /></a>
                        </div>
                    <div class="swiper-slide"> <a href="course_preview">
                      <img src="images/course2.png" /></a>
                    </div>
                    <div class="swiper-slide"> <a href="course_preview">
                      <img src="images/course3.png" /></a>
                    </div>
                    <div class="swiper-slide"> <a href="course_preview">
                      <img src="images/course4.png" /></a>
                    </div></a>
                </div>
                <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="wow animate__animated animate__fadeInUp section-title" data-wow-delay="0.2s" style="overflow: hidden;">
                <h2>HAPPY PARENTS AND STUDENTS</h2>
                <p>Proin efficitur, tortor et fringilla finibus, felis enim euismod eros, vitae pharetra nisi nibh eu urna. Ut vitae lectus magna. Duis rutrum neque non finibus aliquam. Aenean lacinia ante sit amet dignissim vestibulum. Vestibulum ut libero lacinia magna congue mattis. Maecenas non ultrices nibh.</p>
               
                <div class="col-md-6 testimonial1">
            <div class="test_profile">
                <div class="test_block box_sha" id="test_block1" onclick="this.classList.add(\'box_sha\'); document.getElementById(\'test_block2\').classList.remove(\'box_sha\'); document.getElementById(\'test_block3\').classList.remove(\'box_sha\'); document.getElementById(\'t_desc1\').style.display=\'block\'; document.getElementById(\'t_desc2\').style.display=\'none\';  document.getElementById(\'t_desc3\').style.display=\'none\';">
                    <div class="img">
                        <img src="./img/person_1.jpg" alt="test img1" draggable="false">
                    </div>
                    <div class="name">
                        <h5>Milton Austin</h5>
                        <p>Student of cs</p>
                    </div>
                </div>
        
            <div class="test_block" id="test_block2" onclick="this.classList.add(\'box_sha\'); document.getElementById(\'test_block1\').classList.remove(\'box_sha\'); document.getElementById(\'test_block3\').classList.remove(\'box_sha\'); document.getElementById(\'t_desc2\').style.display=\'block\'; document.getElementById(\'t_desc1\').style.display=\'none\';  document.getElementById(\'t_desc3\').style.display=\'none\';">
                <div class="img">
                    <img src="./img/person_1.jpg" alt="test img2" draggable="false">
                </div>
                <div class="name">
                    <h5>John Reeves</h5>
                    <p>Teacher of Mca</p>
                </div>
            </div>
       
        <div class="test_block" id="test_block3" onclick="this.classList.add(\'box_sha\'); document.getElementById(\'test_block1\').classList.remove(\'box_sha\'); document.getElementById(\'test_block2\').classList.remove(\'box_sha\'); document.getElementById(\'t_desc3\').style.display=\'block\'; document.getElementById(\'t_desc1\').style.display=\'none\';  document.getElementById(\'t_desc2\').style.display=\'none\';">
            <div class="img">
                <img src="./img/person_1.jpg" alt="test img3" draggable="false">
            </div>
            <div class="name">
                <h5>Luke Harper</h5>
                <p>Student of cs</p>
            </div>
        </div>
        </div>
    </div>
        
         <div class="col-md-6 testimonial1">
           <div class="test_description">
               <div class="t_desc" id="t_desc1">
                   <h3>It was a great exprience!</h3>
                   <img src="./img/stars.png" alt="stars">
                   <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi quisquam dolorem a quas, recusandae maxime veritatis accusamus assumenda illo, saepe sit quo, impedit in fuga officiis veniam laboriosam perspiciatis modi! </p>
                    <p>Laboriosam iusto, ipsum blanditiis dolorem voluptatem minima. Fugit quibusdam laudantium esse cum nobis debitis facere. Odio voluptates quam eligendi ab atque maiores.</p>
               </div>
               <div class="t_desc" id="t_desc2" style="display: none;">
                <h3>It was a wow!</h3>
                <img src="./img/stars.png" alt="stars">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi quisquam dolorem a quas, recusandae maxime veritatis accusamus assumenda illo, saepe sit quo, impedit in fuga officiis veniam laboriosam perspiciatis modi! </p>
                <p>Laboriosam iusto, ipsum blanditiis dolorem voluptatem minima. Fugit quibusdam laudantium esse cum nobis debitis facere. Odio voluptates quam eligendi ab atque maiores.</p>
                </div>
            <div class="t_desc" id="t_desc3" style="display: none;">
                <h3>It just awesome!</h3>
                <img src="./img/stars.png" alt="stars">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi quisquam dolorem a quas, recusandae maxime veritatis accusamus assumenda illo, saepe sit quo, impedit in fuga officiis veniam laboriosam perspiciatis modi! </p>
                <p>Laboriosam iusto, ipsum blanditiis dolorem voluptatem minima. Fugit quibusdam laudantium esse cum nobis debitis facere. Odio voluptates quam eligendi ab atque maiores.</p>
               </div>
           </div>
         </div>

                
    </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script data-pace-options=\'{ "ajax": false }\' type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-parallax/1.1.3/jquery-parallax.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/2.0.2/js/smooth-scroll.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<!-- Counter up JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    
  
  
  
      <!-- Bootstrap JS -->
    
<script type="text/javascript">
        function darkMode() {
    var body = document.getElementById("body");
    var homewrapper = document.getElementById("home-wrapper");
    var moon = document.getElementById("moon-sun");
    var modal = document.getElementsByClassName("modal-content");
    var p = document.getElementsByTagName("p");
    if(moon.className == "fas fa-moon") {
        body.classList.remove("body");
        body.classList.add("body-dark");
        p.classList.remove("text");
        p.classList.add("text-dark");
        homewrapper.classList.add("home-wrapper-dark");
        moon.classList.remove("fa-moon");
        moon.classList.add("fa-sun");
    } else {
        body.classList.remove("body-dark");
        body.classList.add("body");
        p.classList.remove("text-dark");
        p.classList.add("text");
        homewrapper.classList.remove("home-wrapper-dark");
        moon.classList.remove("fa-sun");
        moon.classList.add("fa-moon");
    }
}
$(\'[data-toggle="counterUp"]\').counterUp({
            delay: 15,
            time: 1500
        });
const open_btn = document.querySelector(".open-btn");
const close_btn = document.querySelector(".close-btn");
const popup = document.querySelector(".popup");
const main_popup = document.querySelector(".main-popup");
setTimeout(() => {
	popup.style.display = "flex";
	main_popup.style.cssText = "animation: slide-in .5s ease; opacity: 1; transition: all 0.6s; animation-fill-mode: forwards;";
}, ' . $popupTime . ');
close_btn.addEventListener("click", () => {
	main_popup.style.cssText = "animation: slide-out .5s ease; opacity: 0; transition: all 0.6s; animation-fill-mode: forwards;";
	setTimeout(() => {
		popup.style.display = "none";
	}, 600);
});
window.addEventListener("click", (e) => {
	if (e.target == document.querySelector(".popup-overlay")) {
		main_popup.style.cssText = "animation: slide-out .5s ease; opacity: 0; transition: all 0.6s; animation-fill-mode: forwards;";
		setTimeout(() => {
			popup.style.display = "none";
		}, 600);
	}
});
 </script>
<!--Footer Start-->';
include_once './footer.php';
echo '
</body>
</html>';
