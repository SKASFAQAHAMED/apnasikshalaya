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
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
  
    <title>All Courses | Apna Sikshalaya</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/all_courses.css">
  <!-- Owl carousel -->
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <style>
    	.owl-dots {display: none;}
    	.owl-nav {display: flex; justify-content: space-between;}
    	.owl-prev, .owl-next {font-size: 4rem !important; position: absolute; top: 48%;}
    	.owl-prev {left: 0;}
    	.owl-next {right: 3%;}
    	.a-white {color: #000; transition: all 0.4s;}
    	.a-white:hover {color: #fff; transition: all 0.4s;}
    </style>
  </head>
<?php include_once 'header.php'; ?>
  <body>
    <div class="wrapper">
 

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
   
        <div class="banner-item-01">
          <div class="text-content">
            <div class="wrapper1">
              <h1>
              <?php if($_GET['type'] == "certification") {
                echo 'Explore certification courses';
              } elseif($_GET['type'] == "professional") {
                echo 'Explore professional courses';
              } else {
                echo 'Explore all courses';
              } ?>
              </h1>
              <h6>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</h6>
              </div>
          </div>
        </div>
    </div>
    <div class="mobile--text__div">
    <h1>
              <?php if($_GET['type'] == "certification") {
                echo 'Explore certification courses';
              } elseif($_GET['type'] == "professional") {
                echo 'Explore professional courses';
              } else {
                echo 'Explore all courses';
              } ?>
              </h1>
              <h6>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</h6>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      
      <div class="section-heading">
              <h2>Latest Courses</h2>
            </div>
       
            <div class="swiper mySwiper">
               <div class="swiper-wrapper">
        <?php
        $show = "show";
        if($_GET['type'] == "certification") {
        $type = "Certification";
        $sql = "SELECT * FROM apnaCourses WHERE extra = ? && typeIs = ? ORDER BY dateTime DESC LIMIT 6;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ss", $show, $type);
        } elseif($_GET['type'] == "professional") {
        $type = "Professional";
        $sql = "SELECT * FROM apnaCourses WHERE extra = ? && typeIs = ? ORDER BY dateTime DESC LIMIT 6;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ss", $show, $type);
        } else {
        $sql = "SELECT * FROM apnaCourses WHERE extra = ? ORDER BY dateTime DESC LIMIT 6;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $show);
        }
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $title, $cata, $subCata, $type, $sDesc, $teacher, $lang, $price, $lDesc, $preview, $hour, $chapter, $certificate, $bestFor, $thumb, $ip, $dateTime, $extra);
        while($stmt->fetch()) {
          echo '
            <div class="swiper-slide product-item1">
              <a href="/course_preview?id='.$id.'">';
              if($thumb != null) {
              	echo '<img src="./admin/coursethumb/'.$thumb.'" alt="">';
              } else {
	              echo '<img src="./admin/coursethumb/coursethumb113.png" alt="">';
	     }
              echo '</a>
              <div class="down-content">
                <a href="/course_preview?id='.$id.'"><h4>'.substr($title, 0, 15).'...</h4></a>
                <h6>&#8377;'.$price.'</h6>
                <p>'.$sDesc.'
               <br>
               <a href="/search?query='.$cata.'">'.substr($cata,0,12).'</a> > <a href="/search?query='.$subCata.'">'.substr($subCata,0,12).'</a>
               <br>
               Best for: '.$bestFor.'</p>
                <!--ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span-->
                
              </div>
            </div>
        
          ';
          }
          ?>
        </div>

        
        <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>




        </div>
      
    </div>

    
 <!-- Course Types -->


       <h3 class="heading-inner">About Courses</h3>
          <div class="hr"></div>
           <div class="heading-c">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at,
               maximus ut leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Lorem ipsum dolor sit amet,
               consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at</p></div>
    
     <!-- End text -->
 

    <div class="course-types">
     <div>
       <ul class="course-serious">
       <?php
       if($_GET['type'] == "certification") {
       $type = "Certification";
       $sql2 = "SELECT cataIs FROM apnaCourses WHERE typeIs = ? ORDER BY titleIs LIMIT 6;";
       $stmt2 = $con->stmt_init();
       $stmt2->prepare($sql2);
       $stmt2->bind_param("s", $type);
       } elseif($_GET['type'] == "professional") {
       $type = "Professional";
       $sql2 = "SELECT cataIs FROM apnaCourses WHERE typeIs = ? ORDER BY titleIs LIMIT 6;";
       $stmt2 = $con->stmt_init();
       $stmt2->prepare($sql2);
       $stmt2->bind_param("s", $type);
       } else {
       $sql2 = "SELECT cataIs FROM apnaCourses ORDER BY titleIs LIMIT 6;";
       $stmt2 = $con->stmt_init();
       $stmt2->prepare($sql2);
       }
       $stmt2->execute();
       $stmt2->store_result();
       $stmt2->bind_result($cata);
       while($stmt2->fetch()) {
       		echo '<a href="/search?query='.$cata.'" class="a-white" style="text-decoration: none;"><li>'.substr($cata,0,18).'</li></a>';
       }
       ?>
       <li data-dismiss="modal" data-toggle="modal" data-target="#allTypeModel">See More</li>
       </ul>
     </div>
     <div>
     
    </div>
    </div>
<!--All Type Model-->
<div class="modal" tabindex="-1" role="dialog" id="allTypeModel">
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

<!--End SignUp Model-->
     <!--  Top categories Here -->
     <div class="latest-products">

        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2 style="font-weight: bold; color: #3a3937;">Top categories</h2>
            </div>
          </div>
          <div class="col-md-4">
            <a draggable="false" href="/search?query=Spoken English">
            <div class="product-item">
              <img draggable="false" src="assets/images/product_01.jpg" alt="">
              <div class="down-content">
               <h4>Spoken English</h4>
               <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-4">
          <a draggable="false" href="/search?query=Foreign Language">
            <div class="product-item">
              <img draggable="false" src="assets/images/product_02.jpg" alt="">
              <div class="down-content">
                <h4>Foreign Language</h4>
                <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-4">
          <a draggable="false" href="/search?query=IT">
            <div class="product-item">
              <img draggable="false" src="assets/images/product_03.jpg" alt="">
              <div class="down-content">
                <h4>IT</h4>
                <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-4">
          <a draggable="false" href="/search?query=Physics">
            <div class="product-item">
              <img draggable="false" src="assets/images/product_04.jpg" alt="">
              <div class="down-content">
                <h4>Physics</h4>
                <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-4">
          <a draggable="false" href="/search?query=Law">
            <div class="product-item">
              <img draggable="false" src="assets/images/product_05.jpg" alt="">
              <div class="down-content">
                <h4>Law</h4>
                <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-4">
          <a data-dismiss="modal" data-toggle="modal" data-target="#allTypeModel">
            <div class="product-item">
              <img draggable="false" src="assets/images/see_more.jpg" alt="">
              <div class="down-content">
                <h4>SEE MORE</h4>
                <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
            </div>
            </a>
          </div>
        </div>
     
    </div>
<!-- END-->

<!--BEST teacher-->
<div class="brand wow fadeIn" data-wow-delay="0.1s" > Today's Best Teacher</div>
<div class="row">
 

    <div class="col-md-7">
       <div class="first-s">
        <div class="square wow fadeInDown" data-wow-delay=".5s"></div>
       </div>
       <img draggable="false" src="assets/images/services3.jpg" alt="photo" class="photo-services" style="border-radius: 10px;"/>
     </div>
     <div class="col-md-5 course-privew">
       <button class="arrow-btn btn heading-services" type="submit">Courses</button>
       <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
     </div>
    </div>



  
     <!-- Banner Ends Here -->

    <div class="latest-products">
     
      <div class="section-heading">
              <h2 style="font-weight: bold; color: #3a3937;">Students are viewing</h2>
            </div>
            <div class="swiper mySwiper">
               <div class="swiper-wrapper">
          <?php
        $show = "show";
        if($_GET['type'] == "certification") {
        $type = "Certification";
        $sql = "SELECT * FROM apnaCourses WHERE extra = ? && typeIs = ? ORDER BY sDescIs LIMIT 6;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ss", $show, $type);
        } elseif($_GET['type'] == "professional") {
        $type = "Professional";
        $sql = "SELECT * FROM apnaCourses WHERE extra = ? && typeIs = ? ORDER BY sDescIs LIMIT 6;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ss", $show, $type);
        } else {
        $sql = "SELECT * FROM apnaCourses WHERE extra = ? ORDER BY sDescIs LIMIT 6;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $show);
        }
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $title, $cata, $subCata, $type, $sDesc, $teacher, $lang, $price, $lDesc, $preview, $hour, $chapter, $certificate, $bestFor, $thumb, $ip, $dateTime, $extra);
        while($stmt->fetch()) {
          echo '
            <div class="swiper-slide product-item1">
              <a href="/course_preview?id='.$id.'">';
              if($thumb != null) {
              	echo '<img src="./admin/coursethumb/'.$thumb.'" alt="">';
              } else {
	              echo '<img src="./admin/coursethumb/coursethumb113.png" alt="">';
	     }
              echo '</a>
              <div class="down-content">
                <a href="/course_preview?id='.$id.'"><h4>'.substr($title, 0, 15).'...</h4></a>
                <h6>&#8377;'.$price.'</h6>
                <p>'.$sDesc.'
               <br>
               <a href="/search?query='.$cata.'">'.substr($cata,0,12).'</a> > <a href="/search?query='.$subCata.'">'.substr($subCata,0,12).'</a>
               <br>
               Best for: '.$bestFor.'</p>
                <!--ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span-->
              </div>
            </div>';
          }
          ?>
        </div>

 
        <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>


      </div>
    
<!--BEST COURSE-->

<div class="call-to-action">

    <div class="row">
      <div class="col-md-12">
        <div class="inner-content">
          <div class="row">
            <div class="col-md-8">
              <h4>That's all we have</h4>
              <p>Still not fond your favorite course?</p>
            </div>
            <div class="col-md-4">
             <a href="/contact_us.php"> <button type="btn" class="arrow-btn" style="width: 50%; margin-top: 20px;">Contact us</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
 
</div>





</div>
</div>
<!-- Jquery Library file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- --------- Owl-Carousel js ------------------->
<script src="./js/owl.carousel.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
  </body>
</html>
<?php include_once 'footer.php'; ?>
