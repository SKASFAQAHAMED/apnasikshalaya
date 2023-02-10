<?php
include_once "../sn/con.php";
session_start();
if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
  $user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
  $pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
} elseif (isset($_POST['user']) && isset($_POST['pass'])) {
  $user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));
  $pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
} else {
  header('Location: index.php?error=user');
  exit();
}
$four = 4;
$sql = "SELECT Adminname, Adminpass, Adminrole, AdminRealName, AdminroleName FROM admin_users WHERE Adminname = ? && Adminpass = ? && Adminrole < ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ssi", $user, $pass, $four);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows() != 1) {
  header('Location: index.php?error=user');
  exit();
} else {
  $stmt->bind_result($adminName, $adminPass, $adminRole, $adminRealName, $adminRoleName);
  $stmt->fetch();
  $show = "show";
  $hide = "hide";
  echo '<!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="./css/super-admin.css">
  <title>Manage Events | ApnaAdmin</title>
  <style>
  .profilelink:hover {background-color: green;}
  .profilelink{
    cursor: pointer;
}
  </style>
    </head>
    <body>
    <div class="container-fluid">
      <div class="row main">
        <div class="col-md-2 col-lg-2 ss" style="padding-right: 0;">
          <div class="side-bar">
            <div class="row side-pro">
              <div class="nu col-md-12 col-lg-12">
                  <h1><b>' . $adminRealName . '</b></h1>
                  <h4>' . $adminRoleName . '</h4>
                  <p>Last Logged in:<i>09-sep-2021 05:37 PM</i></p>
              </div>
            </div>
            <div class="dash-board row"><a href="./">Dashboard</a></div>
            <div class="all-options row">';
  if ($adminRole < 4) {
    echo '<details>
                  <summary onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Certification Courses <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 4px  8px 0 0;" alt=""></summary>
                  <a href="/course.php?action=input&type=certification"><button>Upload Course</button></a>
                  <a href="/course.php?action=view&type=certification"><button>View Course</button></a>
              </details>
              <details>
                  <summary   onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Professional Courses <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                  <a href="/course.php?action=input&type=professional"><button>Upload Course</button></a>
                  <a href="/course.php?action=view&type=professional"><button>View Course</button></a>
              </details>
              <details>
                  <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Registration <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                  <a href="./student.php?action=view"><button>View Students</button></a>
                  <a href="./teacher.php?action=view"><button>View Mentors</button></a>
              </details>';
  }
  if ($adminRole < 5) {
    echo '<details>
              <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Newsletter <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
              <a href="./newsletter.php?action=input"><button>Send Email</button></a>
              <a href="./newsletter.php?action=view"><button>View Emails</button></a>
            </details>';
  }
  if ($adminRole == 1) {
    echo '<details>
                  <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Admins <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                  <a href="./admin.php?action=input"><button>Add Admin</button></a>
                  <a href="./admin.php?action=view"><button>View Admin</button></a>
              </details>
              <details>
                <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Enrolment <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                <a href="./enroll.php?action=view"><button style="max-width: 100%;">Enrolment</button></a>
            </details>
            <details>
              <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Content Change <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
              <a href="./allcontentchange.php?action=view"><button style="max-width: 100%;">EDIT ALL CONTENT</button></a>
            </details>';
  }
  if ($adminRole < 4) {
    echo '<details>
                  <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Tuition <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                  <a href="./tuition.php?action=upload"><button>Upload Tuition</button></a>
                  <a href="./tuition.php?action=view"><button>View Tuition</button></a>
              </details>
              
              <details>
                <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Consultancy <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                <a href="./consultancy.php?action=pending"><button style="max-width: 100%;">View Pending</button></a>
                <a href="./consultancy.php?action=completed"><button style="max-width: 100%;">View Completed</button></a>
              </details>';
  }
  if ($adminRole < 4) {
    echo '<details>
                  <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Live Events <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                  <a href="./events.php?action=upload"><button>Upload Event</button></a>
                  <a href="./events.php?action=view"><button>View Event</button></a>
              </details>';
  }

  if ($adminRole < 6) {
    echo '<details>
                  <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Creative Blogs <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                  <a href="./blog.php?action=upload"><button>Upload Blog</button></a>
                  <a href="./blog.php?action=view"><button>View Blogs</button></a>
              </details>';
  }

  echo '</div>
          </div>
        </div>
<div class="col-md-10 col-lg-10" style="padding-left: 0;">
<div class="dash">
<div class="row nav">
  <div class="menu">
  <div>
      <span  style="width:30px;" id="side-bar-btn" >
      <i class="fa fa-bars"></i>
    </span><span><b>Apnasikshalaya</b></span>
                </div>
      <div class="form-group">
      <input type="text" name="search" id="search" placeholder="Search.." onkeyup="search_data();">
      </div>
      <a class="logout" style="float:right;" href="./logout.php"><button>Logout</button></a>
      </div>
  
 
  </div>
          
  </div>
  <div id="search_table">
        
';
  if (isset($_POST['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_POST['action'], ENT_QUOTES));
  } elseif (isset($_GET['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
  } else {
    $action = null;
  }
  if ($action === "upevents") {
    $show = "show";
    $title = mysqli_real_escape_string($con, htmlspecialchars($_POST['title'], ENT_QUOTES));
    $topic = mysqli_real_escape_string($con, htmlspecialchars($_POST['topic'], ENT_QUOTES));
    $content = mysqli_real_escape_string($con, htmlspecialchars($_POST['content'], ENT_QUOTES));
    $organizer = mysqli_real_escape_string($con, htmlspecialchars($_POST['organizer'], ENT_QUOTES));
    $keywords = mysqli_real_escape_string($con, htmlspecialchars($_POST['keywords'], ENT_QUOTES));
    $date = mysqli_real_escape_string($con, htmlspecialchars($_POST['date'], ENT_QUOTES));
    $time = mysqli_real_escape_string($con, htmlspecialchars($_POST['time'], ENT_QUOTES));
    $plink = mysqli_real_escape_string($con, htmlspecialchars($_POST['plink'], ENT_QUOTES));
    $prereq = mysqli_real_escape_string($con, htmlspecialchars($_POST['prereq'], ENT_QUOTES));
    $eventlink = mysqli_real_escape_string($con, htmlspecialchars($_POST['eventlink'], ENT_QUOTES));
    $visiblity = mysqli_real_escape_string($con, htmlspecialchars($_POST['visiblity'], ENT_QUOTES));
    $sql = "INSERT INTO apna_Events (titleIs, topicIs, contentIs, organizerIs, keywordIs, eventDate, eventTime, previewVideo, prereqIs, eventLink, visibleIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("ssssssssssss", $title, $topic, $content, $organizer, $keywords, $date, $time, $plink, $prereq, $eventlink, $visiblity, $show);
    if ($stmt->execute()) {
      echo 'success';
      header("Location: ./events.php?action=upload");
    } else {
      echo 'Error';
    }
  }
  if ($action === "upload") {
    echo '
</div>
<div class="panel panel-default" style="margin-left:26px;">
<div class="panel-heading">FIll This Form</div>
<form action="events.php" method="POST">
  <input type="hidden" name ="action" value="upevents"> 
  <div class="form-group">
    <label for="title">Enter Title</label>
    <input type="text" class="form-control" name="title"  placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label for="topic">Enter Topic</label>
    <input type="text" class="form-control" name="topic"  placeholder="Enter Topic">
  </div>
  <div class="form-group">
    <label for="content">please enter the Content of the Event</label>
    <textarea class="form-control" name="content" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="organizer">Enter the Organizer</label>
    <input type="text" class="form-control" name="organizer"  placeholder="Enter organizer">
  </div>
  <div class="form-group">
    <label for="keywords">Enter Keywords if any</label>
    <input type="text" class="form-control" name="keywords"  placeholder="Enter keyword">
  </div>
  <div class="form-group">
    <label for="date"> Event Date</label>
    <input type="date" class="form-control" name="date">
  </div>
  <div class="form-group">
    <label for="time">Enter Time</label>
    <input type="time" class="form-control" name="time"  placeholder="Enter Time">
  </div>
  <div class="form-group">
    <label for="plink">Enter Cover picture Link(please keep it blank if there is no link)</label>
    <input type="text" class="form-control" name="plink"  placeholder="Enter Ttile">
  </div>
  <div class="form-group">
    <label for="prereq">Enter pre-requisite</label>
    <input type="text" class="form-control" name="prereq"  placeholder="Enter pre-requisite">
  </div>
  <div class="form-group">
    <label for="eventlink">Enter Event Link</label>
    <input type="text" class="form-control" name="eventlink"  placeholder="Enter Event link">
  </div>
  <div class="form-group">
    <input type="hidden" class="form-control" name="visiblity" value="show"  placeholder="Enter visibility">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
';
  } elseif ($action === "viewtuition") {
    $tuitiontype = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuitiontype'], ENT_QUOTES));
 if($tuitiontype=="online"){
  echo '
  <div class="modal fade" id="eventVIEWmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Live Events</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class = "event_viewing_data">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
  </div>
</div>
  <div class="modal fade" id="eventuserVIEWmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Live Events</h5>
      <p style="display:none;" class ="eventidin"></p>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
    <p class = "mail_status" style="color:green;">
    </p>
      <div class = "event_user_viewing_data">
      </div>
      <label for="title">Google Meet link of the Event</label>
      <input type="text" name ="elink" id="mlink" class="form-control" placeholder="please enter the meet link">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary sendmail" data-dismiss="modal">Send Mail to all the subscribers</button>
      
      <a id="subsan" href="" class="btn btn-primary">View all the subscribers</a>
    </div>
  </div>
  </div>
</div>
<div class="modal fade" id="editEventsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="editEventsModallabel">Events Details (Update/Edit)</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<form action ="eventsview.php" method="POST">
<div class="modal-body">
  <input type="hidden" name ="Eid" id="edit_id">
  <div class = "form-group">
      <label for="title">Title of the Event</label>
      <input type="text" name ="title" id="edit_title" class="form-control" placeholder="title">
  </div>
 <div class = "form-group">
    <label for="topic">topic of the Event</label>
    <input type="text" name ="topic" id="edit_topic" class="form-control" placeholder="Topic of the event">
 </div>
 <div class = "form-group">
    <label for="content">please enter Content</label>
    <textarea class="form-control" name="content" id="edit_content" rows="4"></textarea>
 </div>
 <div class = "form-group">
    <label for="organizer">Organizer</label>
    <input type="text" name ="organizer" id="edit_organizer" class="form-control" placeholder="Alternate Contact no.">
 </div>
 <div class = "form-group">
    <label for="keywords">keywords</label>
    <input type="text" name ="keywords" id="edit_keywords" class="form-control" placeholder="keywords">
 </div>
 <div class = "form-group">
    <label for="eventdate">Event Date</label>
    <input type="date" name ="eventdate" id="edit_eventdate" class="form-control" placeholder="">
 </div>
 <div class = "form-group">
    <label for="eventtime">Event Time</label>
    <input type="time" name ="eventtime" id="edit_eventtime" class="form-control" placeholder="">
 </div>
 <div class = "form-group">
    <label for="pvid">Preview Picure Link(cover photo)</label>
    <input type="text" name ="pvid" id="edit_pvid" class="form-control" placeholder="Enter preview video link">
 </div>
 <div class = "form-group">
    <label for="prereq">Pre-requisites</label>
    <input type="text" name ="prereq" id="edit_prereq" class="form-control" placeholder="Enter pre-requisites ">
 </div>
 <div class = "form-group">
    <label for="eventlink">Event Link</label>
    <input type="text"  name ="eventlink" id="edit_eventlink" class="form-control" placeholder="enter Event Link">
 </div>
 <div class = "form-group">
    <label for="visi">Visibility</label>
    <input type="text" name ="visi" id="edit_visi" class="form-control" placeholder="visibility of the event">
 </div>
 <div class = "form-group">
    <label for="extra">Extra</label>
    <input type="text" name ="extra" id="edit_extra" class="form-control" placeholder="Enter Extra(if any)">
 </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" name ="update_events" class="btn btn-primary">Update</button>
</div>
</form>
</div>
</div>
</div>
<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModallabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="deleteEventModallabel">Event Details (Delete)</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action = "eventsview.php" method="POST">
<div class="modal-body">
<input type="hidden" name="event_id" id="delete_id">
  <div>
    <h2>Are you sure you want to delete this event from database?!</h2>
  </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-danger" name="delete_teacher">Delete!</button>
</form>
</div>
</div>
</div>
</div>
<div class="panel panel-default" style="margin-left:26px;">
<!-- Default panel contents -->
<div class="panel-heading">List of All Online Tuitions created by their respective Teachers</div>
<div class="panel-heading">Click on the tuitions Title to see all the details </div>
<table class="table">
<tr><th>#</th>
  <th>Tuition Name</th>
  <th>Grade</th>
  <th>Board being Taught in</th>
  <th>subjects</th>
  <th>sec-subjects</th>
  <th>specialization</th>
  <th>Hours</th>
  <th>Weekdays</th>
  <th>view no. of Students</th>
</tr>';
    $show = "show";
    $sql = "SELECT * FROM onlineTeacherTuition;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $slno = 1;
    $stmt->bind_result($id, $teacherId, $iconis, $teacherEmail, $tuitionName, $Tdesc, $gradeIs, $boardIs, $subjectIs, $secondarysubis, $spclIs, $houris, $weekdayis, $extra);
    while ($stmt->fetch()) {
      echo '<tr>
      <td>' . $slno . '</td>
      <td class = "teacher_email" style="display:none;">' . $teacherEmail . '</td>
      <td class="profilelink"><a href="#" >'. $tuitionName . '</a></td>
      <td>' . $gradeIs . '</td>
      <td>' . $boardIs . '</td>
      <td>' . $subjectIs . '</td>
      <td>' . $secondarysubis . '</td>
      <td>' . $spclIs . '</td>
      <td>' . $houris . '</td>
      <td>' . $weekdayis . '</td>
     </tr>';
      $slno++;
    }
    echo '</table>
  </div>';
 }else{

 }
   
  } elseif ($action == "selecttuition") {
     echo '  
<form action="/tuitions.php?action=viewtuition" method="POST">
<div class="form-check">
  <input type="radio" class="form-check-input" id="radio1" name="tuitiontype" value="offline" checked>View all Offline tuitions
  <label class="form-check-label" for="radio1"></label>
</div>
<div class="form-check">
  <input type="radio" class="form-check-input" id="radio2" name="tuitiontype" value="online">View all online tuitions
  <label class="form-check-label" for="radio2"></label>
</div>
     <button type="submit" class="btn btn-primary">Submit</button>
</form>
     ';
  }
}
?> </body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
      /*--------------------- navbar Sctript start ----------------------------- */
  let btn = document.querySelector("#side-bar-btn");
  let sideBar = document.querySelector(".ss");
  btn.onclick = function() {
    console.log("clicked on ham");
    sideBar.classList.toggle("active");
  }
  /*--------------------- navbar Sctript End---------------------------- */
  /*--------------------- For Searchbar Sctript start ----------------------------- */
  function search_data() {
    var search = jQuery("#search").val();
    if (search != "") {
      jQuery.ajax({
        method: "POST",
        url: "courseview.php",
        data: {
          search: search,
        },
        success: function(data) {
          jQuery("#search_table").html(data);
        }
      });
    }
  }
  /*--------------------- For Searchbar Sctript End ----------------------------- */

    $(".profilelink").click(function(e){
      let teach_email = $(this).closest("tr").find(".teacher_email").text();
      let desig = "student";
      let link = '/userprofileinfo.php?desig='+desig+'&email='+teach_email;
      console.log(teach_email);
      console.log(link);
      window.location.href=link;
    });


    $(".view_btn").click(function(e) {
      e.preventDefault();
      var event_id = $(this).closest("tr").find(".event_id").text();
      $.ajax({
        type: "POST",
        url: "eventsview.php",
        data: {
          "checking_viewbtn": true,
          "event_id": event_id,
        },
        success: function(response) {
          $(".event_viewing_data").html(response);
          $("#eventVIEWmodal").modal("show");
        }
      });
    });
    $(".edit_btn").click(function(e) {
      e.preventDefault();
      var event_id = $(this).closest("tr").find(".event_id").text();
      $.ajax({
        type: "POST",
        url: "eventsview.php",
        data: {
          "checking_edit_btn": true,
          "event_id": event_id,
        },
        success: function(response) {
          $.each(response, function(key, value) {
            $("#edit_id").val(value["id"]);
            $("#edit_title").val(value["titleIs"]);
            $("#edit_topic").val(value["topicIs"]);
            $("#edit_content").val(value["contentIs"]);
            $("#edit_organizer").val(value["organizerIs"]);
            $("#edit_keywords").val(value["keywordIs"]);
            $("#edit_eventdate").val(value["eventDate"]);
            $("#edit_eventtime").val(value["eventTime"]);
            $("#edit_pvid").val(value["previewVideo"]);
            $("#edit_prereq").val(value["prereqIs"]);
            $("#edit_eventlink").val(value["eventLink"]);
            $("#edit_visi").val(value["visibleIs"]);
            $("#edit_extra").val(value["extra"]);
          });
          $("#editEventsModal").modal("show");
        }
      });
    });
    $(".delete_btn").click(function(e) {
      e.preventDefault();
      var event_id = $(this).closest("tr").find(".event_id").text();
      $("#delete_id").val(event_id);
      $("#deleteEventModal").modal("show");
    });
    $(".sndmail_btn").click(function(e) {
      e.preventDefault();
      var event_id = $(this).closest("tr").find(".event_id").text();
      document.getElementById("subsan").href = "./events.php?action=viewsubs&Eid=" + event_id;
      var anch = document.getElementById("subsan").href;
      $.ajax({
        type: "POST",
        url: "eventsview.php",
        data: {
          "checking_sendbtn": true,
          "event_id": event_id,
        },
        success: function(response) {   
          $(".event_user_viewing_data").html(response);
          $("#eventuserVIEWmodal").modal("show");
        }
      });
      $(".eventidin").text(event_id);
      var event_id = $(".eventidin").text();
      console.log(event_id + " this is inside the first sendin");
    });
    $(".sendmail").click(function(e) {
      e.preventDefault();
      var event_idis = $(".eventidin").text();
      var eventlink = $("#mlink").val();
      console.log(eventlink + " this is the link");
      $.ajax({
        type: "POST",
        url: "eventsview.php",
        data: {
          "sendmail": true,
          "event_id": event_idis,
          "eventlink": eventlink,
        },
        success: function(response) {
           
          $(".event_user_viewing_data").html(response);
          $("#eventuserVIEWmodal").modal("show");
        }
      });
    });
  });

</script>

</html>