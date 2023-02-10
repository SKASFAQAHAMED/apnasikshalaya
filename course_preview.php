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

include_once'./sn/con.php';

$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));

$show = "show";

$sql = "SELECT * FROM apnaCourses WHERE id = ?;";

$stmt = $con->stmt_init();

$stmt-> prepare($sql);

$stmt-> bind_param("i",$id);

$stmt-> execute();

$stmt-> store_result();

if($stmt-> num_rows()!=0){

    $stmt-> bind_result($id, $title, $catagory, $subcata, $type, $shortdesc, $teacher, $language, $price, $longdesc, $preview, $hour, $chapter, $certi, $bestfor, $thumbnail, $ipaddress, $datetime, $extra);

    $stmt-> fetch();

    $sql2 = "SELECT DISTINCT sectionIs FROM apnaVideos WHERE courseId = ? && verifyIs = ? && extra = ?;";

    $stmt2 = $con->stmt_init();

    $stmt2->prepare($sql2);

    $stmt2->bind_param("iss", $id, $show, $show);

    $stmt2->execute();

    $stmt2->store_result();

    $noOfSection = $stmt2->num_rows();

    $sql3 = "SELECT id FROM apnaVideos WHERE courseId = ? && verifyIs = ? && extra = ?;";

    $stmt3 = $con->stmt_init();

    $stmt3->prepare($sql3);

    $stmt3->bind_param("iss", $id, $show, $show);

    $stmt3->execute();

    $stmt3->store_result();

    $noOfChapter = $stmt3->num_rows();

    echo'<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>'.$title.' Course preview</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">';



include_once "header.php";

echo '

<link rel="stylesheet" href="css/course_preview.css">';

	if($_GET['action'] == "interest") {

		if($_GET['status'] == "success") {

			echo '<div class="alert alert-success" role="alert">Your enrollment request processed successfully. Our team will contact you soon.</div>';

		}

	}

    echo '<!-- Main section of the body -->

    <div class="container-fluid">

        <div class="row section1">

            <div class="col-md-6 col-sm-6 col-lg-6">

                <h2>

                    '.$title.'

                </h2>

                <h3>'.$catagory.' &#8594; '.$subcata.'</h3>

                <p>'.$shortdesc.'

                </p>

                

                

                <button class="arrow-btn button" type="button" style="font-size: 2.4rem; padding: 6px 24px;"> Buy now <span style="font-family: \'Roboto Slab\', serif;">&#8377;'.$price.'</span></button>

            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 start-graphic">

                <img   src="/images/preview.png" draggable="false" class="teacher" alt="teacher">

                <div class="color-box"></div>



            </div>

        </div>

    </div>

    <!-- main ends here -->



    <!-- Accordian and side bar div -->

    <div class="container2">

        <div class="course">

            <h1 >Course content</h1>

            <p>'.$noOfSection.' sections • '.$noOfChapter.' lectures • '.$hour.' hours</p>

            <ul>';

            $sql4 = "SELECT DISTINCT sectionIs FROM apnaVideos WHERE courseId = ? && verifyIs = ? && extra = ?;";

            $stmt4 = $con->stmt_init();

            $stmt4->prepare($sql4);

            $stmt4->bind_param("iss", $id, $show, $show);

            $stmt4->execute();

            $stmt4->store_result();

            $stmt4->bind_result($videoSection);

            while($stmt4->fetch()) {

                echo '<li onclick="toggle(this);">

                    <input type="checkbox" checked>

                    <i class="fas fa-plus"></i>

                    <h2>SECTION: '.$videoSection.'</h2>';

                    if($loggedin) {

                        $sql = "SELECT verifyIs FROM apnaInterest WHERE courseId = ? && studentEmail = ?;";

                        $stmt = $con->stmt_init();

                        $stmt->prepare($sql);

                        $stmt->bind_param("is", $id, $user);

                        $stmt->execute();

                        $stmt->store_result();

                        if($stmt->num_rows() == 1) {

                            $stmt->bind_result($verifyCourse);

                            $stmt->fetch();

                            if($verifyCourse ==  1) {

                                $i = 1;

                    $sql5 = "SELECT id, titleIs, videoIs FROM apnaVideos WHERE sectionIs = ? && courseId = ? && verifyIs = ? && extra = ?;";

                    $stmt5 = $con->stmt_init();

                    $stmt5->prepare($sql5);

                    $stmt5->bind_param("ssss", $videoSection, $id, $show, $show);

                    $stmt5->execute();

                    $stmt5->store_result();

                    $stmt5->bind_result($vid, $vtitle, $vlink);

                    while($stmt5->fetch()) {

                echo '<a href="./admin/coursevideo/'.$vlink.'" target="_blank" style="display: block;"> &nbsp; '.$i.' &nbsp;'.$vtitle.'</a>';

                $i++;

                }

                            } else {

                                $i = 1;

                    $sql5 = "SELECT id, titleIs, videoIs FROM apnaVideos WHERE sectionIs = ? && courseId = ? && verifyIs = ? && extra = ?;";

                    $stmt5 = $con->stmt_init();

                    $stmt5->prepare($sql5);

                    $stmt5->bind_param("ssss", $videoSection, $id, $show, $show);

                    $stmt5->execute();

                    $stmt5->store_result();

                    $stmt5->bind_result($vid, $vtitle, $vlink);

                    while($stmt5->fetch()) {

                echo '<p style="display: block;"> &nbsp; '.$i.' &nbsp;'.$vtitle.'</p>';

                $i++;

                }

                            }

                        } else {

                            $i = 1;

                            $sql5 = "SELECT id, titleIs, videoIs FROM apnaVideos WHERE sectionIs = ? && courseId = ? && verifyIs = ? && extra = ?;";

                            $stmt5 = $con->stmt_init();

                            $stmt5->prepare($sql5);

                            $stmt5->bind_param("ssss", $videoSection, $id, $show, $show);

                            $stmt5->execute();

                            $stmt5->store_result();

                            $stmt5->bind_result($vid, $vtitle, $vlink);

                            while($stmt5->fetch()) {

                        echo '<p style="display: block;"> &nbsp; '.$i.' &nbsp;'.$vtitle.'</p>';

                        $i++;

                        }

                        } } else {

                            $i = 1;

                            $sql5 = "SELECT id, titleIs, videoIs FROM apnaVideos WHERE sectionIs = ? && courseId = ? && verifyIs = ? && extra = ?;";

                            $stmt5 = $con->stmt_init();

                            $stmt5->prepare($sql5);

                            $stmt5->bind_param("ssss", $videoSection, $id, $show, $show);

                            $stmt5->execute();

                            $stmt5->store_result();

                            $stmt5->bind_result($vid, $vtitle, $vlink);

                            while($stmt5->fetch()) {

                        echo '<p style="display: block;"> &nbsp; '.$i.' &nbsp;'.$vtitle.'</p>';

                        $i++;

                        }

                        }

                echo '</li>';

                }

                echo '

            </ul>

        </div>

        <div class="container1">

            <div class="card">

                <div class="card-head">';

                    if($preview != null) {

	                    echo '<iframe class="course-iframe"

                    src ="'.$preview.'" title="CriO and YouTube" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>

                    </iframe>';

                    } elseif($thumbnail != null) {

	                    echo '<img src="admin/coursethumb/'.$thumbnail.'" alt="Thumbnail" class="course-iframe">';

                    } else {

                    	echo '<img src="img/logo.png" alt="Apnasikshalaya logo" class="course-iframe">';

                    }

                    echo '<div class="product-detail">

                        '.$certi.'

                    </div>

                   

                </div>

                <div class="card-body">

                    <div class="product-desc">

                        <span class="product-title">

                           <b>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</b>

                            <span class="badge">

                               4.5<i class="fas fa-star"></i>

                            </span>

                        </span>

                        <p class="update-date">Best for: <span id="update-date">'.$bestfor.'</span></p>

                        <span class="product-caption">

                            <div id="teacher-name">

                           Created By: 

                            </div>

                           <a href="#">'.$teacher.'</a>

                        </span>

                        <p>Language: <span id="languagr">English</span></p>

                    </div>

                    <div class="product-properties">

                            <div id="product-p">

                            	&#8377; '.$price.'

                            </div>';

                            if($loggedin) {

                            	$sql = "SELECT verifyIs FROM apnaInterest WHERE courseId = ? && studentEmail = ?;";

                            	$stmt = $con->stmt_init();

                            	$stmt->prepare($sql);

                            	$stmt->bind_param("is", $id, $user);

                            	$stmt->execute();

                            	$stmt->store_result();

                            	if($stmt->num_rows() == 1) {

                            		$stmt->bind_result($verifyCourse);

                            		$stmt->fetch();

                            		if($verifyCourse ==  1) {

                            			echo '<button class="arrow-btn"><a href="all_videos?id='.$id.'">Show videos</a></button>';

                            		} else {

                            			echo '<p>Thank you for your interest.<br>Our team will contact you soon.</p>';

                            		}

                            	} else {

                            		echo '<ul class="ul-size">

                                		<!-- <button class="button btn">Buy now</button> -->

                                		<!--button class="button btn arrow-btn"><i class="fas fa-chalkboard-teacher"></i></button-->

                                		<button class="button btn arrow-btn"><a href="/admin/submit.php?from=course&action=interested&id='.$id.'&email='.$user.'">Enroll <!--i class="fas fa-cart-plus"></i--></a></button>

                                		<!--button class="button btn arrow-btn"><i class="fas fa-share-alt"></i></button-->

                            		</ul>';

                            	}

                            } else {

                            	echo '<button class="arrow-btn nav-arrow" data-toggle="modal" data-target="#dropDownModel">Sign Up  <i class="fas fa-user-graduate"></i></button>';

                            }

                     echo '</div>

</div>

</div>

        </div>

    </div>

    <!-- Accordian -->







    <!-- Review section -->

    <div class="testimonial-container">

        <h2>What our students think:</h2>

        <div class="progress-bar"></div>

        <div class="fas fa-quote-left fa-quote"></div>

        <div class="fas fa-quote-right fa-quote"></div>

        <p class="testimonial">

            I\'ve worked with literally hundreds of HTML/CSS developers and I have to

            say the top spot goes to this guy. This guy is an amazing developer. He

            stresses on good, clean code and pays heed to the details.

        </p>

        <div class="user">

            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=707b9c33066bf8808c934c8ab394dff6"

                alt="user" class="user-image" />

            <div class="user-details">

                <h4 class="username">Miyah Myles</h4>

                <p class="role">Marketing</p>

            </div>

        </div>

    </div>

    <!-- Review section ends here -->

    <script src="/js/course_preview.js"></script>

    <script>

        function toggle(e){

            if(e.childNodes[3].classList.contains("fa-plus")){

            e.childNodes[3].classList.remove("fa-plus");

            e.childNodes[3].classList.add("fa-minus");

            }else{

                e.childNodes[3].classList.remove("fa-minus");

            e.childNodes[3].classList.add("fa-plus");

            }

        };

        // this is not a bug but a feature on clicking the li the class changes and it changes the icon inside the i tag with plus and minus icon but the feature is it doesnt changes when clickd on the padding of the li

    </script>';



include_once "footer.php";



echo '

</html>';

} 

else{

echo'<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Course preview</title>';



include_once "header.php";



echo '

<link rel="stylesheet" href="css/course_preview.css">

    <!-- Main section of the body -->

    <div class="container-fluid">

        <div class="row section1">

            <div class="col-md-6 col-sm-6 col-lg-6">

                <h2>

                    Learn python in 10 mins

                </h2>

                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis, quibusdam.</h3>

                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum sapiente voluptatem delectus non

                    consectetur provident quasi vero. Sequi dolor, consequatur blanditiis itaque, perferendis quas rem

                    deleniti quaerat eligendi tempora impedit!

                </p>

                

                

                <button class="arrow-btn button" type="button" style="font-size: 2.4rem; padding: 6px 24px;">Buy now '.$price.'</button>

            </div>

            <div class="col-md-6 col-sm-6 col-lg-6">

                <img class="teacher" src="/images/preview.png" alt="teacher">

                <div class="color-box"></div>



            </div>

        </div>

    </div>

    <!-- main ends here -->



    <!-- Accordian and side bar div -->

    <div class="container2">

        <div class="course">

            <h1 >Course content</h1>

            <p>6 sections • 9 lectures • 8h</p>

            <ul>

                <li onclick="toggle(this);">

                    <input type="checkbox" >

                    <i class="fas fa-plus"></i>

                    <h2>LESSON: 1</h2>

                <a href="" style="display: block;"> &nbsp; 1 &nbsp;What is python.</a>

                <a href="" style="display: block;"> &nbsp; 2 &nbsp;What is python.</a>

                <a href="" style="display: block;"> &nbsp; 3 &nbsp;What is python.</a>

                <a href="" style="display: block;"> &nbsp; 4 &nbsp;What is python.</a>





                </li>

                <li onclick="toggle(this);">

                    <input type="checkbox" checked>

                    <i class="fas fa-plus"></i>

                    <h2>LESSON: 2</h2>

                    <a href="" style="display: block;"> &nbsp; 1 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 2 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 3 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 4 &nbsp;What is python.</a>

                </li>

                <li onclick="toggle(this);">

                    <input type="checkbox" checked>

                    <i class="fas fa-plus"></i>

                    <h2>LESSON: 3</h2>

                    <a href="" style="display: block;"> &nbsp; 1 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 2 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 3 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 4 &nbsp;What is python.</a>

                <li onclick="toggle(this);">

                    <input type="checkbox" checked>

                    <i class="fas fa-plus"></i>

                    <h2>LESSON: 4</h2>

                    <a href="" style="display: block;"> &nbsp; 1 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 2 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 3 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 4 &nbsp;What is python.</a>

                </li>

                <li onclick="toggle(this);">

                    <input type="checkbox" checked>

                    <i class="fas fa-plus"></i>

                    <h2>LESSON: 5</h2>

                    <a href="" style="display: block;"> &nbsp; 1 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 2 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 3 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 4 &nbsp;What is python.</a>

                </li>

                <li onclick="toggle(this)">

                    <input type="checkbox" checked>

                    <i class="fas fa-plus"></i>

                    <h2>LESSON: 6</h2>

                    <a href="" style="display: block;"> &nbsp; 1 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 2 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 3 &nbsp;What is python.</a>

                    <a href="" style="display: block;"> &nbsp; 4 &nbsp;What is python.</a>

                </li>

            </ul>

        </div>

        <div class="container1">

            <div class="card">

                <div class="card-head">

                    

                    <video controls class="vid" src="/videos/5fdedaec6a9d6video.m4v"></video>

                    <div class="product-detail">

                         Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus quas in cumque sed quisquam unde, veniam qui ab, sit nulla voluptas ad ea commodi obcaecati quaerat dolorum nostrum, laborum dicta!

                    </div>

                   

                </div>

                <div class="card-body">

                    <div class="product-desc">

                        <span class="product-title">

                           <b>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</b>

                            <span class="badge">

                               4.5<i class="fas fa-star"></i>

                            </span>

                        </span>

                        <p class="update-date">Last Updated: <span id="update-date">12/06/21</span></p>

                        <span class="product-caption">

                            <div id="teacher-name">

                           Created By: 

                            </div>

                           <a href="#">lorem ipsam</a>

                        </span>

                        <p>Language <span id="languagr">English</span></p>

                    </div>

                    <div class="product-properties">

                            <div id="product-p" style="font-family: \'Roboto Slab\', serif;">

                            	&#8377; 500

                            </div>

                            <ul class="ul-size">

                                <!-- <button class="button btn">Buy now</button> -->

                                <button class="button btn arrow-btn"><i class="fas fa-chalkboard-teacher"></i></button>

                                <button class="button btn arrow-btn"><i class="fas fa-cart-plus"></i></button>

                                <button class="button btn arrow-btn"><i class="fas fa-share-alt"></i></button>

                            </ul>

                     </div>

                    

</div>

</div>

        </div>

    </div>

    <!-- Accordian -->







    <!-- Review section -->

    <div class="testimonial-container">

        <h2>What our students think:</h2>

        <div class="progress-bar"></div>

        <div class="fas fa-quote-left fa-quote"></div>

        <div class="fas fa-quote-right fa-quote"></div>

        <p class="testimonial">

            I\'ve worked with literally hundreds of HTML/CSS developers and I have to

            say the top spot goes to this guy. This guy is an amazing developer. He

            stresses on good, clean code and pays heed to the details.

        </p>

        <div class="user">

            <img draggable="false" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=707b9c33066bf8808c934c8ab394dff6"

                alt="user" class="user-image" />

            <div class="user-details">

                <h4 class="username">Miyah Myles</h4>

                <p class="role">Marketing</p>

            </div>

        </div>

    </div>

    <!-- Review section ends here -->

    <script src="/js/course_preview.js"></script>

    <script>

        function toggle(e){

            if(e.childNodes[3].classList.contains("fa-plus")){

            e.childNodes[3].classList.remove("fa-plus");

            e.childNodes[3].classList.add("fa-minus");

            }else{

                e.childNodes[3].classList.remove("fa-minus");

            e.childNodes[3].classList.add("fa-plus");

            }

        };

        // this is not a bug but a feature on clicking the li the class changes and it changes the icon inside the i tag with plus and minus icon but the feature is it doesnt changes when clickd on the padding of the li

    </script>

    ';

 include_once "footer.php";

 echo'

</html>';

}



?>

