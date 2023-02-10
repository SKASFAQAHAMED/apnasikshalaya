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
  
 
  </div>
          
  </div>
  <div id="search_table">
        
';
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
	$show = "show";
    $name = mysqli_real_escape_string($con, htmlspecialchars($_POST['tName'], ENT_QUOTES));
    $gender = mysqli_real_escape_string($con, htmlspecialchars($_POST['tGender'], ENT_QUOTES));
    $contact = mysqli_real_escape_string($con, htmlspecialchars($_POST['tContact'], ENT_QUOTES));
    $altContact = mysqli_real_escape_string($con, htmlspecialchars($_POST['tAltContact'], ENT_QUOTES));
    $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['tEmail'], ENT_QUOTES));
    $address = mysqli_real_escape_string($con, htmlspecialchars($_POST['tAddress'], ENT_QUOTES));
    $subject = mysqli_real_escape_string($con, htmlspecialchars($_POST['tSubject'], ENT_QUOTES));
    $exp = mysqli_real_escape_string($con, htmlspecialchars($_POST['tExperience'], ENT_QUOTES));
    $quality = mysqli_real_escape_string($con, htmlspecialchars($_POST['tQualifications'], ENT_QUOTES));
    $spl = mysqli_real_escape_string($con, htmlspecialchars($_POST['tSpecialization'], ENT_QUOTES));
    $mode = mysqli_real_escape_string($con, htmlspecialchars($_POST['tMode'], ENT_QUOTES));
    $null = null;
    $resume = $_FILES['tResume'];
    $ip = getenv("REMOTE_ADDR");
    $fileType = strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION));
    $sql = "INSERT INTO apnaTeachers (nameIs, genderIs, contactIs, altContactIs, emailIs, addressIs, subjectIs, expIs, qualificationIs, sclSubjectIs, teachingModeIs, resumeIs, ipIs, verifyIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $name, $gender, $contact, $altContact, $email, $address, $subject, $exp, $quality, $spl, $mode, $null, $ip, $hide, $show);
    $stmt->execute();
    $id = $con->insert_id;
    $fileName = $id.".".$fileType;
    $fileLocation = "resume/".$fileName;
    move_uploaded_file($resume['tmp_name'], $fileLocation);
    $sql2 = "UPDATE apnaTeachers SET resumeIs = ? WHERE id = ?;";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("si", $fileName, $id);
    $stmt2->execute();
    header("Location: ../index.php?from=teacher&action=upload&status=success");
    exit();
} elseif($action === "view") {
    echo ' 


        <div class="modal fade" id="teacherVIEWmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Teachers Details (view)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class = "teacher_viewing_data">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        </div>
      </div>
    



      <div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="editTeacherModallabel">Teacher Details (Update/Edit)</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action ="teacherview.php" method="POST">
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
          <label for="Edob">Date of birth</label>
          <input type="date" name ="Edob" id="edit_dob" class="form-control" placeholder="DOB">
       </div>
       <div class = "form-group">
          <label for="Ealtcontact">Alternate contact no.</label>
          <input type="text" name ="Ealtcontact" id="edit_altcontact" class="form-control" placeholder="Alternate Contact no.">
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
          <label for="Epin">Subjects</label>
          <input type="text" name ="Esubjects" id="edit_subjects" class="form-control" placeholder="Enter Subject">
       </div>
       <div class = "form-group">
          <label for="Epin">Experience</label>
          <input type="text" name ="Eexperience" id="edit_experience" class="form-control" placeholder="Enter Experience">
       </div>
       <div class = "form-group">
          <label for="Equalifaction">Educational Qualification</label>
          <input type="text" name ="Equali" id="edit_quali" class="form-control" placeholder="Enter educational qualification">
       </div>
       <div class = "form-group">
          <label for="Einstitute">Certification Course</label>
          <input type="text" name ="Ecerti" id="edit_certi" class="form-control" placeholder="Enter Certification Course">
       </div>
       <div class = "form-group">
          <label for="Einstitute">Professional Course</label>
          <input type="text" name ="Eprocourse" id="edit_procourse" class="form-control" placeholder="Enter Professional Course">
       </div>
       <div class = "form-group">
          <label for="Einstitute">Tuition Service</label>
          <input type="text" name ="Etuition" id="edit_tuition" class="form-control" placeholder="Enter tuition service">
       </div>
       <div class = "form-group">
          <label for="Everification">Verification</label>
          <input type="text" name ="Everification" id="edit_verification" class="form-control" placeholder="Verification">
       </div>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name ="update_teacher" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
  </div>
</div>


<div class="modal fade" id="deleteTeacherModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModallabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="deleteteacherModallabel">Student Details (Delete)</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form action = "teacherview.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="teacher_id" id="delete_id">
        <div>
                <h2>Are you sure you want to delete this Teacher from database?!</h2>
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

<div class="panel panel-default" style="margin-left:23px;">
  <!-- Default panel contents -->
  <div class="panel-heading">List of teachers</div>

  <div class="row fliter-row" style="padding-top:10px;">
  <div class="col-md-3 filter-col" style="padding-left:10px;">
    <form action="teacher.php?action=view" method="GET">
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
  <form action="teacher.php?action=view" method="GET">
    <input type="hidden" name="action" value="view">
    <input type="hidden" name="type" value="'.$_GET["type"].'">
   <div class="row">
    <div class="col-md-2"><label>From Date:</label></div>
    <div class="col-md-7"><input type="date" name="fromDate" max="'.date('Y-m-d').'" value="'.$_GET['fromDate'].'" required></div>
    <div class="col-md-3" style="padding-right: 30px; !important"><button type="submit">Filter</button></div>
    </div>
    <div class="row">
    <div class="col-md-2"><label>To Date:</label></div>
    <div class="col-md-7"><input type="date" name="toDate" max="'.date('Y-m-d').'" value="'.$_GET['toDate'].'" required></div>
    <div class="col-md-3"><a href="teacher.php?action=view&type=default&cata='.$_GET['cata'].'" class="btn btn-outline-dark" style="padding-right: 0px; !important">Clear Filter</a></div>
   </div>
   </form>
  </div>
  
  <div class="col-md-3" style="float:right; padding-right:10px;">
  <form action="teacherview.php" method="POST">
    <input type="hidden" name="gender" value="'.$_GET['cata'].'">
    <input type="hidden" name="fromDate" value="'.$_GET['fromDate'].'">
    <input type="hidden" name="toDate" value="'.$_GET['toDate'].'">
<button type="submit" name="export_excel" class="btn btn-success">Download data (xlsx format)</button>

</form>
<a href="./student.php?action=view"><button class="btn btn-success">View Students</button></a>
</div>
</div>

  <!--div class="panel-body">
    <p>Apna Sikshalaya Admin Panel</p>
  </div-->
  <table class="table">
    <tr><th>#</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Pin Code</th>
        <th>Subject</th>
        <th>Experience</th>
        <th>Mode</th>
        <th>Action</th>
        <th > View</th>
    <th> Edit</th>
    <th > Delete</th>
    </tr>';
    $cata = $_GET['cata'];
    if(isset($_GET['cata'])){
      $sql = "SELECT * FROM apnaTeachers WHERE genderIs = ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("s", $cata);

    }elseif(isset($_GET['fromDate']) && $_GET['fromDate'] != null && isset($_GET['toDate']) && $_GET['toDate'] != null){
      $fromDate = $_GET['fromDate'];
      $toDate = $_GET['toDate'];
      $sql = "SELECT * FROM apnaTeachers WHERE extra = ? AND SUBSTRING(firstUploadTime, 1, 10) BETWEEN ? AND ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("sss", $show,$fromDate,$toDate);
    }
    else{
      $sql = "SELECT * FROM apnaTeachers WHERE extra = ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("s", $show);
  }$stmt->execute();
    $stmt->store_result();
    $slno=1;
    $stmt->bind_result($id, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $pass, $address, $addressline2, $city, $state, $district, $pin, $subject, $exp, $quali,$certicourse,$procourse,$tuition, $resume, $ip, $verify, $extra, $lastlogin, $firstupload, $thumbnail, $creditscore);
    while($stmt->fetch()) {
        echo '<tr>
            <td>'.$slno.'</td>
            <td class = "teacher_id" style="display:none;">'.$id.'</td>
            <td class = "profilelink" style="cursor: pointer;">'.$name.'</td>
            <td>'.$gender.'</td>
            <td>'.$contact.'</td>
            <td class = "teach_email">'.$email.'</td>
            <td>'.$address.'</td>
            <td>'.$pin.'</td>
            <td>'.$subject.'</td>
            <td>';
            if($exp != null) {
            	echo $exp.' yrs';
            }
            echo '</td>
            <td>'.$mode.'</td>
            <td>';
            if($verify === "show") {
            if($resume != null) {
                echo '<a href="resume/'.$resume.'" download="" style="color: #000090;">
                    <b>Resume</b>
                </a>';
                } else {
                	echo 'No resume';
                }
            } else {
                echo '<a href="./teacher.php?action=accept&id='.$id.'" style="color: #009000;">
                    <b>Accept</b>
                </a> / <a href="./teacher.php?action=reject&id='.$id.'" style="color: #900000;">
                    <b>Reject</b>
                </a> / <a href="resume/'.$resume.'" download="" style="color: #000090;">
                    <b>Resume</b>
                </a>';
            }
            echo '</td>
            <td>
            <i class="fa fa-eye view_btn" aria-hidden="true"></i></td>
            <td> <i class="fas fa-edit edit_btn"></i></td>
            <td> <i class="fa fa-trash delete_btn" aria-hidden="true"></i>
             </td>
           </tr>';
           $slno++;
    }
    echo '</table>
        </div>
    </body>'; 
    
} elseif($action === "accept") {
  $id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
  $sql = "UPDATE apnaTeachers SET verifyIs = ? WHERE id = ?;";
  $stmt = $con->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("si", $show, $id);
  $stmt->execute();
  header("Location: ./teacher.php?action=view&status=accept");
  exit();
} elseif($action === "reject") {
  $id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
  $sql = "UPDATE apnaTeachers SET extra = ? WHERE id = ?;";
  $stmt = $con->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("si", $hide, $id);
  $stmt->execute();
  header("Location: ./teacher.php?action=view&status=delete");
  exit();
}
}

    ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
        /*--------------------- navbar Sctript start ----------------------------- */
      let btn = document.querySelector("#side-bar-btn");
      let sideBar = document.querySelector(".ss");

      btn.onclick = function(){
        sideBar.classList.toggle("active");
      }
/*--------------------- navbar Sctript End---------------------------- */
        $(document).ready(function (){

          $(".profilelink").click(function(e){
      let teach_email = $(this).closest("tr").find(".teach_email").text();
      let desig = "teacher";
      let link = '/userprofileinfo.php?desig='+desig+'&email='+teach_email;
      console.log(teach_email);
      console.log(link);
      window.location.href=link;
    });
    
         
          $(".view_btn").click(function (e){
            e.preventDefault();
            var teacher_id = $(this).closest("tr").find(".teacher_id").text();
            $.ajax({
              type:"POST",
              url:"teacherview.php",
              data:{
                "checking_viewbtn":true,
                "teacher_id":teacher_id,
              },
              success: function (response){
                $(".teacher_viewing_data").html(response);
                $("#teacherVIEWmodal").modal("show");
              }
            });
          });
          $(".edit_btn").click(function (e){
            e.preventDefault();
            var teacher_id = $(this).closest("tr").find(".teacher_id").text();
            
            $.ajax({
              type:"POST",
              url:"teacherview.php",
              data:{
                "checking_edit_btn":true,
                "teacher_id":teacher_id,
              },
              success: function (response){
                $.each(response, function(key, value){
                  $("#edit_id").val(value["id"]);
                  $("#edit_name").val(value["nameIs"]);
                  $("#edit_gender").val(value["genderIs"]);
                  $("#edit_contact").val(value["contactIs"]);
                  $("#edit_dob").val(value["dobIs"]);
                  $("#edit_altcontact").val(value["altContactIs"]);
                  $("#edit_email").val(value["emailIs"]);
                  $("#edit_pass").val(value["passIs"]);
                  $("#edit_address").val(value["addressIs"]);
                  $("#edit_city").val(value["cityIs"]);
                  $("#edit_state").val(value["stateIs"]);
                  $("#edit_pin").val(value["pinIs"]);
                  $("#edit_subjects").val(value["subjectIs"]);
                  $("#edit_experience").val(value["expIs"]);
                  $("#edit_quali").val(value["qualificationIs"]);
                  $("#edit_certi").val(value["certificationCourseIs"]);
                  $("#edit_procourse").val(value["professionalCourseIs"]);
                  $("#edit_tuition").val(value["tuitionServiceIs"]);
                  $("#edit_verification").val(value["verifyIs"]);
                 
                });
                $("#editTeacherModal").modal("show");
              }
            });
          });
          $(".delete_btn").click(function (e){
            e.preventDefault();
            var teacher_id = $(this).closest("tr").find(".teacher_id").text();
            $("#delete_id").val(teacher_id);
            $("#deleteTeacherModal").modal("show");
          });
        });
        </script>
        <script>
        function search_data(){
          var search=jQuery("#search").val();
          if(search!="")
          {
            jQuery.ajax({
              method:"POST",
              url:"teacherview.php",
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