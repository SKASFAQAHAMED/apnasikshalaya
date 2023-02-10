<?php
include_once("../sn/con.php");
$show = "show";
$hide = "hide";
if(isset($_POST['from'])) {
    $from = mysqli_real_escape_string($con, htmlspecialchars($_POST['from'], ENT_QUOTES));
} elseif(isset($_GET['from'])) {
    $from = mysqli_real_escape_string($con, htmlspecialchars($_GET['from'], ENT_QUOTES));
} else {
    $from = null;
} if(isset($_POST['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_POST['action'], ENT_QUOTES));
} elseif(isset($_GET['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
} else {
    $action = null;
}
if($action === "upload") {
    $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['newsletter'], ENT_QUOTES));
    $sql2 = "SELECT id FROM apnaEmails WHERE emailIs = ? && extra = ?;";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("ss", $email, $show);
    $stmt2->execute();
    $stmt2->store_result();
    if($stmt2->num_rows() != 0) {
        header("Location: /index?from=newsletter&action=upload&status=emailerror");
        exit();
    } else {
        $ip = getenv("REMOTE_ADDR");
        $sql = "INSERT INTO apnaEmails (emailIs, ipIs, extra) VALUES (?, ?, ?);";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("sss", $email, $ip, $show);
        $stmt->execute();
        $subject = "Apnasikshalaya newsletter confirmation email";
	$body = "Thank you for subscribing to our newsletter";
	$headers = "From: no_reply@apnasikshalaya.com" . "\r\n";
	mail($email, $subject, $body, $headers);
        header("Location: /index.php?from=newsletter&action=upload&status=success");
        exit();
    }
} else {
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
} else {
	header('Location: index.php?error=user');
      	exit();
}	$five = 5;
	$sql = "SELECT * FROM admin_users WHERE Adminname = ? && Adminpass = ? && Adminrole < ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ssi", $user, $pass, $five);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() != 1) {
		header('Location: index.php?error=user');
      		exit();
	} else {
	$stmt->bind_result($adminId, $adminName, $adminPass, $adminRole, $adminExtra,$adminRealName,$adminRoleName);
	$stmt->fetch();
  echo'<!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="./css/super-admin.css">
  <title>News Letter | Apna Admin</title>
    </head>
    <body>
    <div class="container-fluid">
      <div class="row main">
        <div class="col-md-2 col-lg-2 ss" style="padding-right: 0;">
          <div class="side-bar">
            <div class="row side-pro">
              <div class="nu col-md-12 col-lg-12">
                  <h1><b>'.$adminRealName.'</b></h1>
                  <h4>'.$adminRoleName.'</h4>
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
<div>&nbsp;</div>
<div id="search_table">
</div>
        
</div>';
	if($action === "view")  {
    echo '
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">List of emails</div>
  <div class="panel-body">
  	<button class="btn btn-primary" type="btn"><a href="newsletter.php?action=input" style="color: #fff;">Send Email</a></button>';
  if($_GET['status'] == "success") {
  echo '<p>Emails sent successfully</p>';
  }
  echo '</div>
  <table class="table">
    <tr>
    	<th>No.</th>
        <th>Email</th>
        <th>IP</th>
        <th>Date</th>
        <th>Time</th>
        <th>Condition</th>
    </tr>';
    $i = 1;
    $sql = "SELECT * FROM apnaEmails;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $email,  $ip, $dateTime, $extra);
    while($stmt->fetch()) {
        echo '<tr>
            <td>'.$i.'</td>
            <td>'.$email.'</td>
            <td>'.$ip.'</td>
            <td>'.substr($dateTime, 0, 10).'</td>
            <td>'.substr($dateTime, 10).'</td>
            <td>';
            $i++;
            if($extra === "show") {
            	echo '<a href="./newsletter.php?action=del&id='.$id.'"><abbr title="Click to unsubscribe">Subscribed</abbr></a>';
            } else {
            	echo 'Unsubscribed';
            }
        echo '</td>
        </tr>';
    }
    echo '</table>
        </div>
    </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </html>';
} elseif($action == "input") {
	echo '
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Send Email</div>
  <div class="panel-body">
  	<button class="btn btn-primary" type="btn">
  		<a href="newsletter.php?action=view" style="color: #fff;">List of Emails</a>
  	</button>
  </div>
</div>
<form method="POST" action="newsletter.php" style="width: 90%; margin: auto;">
<input name="from" value="newsletter" type="hidden">
<input name="action" value="send" type="hidden">
	<div class="form-group">
  <label for="subject">Subject: </label>
  <input id="subject" name="subject" placeholder="Enter subject" class="form-control">
</div>
<div class="form-group">
  <label for="body">Body: </label>
  <textarea class="form-control" id="body" name="body" placeholder="Enter body" row="5" style="resize: vertical;"></textarea>
</div>
<button type="submit" class="btn btn-default">Send</button>
</form>
';
} elseif($action == "send") {
	$sql = "SELECT emailIs FROM apnaEmails WHERE extra = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("s", $show);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($email);
	$to = "";
	$i = 0;
	while($stmt->fetch()) {
		if($i != 0) {
			$to .= ", ".$email;
		} else {
			$to .= $email;
		}
		$i++;
	}
	$subject = mysqli_real_escape_string($con, htmlspecialchars($_POST['subject'], ENT_QUOTES));
	$body = mysqli_real_escape_string($con, htmlspecialchars($_POST['body'], ENT_QUOTES));
	$headers = "From: Apna Sikshalaya <no_reply@apnasikshalaya.com>" . "\r\n";
	mail($to, $subject, $body, $headers);
	header("Location: ./newsletter?action=view&status=success");
	exit();
} elseif($action == "del") {
	$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
	$sql = "UPDATE apnaEmails SET extra = ? WHERE id = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("si", $hide, $id);
	$stmt->execute();
	header("Location: ./newsletter.php?action=view");
	exit();
}
}
}
echo '</div>
</div>
</body>
<!-- Bootstrap Bundle with Popper -->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
      let btn = document.querySelector("#side-bar-btn");
      let sideBar = document.querySelector(".ss");

      btn.onclick = function(){
        sideBar.classList.toggle("active");
      }
    
        $(document).ready(function (){
         
          $(".edit_btn").click(function (e){
            e.preventDefault();
            var course_id = $(this).closest("tr").find(".course_id").text();
            $.ajax({
              type:"POST",
              url:"courseview.php",
              data:{
                "checking_edit_btn":true,
                "course_id":course_id,
              },
              success: function (response){
                $.each(response, function(key, value){
                  $("#edit_id").val(value["id"]);
                  $("#edit_title").val(value["titleIs"]);
                  $("#edit_catagory").val(value["cataIs"]);
                  $("#edit_subCata").val(value["subCataIs"]);
                  $("#edit_type").val(value["typeIs"]);
                  $("#edit_sdesc").val(value["sDescIs"]);
                  $("#edit_teacher").val(value["teacherIs"]);
                  $("#edit_language").val(value["langIS"]);
                  $("#edit_price").val(value["priceIs"]);
                  $("#edit_ldesc").val(value["lDescIs"]);
                  $("#edit_preview").val(value["previewIs"]);
                  $("#edit_hours").val(value["hourIs"]);
                  $("#edit_chapters").val(value["chapterIS"]);
                  $("#edit_certification").val(value["certificateIs"]);
                  $("#edit_best").val(value["bestForIs"]);
                  $("#edit_thumb").val(value["thumbIs"]);
                });
                $("#editCourseModal").modal("show");
              }
            });
          });
          $(".delete_btn").click(function (e){
            e.preventDefault();
            var course_id = $(this).closest("tr").find(".course_id").text();
            $("#delete_id").val(course_id);
            $("#deleteCourseModal").modal("show");
          });
        });

        function search_data(){
          var search=jQuery("#search").val();
          if(search!="")
          {
            jQuery.ajax({
              method:"POST",
              url:"courseview.php",
              data:{search: search,},
              success:function(data)
              {
                jQuery("#search_table").html(data);
              }
            });	
          }
        }
      </script>
</html>
';