<?php
include_once '../sn/con.php';
session_start();
$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
$sql = "SELECT * FROM apnaTeachers WHERE emailIs = ? && passIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows() != 1) {
	header("Location: /index?from=signin&status=error");
	exit();
} else {
  $stmt->bind_result($id, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
	$stmt->fetch();
	if($verify == 1) {
echo'<!DOCTYPE html>
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
  <link rel="stylesheet" href="css/bootstrap.min.css"> 

   <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href="../css/footerstyle.css">

   <link rel="stylesheet" href="../css/tution_index.css">

  <style>

    hr {margin: 0 !important;}

    .modal-footer .btn+.btn {

      margin-bottom: 11px;

      margin-left: 5px;
  }
  .moredtl:hover{
    background: linear-gradient( 
      90deg
      , rgba(255,86,0,1) 0%, rgba(255,0,146,1) 100%);
  }
  </style>
  </head>';
  include_once './header.php';
   echo '<body>
  <div class="modal fade" id="tuitionModal" tabindex="-1" role="dialog" aria-labelledby="tuitionModallabel" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="tuitionModalModallabel"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">

          <input type="hidden" name="tuitionId" id="tuition_id">

          <div>

            <h2 id="nametuition"></h2>

            <h4>IMPORTANT! This link would be sent to all the Enrolled students of this tuition</h4>

            <p class = "status" style="display:none;color:green;"></p>

            <label  for="subject" class="center">G-Meet Link </label>

		        <input id="emailsid" type="text" placeholder="Enter Link" name="link" class="form-text" required >

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-danger send_btn" name="sub">Send!</button>

    </div>

  </div>

</div>

</div>









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

         <div id="menu-4" class="content blog-section container">

         <div class="blog-header text-center section-title">

             <h1>Your Tuitions</h1>

             <p>These are the list of tuitions you have created</p>      

         </div>

         <div class="row blog-posts">';

         $teacherid = $id;

         $show = "show";

         $sql = "SELECT * FROM onlineTeacherTuition WHERE teacherId = ?;";

         $stmt = $con->stmt_init();

         $stmt->prepare($sql);

         $stmt->bind_param("s", $teacherid);

         $stmt->execute();

         $stmt->store_result();

         $stmt->bind_result($id, $Tid, $icon, $teacherEmail, $tuitionName, $tdescription, $gradeIs, $boardIs, $subjectIs, $secondarysubIs, $speciIs, $hourIs, $weekdaysIs, $extra);

         while($stmt->fetch()) {

         echo'<div class="col-md-4 col-sm-12">

                 <div class="blog-item post-1 animated zoomIn">

                     <div class="blog-bg blog-pink"></div>

                      <div class="blog-content">

                         <p class = "tuitionid" style="display:none;">' . $Tid . '</p>

                         <h3 class = "tuiname">'.$tuitionName.'</h3>

                         <span class="solid-line"></span>

                         <p>Days-'.$weekdaysIs.'</p>

                         <p>Time-'.$hourIs.'</p>

                         <p>Grade-'.$gradeIs.'</p>

                         <a class="moredtl" href="#">More details...</a>

                      </div>

                 </div>

             </div>';

         }

         echo'
         </div>
         </div>
        <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s">
            <form action="tuitionform.php" method="POST" class="feed-back-from">
             <input type="hidden" name="tuitionform" value="upload">

             <input type="hidden" name="teacheid" value="'.$Tid.'">
             <input type="hidden" name="teacheremail" value="'.$email.'">

              <h1 class="feed-back-label">Add Tuitions</h1>

              <h2>Add tuition Details and publish </h2>

              <label for="board" class="center">Board </label>

               <input type="text" placeholder="Enter Board" name="board" class="form-text" required >

              <label for="grade" class="center">Grade </label>

               <input type="number" placeholder="Enter grade you want to teach in this tuition" name="grade" class="form-text" required >

              <label  for="subject" class="center">Subject </label>

		           <input type="text" placeholder="Enter Subject" name="subject" class="form-text" required >

              <label for="secsubject" class="center">Secondary Subject</label>

               <input type="text" placeholder="Enter Secondary Subject" name="secsubject" class="form-text" required >

              <label for="tuitioname" class="center">Tuition Name</label>

               <textarea id="feedBack" name="tuitioname" placeholder="Add Your Tuition\'s name" rows="3" cols="13" class="form-area"></textarea>

              <label for="wday" class="center">Days you will teach</label>

               <input type="text" placeholder="Enter Days ex-Mon,Tue" name="wday" class="form-text" required>

              <label for="spcl" class="center">Your Specialization</label>

               <input type="text" placeholder="your specialization" name="spcl" class="form-text" required>

              <label for="ttime" class="center">Timming</label>

               <input type="time" placeholder="Timing of your tuition" name="ttime" class="form-text" required>

              <button type="submit" class="arrow-btn" style="width:100%">Submit</button>

            </form>

        </div>

        </div>

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

        <script>

        $(document).ready(function() {

          $(".moredtl").click(function(e) {

          e.preventDefault();

          var tuitionId = $(this).closest("div").find(".tuitionid").text();

          var tuitionname = $(this).closest("div").find(".tuiname").text();

          console.log(tuitionId);

          console.log(tuitionname);

          $("#tuitionModal").modal("show");

          $("#nametuition").text(tuitionname);

          $(".send_btn").click(function(e) {

           var meetlink = $("#emailsid").val(); 

           console.log(meetlink);          

            $.ajax({

                    type:"POST",

                    url:"tuitionform.php",

                    data:{

                      "sendmail_btn":true,

                      "tuitionid":tuitionId,

                      "meetlinkis":meetlink,

                    },

        

                    success: function (response){

                      console.log(response)

                      $(".status").html(response);

                      $("#tuitionModal").modal("show");

                    }

                  });

      

            });

             

      

          });

        });

      </script>

     

     </body>

     </html>';

     } 

     }

     