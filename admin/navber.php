<?php
include_once("../sn/con.php");
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
} elseif(isset($_POST['user']) && isset($_POST['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
} else {
	header('Location: index.php?error=user');
      	exit();
}
	$sql = "SELECT * FROM admin_users WHERE BINARY Adminname = ? AND BINARY Adminpass = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ss", $user, $pass);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() != 1) {
		header('Location: index.php?error=user');
      		exit();
	} else {
	$stmt->bind_result($adminId, $adminName, $adminPass, $adminRole, $adminExtra, $adminrealname);
	$stmt->fetch();
	$_SESSION['user'] = $adminName;
	$_SESSION['pass'] = $adminPass;
	$_SESSION['role'] = $adminRole;
      echo
'<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/super-admin.css">
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <title>Apna Sikshalaya admin panel</title>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row main">
      <div class="col-md-2 col-lg-2 ss" style="padding-right: 0;">
        <div class="side-bar square scrollbar-dusty-grass square thin">
          <div class="row side-pro">
            <div class="nu col-md-12 col-lg-12">
                <h1><b>'.$adminName.'</b></h1>
                <h4>Super Admin</h4>
                <p>Last Logged in:<i>09-sep-2021 05:37 PM</i></p>
            </div>
          </div>
          <!--<div class="row last-time" style="display: flex; align-items: center; justify-content: center;">
              <div class="last col-md-8"><h1 style="margin: 0;">Last Login:</h1></div>
              <div class="ldt col-md-8"><span style="padding: 0;">09-sep-2021, 05:37P.M.</span></div>
          </div> -->
          <div class="dash-board row"><a href="#">Dashboard</a></div>
          <div class="all-options row">';
            if($adminRole < 4) {
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
          if($adminRole < 5) {
          echo'<details>
            <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Newsletter <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
            <a href="./newsletter.php?action=input"><button>Send Email</button></a>
            <a href="./newsletter.php?action=view"><button>View Emails</button></a>
          </details>';
          }
          if($adminRole == 1) {
           echo'<details>
                <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Admins <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                <a href="./admin.php?action=input"><button>Add Admin</button></a>
                <a href="./admin.php?action=view"><button>View Admin</button></a>
            </details>
            <details>
              <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Enrolment <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
              <a href="./enroll.php?action=view"><button style="max-width: 100%;">Enrolment</button></a>
          </details>
          <details>
            <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">ALL content change <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
            <a href="./allcontentchange.php?action=view"><button style="max-width: 100%;">EDIT ALL CONTENT</button></a>
          </details>';
          }
          if($adminRole < 4) {
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
          if($adminRole < 4) {
           echo '<details>
                <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Live Events <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                <a href="./events.php?action=upload"><button>Upload Event</button></a>
                <a href="./events.php?action=view"><button>View Event</button></a>
            </details>';
           }
            
            if($adminRole < 6) {
           echo '<details>
                <summary  onclick="this.childNodes[1].getAttribute(\'src\')==\'icons/right.png\' ? this.childNodes[1].setAttribute(\'src\',\'icons/down.png\') : this.childNodes[1].setAttribute(\'src\',\'icons/right.png\') ">Creative Blogs <img src="icons/right.png" height="15px" width="15px" style="float: right; margin: 5px  8px 0 0;" alt=""></summary>
                <a href="./blog.php?action=upload"><button>Upload Blog</button></a>
                <a href="./blog.php?action=view"><button>View Blogs</button></a>
            </details>';
          }

         echo '</div>
        </div>
      </div>