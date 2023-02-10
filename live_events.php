<!--This website is designed & developed by ___ _________ _________ _________ ________ _________ ________ _________ ___ __ / _ \ / / __ //___ ___//___ ___/ / ______//___ ___/ / ______//___ ___/ / _ \ / / / / \ \ / / /__/ / / / / / / /__ / / / / / / / / \ \ / / / / \ \ / / ____/ / / / / / ___/ / / / / / / / / \ \ / / / /_____\ \ / / \ \ / / ___/ /___ / / ___/ /___ / /______ ___/ /___ / /_____\ \ / /_____/___________\ /_/ \_\ /_/ /________//_/ /________//________//________//___________\ /_______/ ________ _________ _________ _______ / _____/ / / __ / /___ ___/ / __ / / / / / /__/ / / / / / / / / / / / ____/ / / / / / / / /______ / / \ \ ___/ /___ / /__/ / /________/ /_/ \_\ /________/ /______/ Visit crioit.com for more info.-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Live Eventes</title> <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./css/all.css"> <!-- --------- Owl-Carousel ------------------->
  <link rel="stylesheet" href="./css/owl.carousel.min.css">
  <link rel="stylesheet" href="./css/owl.theme.default.min.css"> <!-- ------------ AOS Library ------------------------- -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"> <!-- Custom Style -->
  <link rel="stylesheet" href="./css/live_events.css">
  <style>
    .owl-carousel .owl-item img {
    display: block;
    width: 68%;
    border-radius: 12px;
}
.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 27px 40%;
    border-radius: 4px;
}
  </style>
</head><?php include_once "header.php"; ?>
<?php //here this can be optimized if the details are stored when the first time the query is hit in the header
?>

<body>
  <!--------------------------------The Modal---------------------------->
  <div class="modal fade" id="liveeventsModal" tabindex="-1" role="dialog" aria-labelledby="eventModallabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="liveeventsModallabel"></h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body"> <input type="hidden" name="eventId" id="event_id"> <input id="userna" type="hidden" name="userName" value="<?php $userEmail = $_SESSION['user'];
                                                                                                                                            echo "$userEmail"; ?>"> <input id="userole" type="hidden" name="userRole" value="<?php $Role = $_SESSION['Role'];
                                                                                                                                                                                                                              echo "$Role"; ?>"> <input type="hidden" name="date" id="event_date"> <input type="hidden" name="time" id="event_time"> <input type="hidden" name="name" id="Uname">
          <div>
            <h2>Subscribe to <span id="eventnameis"> </span> </h2>
            <p class="status" style="display:none;color:green;"></p>
          </div>
        </div>
        <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-danger subscribe_btn" name="sub" onclick=" const eventid = document.querySelector('#event_id').value; const realeventid = 'eve'+eventid; document.getElementById(realeventid).style.display = 'none';">SUBSCRIBE!</button> </div>
      </div>
    </div>
  </div>
  <!----------------------------- Main Site Section ------------------------------>
  <main class="squish">
    <!------------------------ Site Title ---------------------->
    <section class=" container-fluid">
      <div class="site-title">
        <div class="site-background" data-aos-delay="100">
          <h1 style="color:white;">Live Events Calendar</h1>
          <h5>Explore live events, conferences, seminars, and success events from all over the world. We also host a variety of live, virtual events.</h5> <a href="#blog" style="text-decoration:none;"> <button class="arrow-btn">Explore Our Live Events</button></a>
        </div>
      </div>
    </section>
    <!------------x----------- Site Title ----------x----------->
    <!-- --------------------- Blog Carousel ----------------- -->
    <section>
      <div class="blog" id="blog">
        <div id="first" class="container-fluid">
          <div class="owl-carousel owl-theme blog-post"> <?php $Role = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['Role'], ENT_QUOTES));
                                                          $userEmail = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
                                                          if ($Role == "teacher") {
                                                            $sql = "SELECT eventId FROM teacher_subs_event WHERE emailIs = ?;";
                                                            $stmt = $con->stmt_init();
                                                            $stmt->prepare($sql);
                                                            $stmt->bind_param("s", $userEmail);
                                                            $stmt->execute();
                                                            $stmt->store_result();
                                                            $stmt->bind_result($subscribedEventId);
                                                            $subeventarray = array();
                                                            while ($stmt->fetch()) {
                                                              array_push($subeventarray, $subscribedEventId);
                                                            }
                                                            //start
                                                            $sql = "SELECT * FROM apnaTeachers WHERE emailIs = ?;";
                                                            $stmt = $con->stmt_init();
                                                            $stmt->prepare($sql);
                                                            $stmt->bind_param("s", $userEmail);
                                                            $stmt->execute();
                                                            $stmt->store_result();
                                                            $stmt->bind_result($id, $googleId, $nameteacher, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
                                                            $stmt->fetch();    
                                                            $show = "show";
                                                            $sql = "SELECT * FROM apna_Events WHERE extra = ?;";
                                                            $stmt = $con->stmt_init();
                                                            $stmt->prepare($sql);
                                                            $stmt->bind_param("s", $show);
                                                            $stmt->execute();
                                                            $stmt->store_result();
                                                            $stmt->bind_result($id, $title, $topic, $content, $organize, $keywords, $eventdate, $eventtime, $views, $enrolled, $uploadtime, $thumb, $prereq, $eventlink, $visivlity, $extra);
                                                            while ($stmt->fetch()) {
                                                              echo ' <div class="blog-content"data-aos-delay="200">';
                                                              if($thumb != null) {
                                                                echo '<img src="'.$thumb.'" alt="">';
                                                              } else {
                                                                echo '<img src="./admin/coursethumb/coursethumb113.png" alt="">';
                                                       }
                                                               echo'
                                                               <div class="blog-title" > 
                                                               <p class = "eventid" style="display:none;">' . $id . '</p> 
                                                               <p class = "eventname" style="display:none;">' . $title . '</p> 
                                                               <p class = "studentname" style="display:none;">' . $nameteacher . '</p> 
                                                               <p class = "studentphone" style="display:none;">' . $contact . '</p> 
                                                               <h3>' . $title . '</h3> <p class="eventContent">' . $content . '</p> 
                                                               <span class="eDate">' . $eventdate . '</span>
                                                               <span class="eTime"> ' . $eventtime . '</span><br> ';
                                                              if (in_array($id, $subeventarray)) {
                                                                echo '<p  style="color: rgba(86, 255, 0, 1);text-decoration: none;cursor:none;">Already Enrolled</p>';
                                                              } /*elseif (empty($subeventarray)) { echo '<a href="#" class="subs_btn" style="color: rgba(255, 86, 0, 1);">Enroll Now </a>'; }*/ else {
                                                                echo '<a class="subs_btn" style="color: rgba(255, 86, 0, 1);cursor:pointer" id="eve' . $id . '">Enroll Now</a>';
                                                              }
                                                              echo ' </div> </div>';
                                                            } 
                                                            // end
                                                          } else {
                                                            $sql = "SELECT eventId FROM student_subs_event WHERE emailIs = ?;";
                                                            $stmt = $con->stmt_init();
                                                            $stmt->prepare($sql);
                                                            $stmt->bind_param("s", $userEmail);
                                                            $stmt->execute();
                                                            $stmt->store_result();
                                                            $stmt->bind_result($subscribedEventId);
                                                            $subeventarray = array();
                                                            while ($stmt->fetch()) {
                                                              array_push($subeventarray, $subscribedEventId);
                                                            }
                                                            $sql = "SELECT * FROM apnaStudents WHERE emailIs = ?;";
                                                            $stmt = $con->stmt_init();
                                                            $stmt->prepare($sql);
                                                            $stmt->bind_param("s", $userEmail);
                                                            $stmt->execute();
                                                            $stmt->store_result();
                                                            $stmt->bind_result($studentid, $googleId, $namestudent, $gender, $contact, $altContact, $dob, $emailstudent, $pass, $address, $addressline2, $city, $state, $district, $pin, $quality, $institute, $test, $tuition, $professionalCourse, $certificationCourse, $competitiveCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra, $lastlogin, $firstupload, $thumbnail, $creditscore);
                                                            $stmt->fetch();    
                                                            $show = "show";
                                                            $sql = "SELECT * FROM apna_Events WHERE extra = ?;";
                                                            $stmt = $con->stmt_init();
                                                            $stmt->prepare($sql);
                                                            $stmt->bind_param("s", $show);
                                                            $stmt->execute();
                                                            $stmt->store_result();
                                                            $stmt->bind_result($id, $title, $topic, $content, $organize, $keywords, $eventdate, $eventtime, $views, $enrolled, $uploadtime, $thumb, $prereq, $eventlink, $visivlity, $extra);
                                                            while ($stmt->fetch()) {
                                                              echo ' <div class="blog-content"data-aos-delay="200">';
                                                              if($thumb != null) {
                                                                echo '<img src="'.$thumb.'" alt="">';
                                                              } else {
                                                                echo '<img src="./admin/coursethumb/coursethumb113.png" alt="">';
                                                       }
                                                               echo'
                                                               <div class="blog-title" > 
                                                               <p class = "eventid" style="display:none;">' . $id . '</p> 
                                                               <p class = "eventname" style="display:none;">' . $title . '</p> 
                                                               <p class = "studentname" style="display:none;">' . $namestudent . '</p> 
                                                               <p class = "studentphone" style="display:none;">' . $contact . '</p> 
                                                               <h3>' . $title . '</h3> <p class="eventContent">' . $content . '</p> 
                                                               <span class="eDate">' . $eventdate . '</span>
                                                               <span class="eTime"> ' . $eventtime . '</span><br> ';
                                                              if (in_array($id, $subeventarray)) {
                                                                echo '<p  style="color: rgba(86, 255, 0, 1);text-decoration: none;cursor:none;">Already Enrolled</p>';
                                                              } /*elseif (empty($subeventarray)) { echo '<a href="#" class="subs_btn" style="color: rgba(255, 86, 0, 1);">Enroll Now </a>'; }*/ else {
                                                                echo '<a class="subs_btn" style="color: rgba(255, 86, 0, 1);cursor:pointer" id="eve' . $id . '">Enroll Now</a>';
                                                              }
                                                              echo ' </div> </div>';
                                                            } 
                                                          }
                                                          ?> 
                                                          </div>
        </div>
      </div>
    </section>
    <!-------- All Events Filter Part ----->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 filter ">         
            <h3><b>DATE RANGE</b></h3>
            <ul class="duration-list">
              <div class="form-check event_filter">
                <li><label><input type="checkbox" class="form-check-input date" value="1"><span>Next day</span><label></li>
                <li><label><input type="checkbox" class="form-check-input date" value="2"><span>This week</span></label></li>
                <li><label><input type="checkbox" class="form-check-input date" value="3"><span>Next week</span></label></li>
                <li><label><input type="checkbox" class="form-check-input date" value="4"><span>This month</span></label></li>
              </div>
            </ul>
            <h3><b>Type</b></h3>
            <ul class="duration-list">
              <div class="form-check event_filter">
              <?php 
                 $sql = "SELECT DISTINCT keywordIs FROM apna_Events WHERE extra = ?;";
                 $stmt = $con->stmt_init();
                 $stmt->prepare($sql);
                 $stmt->bind_param("s", $show);
                 $stmt->execute();
                 $stmt->store_result();
                 $stmt->bind_result($type);
                 while ($stmt->fetch()) {
                   echo'
                   <li><label><input type="checkbox" class="form-check-input type" value="'.$type.'"><span>'.$type.'</span></label> </li>
                   ';
                 }
              ?>
                
            </ul>
            <h3><b>Organizers</b></h3>
            <ul class="duration-list">
              <div class="form-check event_filter">
              <?php 
                 $sql = "SELECT DISTINCT organizerIs FROM apna_Events WHERE extra = ?;";
                 $stmt = $con->stmt_init();
                 $stmt->prepare($sql);
                 $stmt->bind_param("s", $show);
                 $stmt->execute();
                 $stmt->store_result();
                 $stmt->bind_result($organizer);
                 while ($stmt->fetch()) {
                   echo'
                   <li><label><input type="checkbox" class="form-check-input organizer" value="'.$organizer.'"><span>'.$organizer.'</span></label></li>
                   ';
                 }
              ?>
                

            </ul>

        </div> 
        <!-- Below is the filtered result from col-md-9 -->
        <div class="col-md-9" id="result">
          
          <h2 class="event-heading" style="margin: 20px 10px 30px;"><b>All Upcomming Events</b></h2>
          <div class="row product">
            <div class="img col-md-4"><img src="images/images (1).jpeg" alt=""></div>
            <div class="details col-md-6">
              <h4>Tittle Goes here</h4>
              <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p> <span>02/sep/2021</span><span> - 02/sep/2021</span>
            </div>
            <div class="price col-md-2">
              <h6><a href="#" style="color: rgba(255, 86, 0, 1); text-decoration:none;">Enroll Now <i class="fas fa-chevron-right"></i> </a></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
  </main>

  <!-- Jquery Library file -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
  <!-- --------- Owl-Carousel js ------------------->
  <script src="./js/owl.carousel.min.js"></script> <!-- ------------ AOS js Library ------------------------- -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script> <!-- Custom Javascript file -->
  <script src="./js/blogger.js"></script>
  <script>
var owl = $('.owl-carousel');
owl.owlCarousel({
    items:3,
    loop:true,
    margin:1,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true
});
  </script>
<?php
$pageno = mysqli_real_escape_string($con, htmlspecialchars($_GET['page'], ENT_QUOTES));
if(isset($_GET['page']) && $_GET['page'] != null){
  if($pageno == null){
    $pageno = 1;
  }
}
?>

<script>

$(document).ready(function() {
eventfilter()
function eventfilter() { 
  var action = 'data';
    var organizer = get_filter('organizer');
    var date = get_filternumber('date');
    var type = get_filter('type');
    // var organizer = JSON.stringify(organizer)
    // var type = JSON.stringify(type)
    var organizer = organizer
    var type = type
    console.log(" type:"+ typeof organizer)
    console.log("organizer:"+ organizer)
    

    $.ajax({
      type: "POST",
      url: "liveeventsview.php",
      data: {
        "organizer": organizer,
        "date": date,
        "type": type,
        "action": action,
      },
      dataType: 'JSON',
      success: function(data) {
        console.log("Returned result:" + data)
        $("#result").html(data);
      }
    });
   };

  $(".event_filter").click(function() {   
    var action = 'data';
    var organizer = get_filter('organizer');
    var date = get_filternumber('date');
    var type = get_filter('type');
    var organizer = JSON.stringify(organizer)
    var type = JSON.stringify(type)
    console.log(" type:"+ typeof type)
    console.log("type:"+ type)
    

    $.ajax({
      type: "POST",
      url: "liveeventsview.php",
      data: {
        "organizer": organizer,
        "date": date,
        "type": type,
        "action": action,
      },
      success: function(data) {
        console.log("Returned result:" + data)
        $("#result").html(data);
      }
    });
  });
  // this below function is getting all checked values in an array
  function get_filternumber(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function() {
      filter.push($(this).val());
    });
    var max_val = Math.max.apply(null,filter)
    if(max_val=== -Infinity)return 0;
    return max_val
  }
  function get_filter(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function() {
      filter.push($(this).val());
    });
    return filter
  }


  // ------------------------------------------------------------------------------------------------

  $(".subs_btn").click(function(e) {
        e.preventDefault();
        var event_id = $(this).closest("div").find(".eventid").text();
        var event_name = $(this).closest("div").find(".eventname").text();
        var event_date = $(this).closest("div").find(".eDate").text();
        var event_time = $(this).closest("div").find(".eTime").text();
        var studentname = $(this).closest("div").find(".studentname").text();
        var phone = $(this).closest("div").find(".studentphone").text();
        var event_rusername = $("#userna").val();
        var event_userole = $("#userole").val();
        document.querySelector('#event_id').value = event_id;
        // console.log(event_id); // console.log(event_date); // console.log(event_time); // console.log(event_rusername); // console.log(event_userole); // console.log(studentname); // console.log(phone); // console.log(event_name); 
        $(".subscribe_btn").removeAttr('disabled');
        $(".subscribe_btn")[0].innerText = "Subscribe";
        $("#eventnameis").html(event_name);
        $("#liveeventsModal").modal("show");
        $(".subscribe_btn").click(function(e) {
          $(this)[0].disabled = true;
          $(this)[0].innerText = "Your are Succusfully Subscribed";
          $.ajax({
            type: "POST",
            url: "liveeventsview.php",
            data: {
              "subscribe_btn": true,
              "event_id": event_id,
              "event_date": event_date,
              "event_time": event_time,
              "event_rusername": event_rusername,
              "event_userole": event_userole,
              "studentname": studentname,
              "studentphone": phone,
              "eventName": event_name,
            },
            success: function(response) {
              console.log(response)
              $(".status").html(response);
              // $("#blog").load("live_events.php #blog");
              location.reload();
            }
          });
          $(".status").css('display', 'block');
          setTimeout(() => {
            $(".status").css('display', 'none');
          }, 5000);
          
        });
        
      });

}); 
</script>

</body>
<?php include_once "footer.php"; ?>

</html>