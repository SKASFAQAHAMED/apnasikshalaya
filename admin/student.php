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
  <title>Apna Sikshalaya admin panel</title>
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
            <a href="./"><div class="dash-board row">Dashboard</div></a>
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
  <div id="search_table"></div>
        
';
  $student_count = 0;
  if (isset($_POST['from'])) {
    $from = mysqli_real_escape_string($con, htmlspecialchars($_POST['from'], ENT_QUOTES));
  } elseif (isset($_GET['from'])) {
    $from = mysqli_real_escape_string($con, htmlspecialchars($_GET['from'], ENT_QUOTES));
  } else {
    $from = null;
  }
  if (isset($_POST['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_POST['action'], ENT_QUOTES));
  } elseif (isset($_GET['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
  } else {
    $action = null;
  }
  if ($action === "upload") {
    $show = "show";
    $name = mysqli_real_escape_string($con, htmlspecialchars($_POST['sName'], ENT_QUOTES));
    $gender = mysqli_real_escape_string($con, htmlspecialchars($_POST['sGender'], ENT_QUOTES));
    $contact = mysqli_real_escape_string($con, htmlspecialchars($_POST['sContact'], ENT_QUOTES));
    $altContact = mysqli_real_escape_string($con, htmlspecialchars($_POST['sAltContact'], ENT_QUOTES));
    $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['sEmail'], ENT_QUOTES));
    $address = mysqli_real_escape_string($con, htmlspecialchars($_POST['sAddress'], ENT_QUOTES));
    $guardian = mysqli_real_escape_string($con, htmlspecialchars($_POST['sGuardian'], ENT_QUOTES));
    $learn = mysqli_real_escape_string($con, htmlspecialchars($_POST['sLearn'], ENT_QUOTES));
    $board = mysqli_real_escape_string($con, htmlspecialchars($_POST['sBoard'], ENT_QUOTES));
    $scl = mysqli_real_escape_string($con, htmlspecialchars($_POST['sSchool'], ENT_QUOTES));
    $mode = mysqli_real_escape_string($con, htmlspecialchars($_POST['sMode'], ENT_QUOTES));
    $sql2 = "SELECT id FROM apnaStudents WHERE emailIs = ? && extra = ?;";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("ss", $email, $show);
    $stmt2->execute();
    $stmt2->store_result();
    if ($stmt2->num_rows() != 0) {
      header("Location: ../index.php?from=student&action=upload&status=emailerror");
      exit();
    } else {
      $show = "show";
      $ip = getenv("REMOTE_ADDR");
      $sql = "INSERT INTO apnaStudents (nameIs, genderIs, contactIs, altContactIs, emailIs, addressIs, guardianIs, learnIs, boardIs, schoolIs, studyModeIs, ipIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("sssssssssssss", $name, $gender, $contact, $altContact, $email, $address, $guardian, $learn, $board, $scl, $mode, $ip, $show);
      $stmt->execute();
      header("Location: ../index.php?from=student&action=upload&status=success");
      exit();
    }
  } elseif ($action === "view") {
    echo '
  <div class="modal fade" id="studentVIEWmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Student Details (view)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class = "student_viewing_data">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStudentModallabel">Student Details (Update/Edit)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action ="studentview.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name ="Eid" id="edit_id">
            <div class = "form-group">
                <label for="Ename">Name</label>
                <input type="text" name ="Ename" id="edit_name" class="form-control" placeholder="Name">
            </div>
          <div class = "form-group">
              <label for="Egender">Gender</label>
              <select name ="Egender" id="edit_gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
          </div>
          <div class = "form-group">
              <label for="Econtact">Contact</label>
              <input type="text" name ="Econtact" id="edit_contact" class="form-control" placeholder="Contact no.">
          </div>
          <div class = "form-group">
              <label for="Ealtcontact">Alternate contact no.</label>
              <input type="text" name ="Ealtcontact" id="edit_altcontact" class="form-control" placeholder="Alternate Contact no.">
          </div>
          <div class = "form-group">
              <label for="Edob">Date of birth</label>
              <input type="date" name ="Edob" id="edit_dob" class="form-control" placeholder="DOB">
          </div>
          <div class = "form-group">
              <label for="Eemail">Email</label>
              <input type="email" name ="Eemail" id="edit_email" class="form-control" placeholder="Email">
          </div>
          <div class = "form-group">
              <label for="Epassword">Password</label>
              <input type="password" name ="Epassword" id="edit_pass" class="form-control" placeholder="Passowrd">
          </div>
          <div class = "form-group">
              <label for="Eaddress">Address</label>
              <input type="text" name ="Eaddress" id="edit_address" class="form-control" placeholder="Enter address">
          </div>
          <div class = "form-group">
              <label for="Ecity">City</label>
              <input type="text" name ="Ecity" id="edit_city" class="form-control" placeholder="Enter City">
          </div>
          <div class = "form-group">
              <label for="Estate">State</label>
              <input type="text" name ="Estate" id="edit_state" class="form-control" placeholder="Enter State ">
          </div>
          <div class = "form-group">
              <label for="Epin">Pin Code</label>
              <input type="number" min="0" name ="Epin" id="edit_pin" class="form-control" placeholder="Enter Pin code">
          </div>
          <div class = "form-group">
              <label for="Equality">Educational Qualification</label>
              <input type="text" name ="Equality" id="edit_quality" class="form-control" placeholder="Enter educational qualification">
          </div>
          <div class = "form-group">
              <label for="Einstitute">Institute</label>
              <input type="text" name ="Einstitute" id="edit_institute" class="form-control" placeholder="Enter institute">
          </div>
          <div class = "form-group">
              <label for="Etest">Test Series</label>
              <input type="text" name ="Etest" id="edit_test" class="form-control" placeholder="Enter test series">
          </div>
          <div class = "form-group">
              <label for="Etuition">Tuition Service</label>
              <input type="text" name ="Etuition" id="edit_tuition" class="form-control" placeholder="Enter Tuition service">
          </div>
          <div class = "form-group">
              <label for="Eprof">Professional Courses</label>
              <input type="text" name ="Eprof" id="edit_prof" class="form-control" placeholder="Enter Professional Course">
          </div>
          <div class = "form-group">
              <label for="Ecerti">Certification Course</label>
              <input type="text" name ="Ecerti" id="edit_certi" class="form-control" placeholder="Enter Certification Course">
          </div>
          <div class = "form-group">
              <label for="Ecompete">Competetive Courses</label>
              <input type="text" name ="Ecompete" id="edit_compete" class="form-control" placeholder="Enter Competetive Course">
          </div>
          <div class = "form-group">
              <label for="Ecrash">Crash Course</label>
              <input type="text" name ="Ecrash" id="edit_crash" class="form-control" placeholder="Enter Crash Course">
          </div>
          <div class = "form-group">
              <label for="Ematerials">Study Materials</label>
              <input type="text" name ="Ematerials" id="edit_materials" class="form-control" placeholder="Enter Study Materials">
          </div>
          <div class = "form-group">
              <label for="Everification">Verification</label>
              <input type="text" name ="Everification" id="edit_verification" class="form-control" placeholder="Verification">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name ="update_student" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModallabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteStudentModallabel">Student Details (Delete)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action = "studentview.php" method="POST">
            <div class="modal-body">
            <input type="hidden" name="student_email" id="delete_email">
              <div>
                      <h2>Are you sure you want to delete this student from database?!</h2>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" name="delete_student">Delete!</button>
        </form>
        
      </div>
    </div>
  </div>
</div>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">List of student(s)
  </div>

  
  <div class="row fliter-row" style="padding-top:10px;">
    <div class="col-md-3 filter-col" style="padding-left:10px;">
      <form action="student.php?action=view" method="GET">
      <input type="hidden" name="action" value="view">
          <div class="col-md-12">
            <select name="cata" required="">
            <option selected disabled>Filter By Gander</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
            </select>
          </div>
          <div class="row">
          <div class="col-md-6"><button type="submit" style="margin-left: 17px;">Filter</button></div>
          <div class="col-md-6"><a href="student.php?action=view&type=default" class="btn btn-outline-dark">Clear Filter</a></div></div>
      </form>
    </div>
    
    <div class="col-md-4 filter-col">
    <form action="student.php?action=view" method="GET">
      <input type="hidden" name="action" value="view">
      <input type="hidden" name="type" value="' . $_GET["type"] . '">
     <div class="row">
      <div class="col-md-2"><label>From Date:</label></div>
      <div class="col-md-7"><input type="date" name="fromDate" max="' . date('Y-m-d') . '" value="' . $_GET['fromDate'] . '" required></div>
      <div class="col-md-3" style="padding-right: 30px; !important"><button type="submit">Filter</button></div>
      </div>
      <div class="row">
      <div class="col-md-2"><label>To Date:</label></div>
      <div class="col-md-7"><input type="date" name="toDate" max="' . date('Y-m-d') . '" value="' . $_GET['toDate'] . '" required></div>
      <div class="col-md-3"><a href="student.php?action=view&type=default&cata=' . $_GET['cata'] . '" class="btn btn-outline-dark" style="padding-right: 0px; !important">Clear Filter</a></div>
     </div>
     </form>
    </div>
    
    <div class="col-md-3" style="float:right; padding-right:10px;">
    <form action="studentview.php" method="POST">
      <input type="hidden" name="gender" value="' . $_GET['cata'] . '">
      <input type="hidden" name="fromDate" value="' . $_GET['fromDate'] . '">
      <input type="hidden" name="toDate" value="' . $_GET['toDate'] . '">
  <button type="submit" name="export_excel" class="btn btn-success">Download data (xlsx format)</button>
  
  </form>
  <a href="./teacher.php?action=view"><button class="btn btn-success">View Mentors</button></a>
  </div>
  </div>
  
  <!--div class="panel-body">
    <p>Apna Sikshalaya Admin Panel</p>
  </div-->
  <table class="table table-striped w-auto">
    <tr><th>#</th>
    <th class="text-center"> Name</th>
    <th class="text-center"> Email</th>
    <th class="text-center"> Gender</th>
    <th class="text-center"> Contact</th>
    <th class="text-center"> Verify</th>
    <th class="text-center"> View</th>
    <th class="text-center"> Edit</th>
    <th class="text-center"> Delete</th>
    </tr>';
    $cata = $_GET['cata'];
    if (isset($_GET['cata'])) {
      $cata = $_GET['cata'];
      $sql = "SELECT * FROM apnaStudents WHERE genderIs = ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("s", $cata);
    } elseif (isset($_GET['fromDate']) && $_GET['fromDate'] != null && isset($_GET['toDate']) && $_GET['toDate'] != null) {
      $fromDate = $_GET['fromDate'];
      $toDate = $_GET['toDate'];
      $sql = "SELECT * FROM apnaStudents WHERE extra = ? AND SUBSTRING(firstUploadTime, 1, 10) BETWEEN ? AND ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("sss", $show, $fromDate, $toDate);
    } else {
      $sql = "SELECT * FROM apnaStudents WHERE extra = ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("s", $show);
    }
    $stmt->execute();
    $stmt->store_result();
    $slno = 1;
    $stmt->bind_result($id, $googleId, $name, $gender, $contact, $altContact, $dob, $email, $pass, $address, $addressline2, $city, $state, $district, $pin, $quality, $institute, $test, $tuition, $professionalCourse, $certificationCourse, $competitiveCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra, $lastlogin, $firstupload, $thumbnail, $creditscore);
    while ($stmt->fetch()) {
      echo '<tr>
            <td>' . $slno . '</td>
            <td class = "profilelink" style="cursor: pointer;">' . $name . '</td>
           <td class = "stud_email">' . $email . '</td>
            <td>' . $gender . '</td>
            <td>' . $contact . '</td>
            <td>';
      if ($verify == "1") {
        echo 'Verifed';
      } else {
        echo $verify;
      }
      echo '</td>
            <td>
            <i class="fa fa-eye view_btn" aria-hidden="true"></i></td>
            <td> <i class="fas fa-edit edit_btn"></i></td>
            <td> <i class="fa fa-trash delete_btn" aria-hidden="true"></i>
             </td>';
      $slno++;
      echo '</tr>
      ';
    }
    echo '</table>
        </div>
    </body>';
  }
}
?>

<!-- Bootstrap Bundle with Popper -->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
  /*--------------------- navbar Sctript start ----------------------------- */
  let btn = document.querySelector("#side-bar-btn");
  let sideBar = document.querySelector(".ss");

  btn.onclick = function() {
    sideBar.classList.toggle("active");
  }
  /*--------------------- navbar Sctript End---------------------------- */

  $(document).ready(function() {

    $(".profilelink").click(function(e){
      let stud_email = $(this).closest("tr").find(".stud_email").text();
      let desig = "student";
      let link = '/userprofileinfo.php?desig='+desig+'&email='+stud_email;
      window.location.href=link;
    });
    

    $(".delete_btn").click(function(e) {
      e.preventDefault();
      var stud_email = $(this).closest("tr").find(".stud_email").text();
      $("#delete_email").val(stud_email);
      $("#deleteStudentModal").modal("show");
    });
    $(".view_btn").click(function(e) {
      e.preventDefault();
      var stud_email = $(this).closest("tr").find(".stud_email").text();
      $.ajax({
        type: "POST",
        url: "studentview.php",
        data: {
          "checking_viewbtn": true,
          "student_email": stud_email,
        },
        success: function(response) {
          $(".student_viewing_data").html(response);
          $("#studentVIEWmodal").modal("show");
        }
      });
    });
    $(".edit_btn").click(function(e) {
      e.preventDefault();
      var stud_email = $(this).closest("tr").find(".stud_email").text();
      $.ajax({
        type: "POST",
        url: "studentview.php",
        data: {
          "checking_edit_btn": true,
          "student_email": stud_email,
        },
        success: function(response) {
          $.each(response, function(key, value) {
            $("#edit_id").val(value["id"]);
            $("#edit_name").val(value["nameIs"]);
            $("#edit_gender").val(value["genderIs"]);
            $("#edit_contact").val(value["contactIs"]);
            $("#edit_altcontact").val(value["altContactIs"]);
            $("#edit_dob").val(value["dobIs"]);
            $("#edit_email").val(value["emailIs"]);
            $("#edit_pass").val(value["passIs"]);
            $("#edit_address").val(value["addressIs"]);
            $("#edit_city").val(value["cityIs"]);
            $("#edit_state").val(value["stateIs"]);
            $("#edit_pin").val(value["pinIs"]);
            $("#edit_quality").val(value["qualityIs"]);
            $("#edit_institute").val(value["instituteIs"]);
            $("#edit_test").val(value["testSeriesIs"]);
            $("#edit_tuition").val(value["tuitionServiceIs"]);
            $("#edit_prof").val(value["professionalCourseIs"]);
            $("#edit_certi").val(value["certificationCourseIs"]);
            $("#edit_compete").val(value["competitiveCourseIs"]);
            $("#edit_crash").val(value["crashCourseIs"]);
            $("#edit_materials").val(value["studyMaterialIs"]);
            $("#edit_verification").val(value["verifyIs"]);
          });
          $("#editStudentModal").modal("show");
        }
      });
    });
  });

  function search_data() {
    var search = jQuery("#search").val();
    if (search != "") {
      jQuery.ajax({
        method: "POST",
        url: "studentview.php",
        data: {
          search: search,
        },
        success: function(data) {
          jQuery("#search_table").html(data);
        }
      });
    }
  }
</script>

</html>