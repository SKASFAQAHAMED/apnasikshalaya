<?php
include_once("../sn/con.php");
session_start();
if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
  $user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
  $pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
} elseif (isset($_POST['user']) && isset($_POST['pass'])) {
  $user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));
  $pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
} else {
  header('Location: login.php?error=user');
  exit();
}
$sql = "SELECT * FROM admin_users WHERE BINARY Adminname = ? AND BINARY Adminpass = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows() != 1) {
  header('Location: login.php?error=user');
  exit();
} else {
  $stmt->bind_result($adminId, $adminName, $adminPass, $adminRole, $adminExtra, $adminrealname, $adminRoleName);
  $stmt->fetch();
  $_SESSION['name'] = $adminrealname;
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
    
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
<link rel="stylesheet" href="./css/super-admin.css">
<title>All Content Change | ApnaAdmin</title>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row main">
      <div class="col-md-2 col-lg-2 ss" style="padding-right: 0;">
        <div class="side-bar square scrollbar-dusty-grass square thin">
          <div class="row side-pro">
            <div class="nu col-md-12 col-lg-12">
                <h2><b>' . $adminrealname . '</b></h2>
                <h4>'.$adminRoleName.'</h4>
                <p>Last Logged in:<i>09-sep-2021 05:37 PM</i></p>
            </div>
          </div>
          <a href="./dashboard.php"><div class="dash-board row">Dashboard</div></a>
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
      
      <div class="col-md-10 col-lg-10">
        <div class="dash">
          <div class="row nav" style="margin-left:0;">
              <div class="menu">
                <div type="button" style="width:30px;display:flex; flex-direction:;" id="side-bar-btn" >
                  <span type="button" style="width:30px;" id="side-bar-btn">
                    <i class="fa fa-bars"></i>
                  </span>
                  <span><b>Apnasikshalaya</b></span>
                </div>
                <a class="logout" style="float:right;" href="./logout.php"><button>Logout</button></a>
              </div>
          </div>
          ';
if (isset($_POST['action'])) {
$action = mysqli_real_escape_string($con, htmlspecialchars($_POST['action'], ENT_QUOTES));
} elseif (isset($_GET['action'])) {
$action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
} else {
$action = null;
}
   if (($adminRole == 1) && ($action === "view")) {
      echo '
      <div class="row all_change">
<div class="col-md-8">
        
    
      <div class="card col-md-6">
      <a href="./allcontentchange.php?action=home_edit">
          <div class="card-body">
        
              <button class="btn btn-primary" style="width: 100%;">Chnage content of the home page</button> 
          </div>
          </a>
       </div>
      
       <div class="card col-md-6">
       <a href="./allcontentchange.php?action=terms_edit">
          <div class="card-body">
              <button class="btn btn-primary" style="width: 100%;">Add Terms and Condition</button>
          </div>
          </a> 
          
       </div> 
  
        <div class="card col-md-6">
        <a href="./termspolicyedit.php?action=terms_edit_all">
          <div class="card-body">
           
              <button class="btn btn-primary" style="width: 100%;">Edit Terms and Condition</button>
          </div>
          </a> 
        </div>
       <div class="card col-md-6">
       <a href="./allcontentchange.php?action=popup">
          <div class="card-body">
         
              <button class="btn btn-primary" style="width: 100%;">Add/Edit POP-UP</button>
          </div>
          </a> 
        </div>
        </div>
        <div class="col-md-4"><br><br><br>
        <div class="card col-md-12">
        <a href="./images/guide.png" target="_blank" role="button" aria-pressed="true" style="display:flex; justify-content: center; align-items: center;">
        <div class="card-body">
              <button class="btn btn-primary" style="width: 100%;">Download homepage Guide picture</button>
          </div>
          </a>
        </div>
        </div>
        </div>
        ';
   }
   if(!empty($_GET['file']))
{
	$filename = basename($_GET['file']);
	$filepath = './images/' . $filename;
	if(!empty($filename) && file_exists($filepath)){
//Define Headers
		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");
      echo'<img src="'.$filepath.'" alt="'.$filename.'" width="100%"/>';		
      ;
		exit;
	}
	else{
		echo "This File Does not exist.";
	}
}
   if ($action === "home_edit") {
      echo '
<form action ="allcontentchange.php?action=homepageupload" method="POST" enctype="multipart/form-data">';
      $show = "show";
      $sql = "SELECT * FROM apnaHomepage WHERE extra=?";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("s", $show);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($id, $topHeading, $topImage, $midHeading, $midContent, $midImage, $card1Heading, $card1Content, $card2Heading, $card2Content, $card3Heading, $card3Content, $card4Heading, $card4Content, $card5Heading, $card5Content, $card6Heading, $card6Content, $card7Heading, $card7Content, $teacher1, $teacher2, $teacher3, $teacher4, $courseHeading, $courseContent, $course1, $course2, $course3, $course4, $extra);
      $stmt->fetch();
      echo '
<input type="hidden" id="Id" name="id" value="' . $id . '">
<div class = "form-group">
   <label for="topHeading">Top Heading</label>
   <input type="text" name ="topHeading" id="edit_topHeading" class="form-control" value="' . $topHeading . '" placeholder="Please Enter the Top Heading">
</div>
<div class = "form-group">
   <label for="topImage">Top Image</label>
   <input type="file" name ="topImage" id="edit_topImage" class="form-control" value="' . $topImage . '" placeholder="Top Image">
</div>
<div class = "form-group">
   <label for="midHeading">Mid Heading</label>
   <input type="text" name ="midHeading" id="edit_midHeading" class="form-control" value="' . $midHeading . '" placeholder="Mid heading of the homepage">
</div>
<div class = "form-group">
   <label for="midContent">Mid Content</label>
   <input type="text" name ="midContent" id="edit_midContent" class="form-control" value="' . $midContent . '" placeholder="Mid-content of the homepage">
</div>
<div class = "form-group">
   <label for="midImage">Mid Image</label>
   <input type="file" accept = "image/*" name ="midImage" id="edit_midImage" class="form-control" value="' . $midImage . '" placeholder="Select an Image">
</div>
<div class = "form-group">
   <label for="card1Heading">card-1 Heading</label>
   <input type="text" name ="card1Heading" id="edit_card1Heading" class="form-control" value="' . $card1Heading . '" placeholder="Card heading of card 1">
</div>
<div class = "form-group">
   <label for="card1Content">card-1Content</label>
   <input type="text" name ="card1Content" id="edit_card1Content" class="form-control" value="' . $card1Content . '" placeholder="Card content of card 1">
</div>
<div class = "form-group">
   <label for="card2Heading">card-2 Heading</label>
   <input type="text" name ="card2Heading" id="edit_card2Heading" class="form-control" value="' . $card2Heading . '" placeholder="Card heading of card 2 ">
</div>
<div class = "form-group">
   <label for="card2Content">card-2Content</label>
   <input type="text" name ="card2Content" id="edit_card2Content" class="form-control" value="' . $card2Content . '" placeholder="Card content of card 2">
</div>
<div class = "form-group">
   <label for="card3Heading">card-3Heading</label>
   <input type="text" name ="card3Heading" id="edit_card3Heading" class="form-control" value="' . $card3Heading . '" placeholder="Card heading of card 3">
</div>
<div class = "form-group">
   <label for="card3Content">card-3Content</label>
   <input type="text" name ="card3Content" id="edit_card3Content" class="form-control" value="' . $card3Content . '" placeholder="Card content of card 3">
</div>
<div class = "form-group">
   <label for="card4Heading">card-4Heading</label>
   <input type="text" name ="card4Heading" id="edit_card4Heading" class="form-control" value="' . $card4Heading . '" placeholder="Card heading of card 4">
</div>
<div class = "form-group">
   <label for="card4Content">card-4Content</label>
   <input type="text" name ="card4Content" id="edit_card4Content" class="form-control" value="' . $card4Content . '" placeholder="Card content of card 4">
</div>
<div class = "form-group">
   <label for="card5Heading">card-5Heading</label>
   <input type="text" name ="card5Heading" id="edit_card5Heading" class="form-control" value="' . $card5Heading . '" placeholder="Card heading of card 5">
</div>
<div class = "form-group">
   <label for="card5Content">card-5Content</label>
   <input type="text" name ="card5Content" id="edit_card5Content" class="form-control" value="' . $card5Content . '" placeholder="Card content of card 5">
</div>
<div class = "form-group">
   <label for="card6Heading">card-6Heading</label>
   <input type="text" name ="card6Heading" id="edit_card6Heading" class="form-control" value="' . $card6Heading . '" placeholder="Card heading of card 6">
</div>
<div class = "form-group">
   <label for="card6Content">card-6Content</label>
   <input type="text" name ="card6Content" id="edit_card6Content" class="form-control" value="' . $card6Content . '" placeholder="Card content of card 6">
</div>
<div class = "form-group">
   <label for="card7Heading">card-7Heading</label>
   <input type="text" name ="card7Heading" id="edit_card7Heading" class="form-control" value="' . $card7Heading . '" placeholder="Card heading of card 7">
</div>
<div class = "form-group">
   <label for="card7Content">card-7Content</label>
   <input type="text" name ="card7Content" id="edit_card7Content" class="form-control" value="' . $card7Content . '" placeholder="Card content of card 7">
</div>
<div class = "form-group">
   <label for="teacher1">Teacher 1</label>
   <input type="search" list="dtlist1" name ="teacher1" id="edit_teacher1" class="form-control" value="' . $teacher1 . '" placeholder="Teacher 1">';
      $sql = "SELECT nameIs FROM apnaTeachers WHERE extra='show'";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="dtlist1"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['nameIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
<div class = "form-group">
   <label for="teacher2">Teacher 2</label>
   <input type="search" list="dtlist2" name ="teacher2" id="edit_teacher2" class="form-control" value="' . $teacher2 . '" placeholder="Teacher 2">';
      $sql = "SELECT nameIs FROM apnaTeachers WHERE extra='show'";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="dtlist2"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['nameIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
<div class = "form-group">
   <label for="teacher3">Teacher 3</label>
   <input type="search" list="dtlist3" name ="teacher3" id="edit_teacher3" class="form-control" value="' . $teacher3 . '" placeholder="Teacher 3">';
      $sql = "SELECT nameIs FROM apnaTeachers WHERE extra='show'";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="dtlist3"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['nameIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
<div class = "form-group">
   <label for="teacher4">Teacher 4</label>
   <input type="search" list="dtlist4" name ="teacher4" id="edit_teacher4" class="form-control" value="' . $teacher4 . '" placeholder="teacher 4">';
      $sql = "SELECT nameIs FROM apnaTeachers WHERE extra='show'";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="dtlist4"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['nameIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
<div class = "form-group">
   <label for="courseHeading">Course heading</label>
   <input type="text" name ="courseHeading" id="edit_courseHeading" class="form-control" value="' . $courseHeading . '" placeholder="Course Heading">
</div>
<div class = "form-group">
   <label for="courseContent">course Content</label>
   <input type="text" name ="courseContent" id="edit_courseContent" class="form-control" value="' . $courseContent . '" placeholder="Enter the Course content">
</div>
<div class = "form-group">
   <label for="course1">Course 1</label>
   <input type="search" list="clist1" name ="course1" id="edit_course1" class="form-control" value="' . $course1 . '" placeholder="course 1">';
      $sql = "SELECT titleIs FROM apnaCourses";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="clist1"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['titleIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
<div class = "form-group">
   <label for="course2">Course 2</label>
   <input type="search" list="clist2" name ="course2" id="edit_course2" class="form-control" value="' . $course2 . '" placeholder="course 2">';
      $sql = "SELECT titleIs FROM apnaCourses";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="clist2"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['titleIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
<div class = "form-group">
   <label for="course3">Course 3</label>
   <input type="search" list="clist3" name ="course3" id="edit_course3" class="form-control" value="' . $course3 . '" placeholder="course 3">';
      $sql = "SELECT titleIs FROM apnaCourses";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="clist3"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['titleIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
<div class = "form-group">
   <label for="course4">Course 4</label>
   <input type="search" list="clist4" name ="course4" id="edit_course4" class="form-control" value="' . $course4 . '" placeholder="course 4">';
      $sql = "SELECT titleIs FROM apnaCourses";
      $result = mysqli_query($con, $sql);
      echo ' <datalist id="clist4"> ';
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         echo '<option value="' . $row['titleIs'] . '"></option>';
      }
      echo ' </datalist> ';
      echo '
</div>
 <button type="submit" name ="update_student" class="btn btn-primary">Update</button>
</form>
';
   } elseif ($action === "homepageupload") {
      $id = 1;
      $topHeading = $_POST['topHeading'];
      $midHeading = $_POST['midHeading'];
      $midContent = $_POST['midContent'];
      $card1Heading = $_POST['card1Heading'];
      $card1Content = $_POST['card1Content'];
      $card2Heading = $_POST['card2Heading'];
      $card2Content = $_POST['card2Content'];
      $card3Heading = $_POST['card3Heading'];
      $card3Content = $_POST['card3Content'];
      $card4Heading = $_POST['card4Heading'];
      $card4Content = $_POST['card4Content'];
      $card5Heading = $_POST['card5Heading'];
      $card5Content = $_POST['card5Content'];
      $card6Heading = $_POST['card6Heading'];
      $card6Content = $_POST['card6Content'];
      $card7Heading = $_POST['card7Heading'];
      $card7Content = $_POST['card7Content'];
      $teacher1 = $_POST['teacher1'];
      $teacher2 = $_POST['teacher2'];
      $teacher3 = $_POST['teacher3'];
      $teacher4 = $_POST['teacher4'];
      $courseHeading = $_POST['courseHeading'];
      $courseContent = $_POST['courseContent'];
      $course1 = $_POST['course1'];
      $course2 = $_POST['course2'];
      $course3 = $_POST['course3'];
      $course4 = $_POST['course4'];
      $topImage = strtolower($_FILES['topImage']['name']);
      $midImage = strtolower($_FILES['midImage']['name']);
      $file_tmploc_topImage = $_FILES['topImage']['tmp_name'];
      $file_tmploc_midImage = $_FILES['midImage']['tmp_name'];
      $topImage = $id . $topImage;
      $midImage = $id . $midImage;
      $location_topImage = "./homepageimgs/" . $topImage;
      $location_midImage = "./homepageimgs/" . $midImage;
      if ($_FILES['topImage']['name'] != NULL && $_FILES['midImage']['name'] != NULL) {
         move_uploaded_file($file_tmploc_topImage, $location_topImage);
         move_uploaded_file($file_tmploc_midImage, $location_midImage);
         $sql = "UPDATE apnaHomepage SET topHeading = ?, topImage = ?, midHeading = ?, midContent = ?, midImage = ?, card1Heading = ?, card1Content = ?,  card2Heading = ?, card2Content = ?, card3Heading = ?, card3Content = ?, card4Heading = ?, card4Content = ?, card5Heading = ?, card5Content = ?, card6Heading = ?, card6Content = ?, card7Heading = ?, card7Content = ?, teacher1 = ?, teacher2 = ?, teacher3 = ?, teacher4 = ?, courseHeading = ?, courseContent = ?, course1 = ?, course2 = ?, course3 = ?, course4 = ?  WHERE id = ?";
         $updateStatement = mysqli_prepare($con, $sql);
         mysqli_stmt_bind_param($updateStatement, 'sssssssssssssssssssssssssssssi', $topHeading, $topImage, $midHeading, $midContent, $midImage, $card1Heading, $card1Content, $card2Heading, $card2Content, $card3Heading, $card3Content, $card4Heading, $card4Content, $card5Heading, $card5Content, $card6Heading, $card6Content, $card7Heading, $card7Content, $teacher1, $teacher2, $teacher3, $teacher4, $courseHeading, $courseContent, $course1, $course2, $course3, $course4, $id);
      } elseif ($_FILES['topImage']['name'] != NULL && $_FILES['midImage']['name'] == NULL) {
         move_uploaded_file($file_tmploc_topImage, $location_topImage);
         $sql = "UPDATE apnaHomepage SET topHeading = ?, topImage = ?, midHeading = ?, midContent = ?, card1Heading = ?, card1Content = ?,  card2Heading = ?, card2Content = ?, card3Heading = ?, card3Content = ?, card4Heading = ?, card4Content = ?, card5Heading = ?, card5Content = ?, card6Heading = ?, card6Content = ?, card7Heading = ?, card7Content = ?, teacher1 = ?, teacher2 = ?, teacher3 = ?, teacher4 = ?, courseHeading = ?, courseContent = ?, course1 = ?, course2 = ?, course3 = ?, course4 = ?  WHERE id = ?";
         $updateStatement = mysqli_prepare($con, $sql);
         mysqli_stmt_bind_param($updateStatement, 'ssssssssssssssssssssssssssssi', $topHeading, $topImage, $midHeading, $midContent, $card1Heading, $card1Content, $card2Heading, $card2Content, $card3Heading, $card3Content, $card4Heading, $card4Content, $card5Heading, $card5Content, $card6Heading, $card6Content, $card7Heading, $card7Content, $teacher1, $teacher2, $teacher3, $teacher4, $courseHeading, $courseContent, $course1, $course2, $course3, $course4, $id);
      } elseif ($_FILES['topImage']['name'] == NULL && $_FILES['midImage']['name'] != NULL) {
         move_uploaded_file($file_tmploc_midImage, $location_midImage);
         $sql = "UPDATE apnaHomepage SET topHeading = ?, midHeading = ?, midContent = ?, midImage = ?, card1Heading = ?, card1Content = ?,  card2Heading = ?, card2Content = ?, card3Heading = ?, card3Content = ?, card4Heading = ?, card4Content = ?, card5Heading = ?, card5Content = ?, card6Heading = ?, card6Content = ?, card7Heading = ?, card7Content = ?, teacher1 = ?, teacher2 = ?, teacher3 = ?, teacher4 = ?, courseHeading = ?, courseContent = ?, course1 = ?, course2 = ?, course3 = ?, course4 = ?  WHERE id = ?";
         $updateStatement = mysqli_prepare($con, $sql);
         mysqli_stmt_bind_param($updateStatement, 'ssssssssssssssssssssssssssssi', $topHeading, $midHeading, $midContent, $midImage, $card1Heading, $card1Content, $card2Heading, $card2Content, $card3Heading, $card3Content, $card4Heading, $card4Content, $card5Heading, $card5Content, $card6Heading, $card6Content, $card7Heading, $card7Content, $teacher1, $teacher2, $teacher3, $teacher4, $courseHeading, $courseContent, $course1, $course2, $course3, $course4, $id);
      } elseif ($_FILES['topImage']['name'] == NULL && $_FILES['midImage']['name'] == NULL) {
         $sql = "UPDATE apnaHomepage SET topHeading = ?, midHeading = ?, midContent = ?,  card1Heading = ?, card1Content = ?,  card2Heading = ?, card2Content = ?, card3Heading = ?, card3Content = ?, card4Heading = ?, card4Content = ?, card5Heading = ?, card5Content = ?, card6Heading = ?, card6Content = ?, card7Heading = ?, card7Content = ?, teacher1 = ?, teacher2 = ?, teacher3 = ?, teacher4 = ?, courseHeading = ?, courseContent = ?, course1 = ?, course2 = ?, course3 = ?, course4 = ?  WHERE id = ?";
         $updateStatement = mysqli_prepare($con, $sql);
         mysqli_stmt_bind_param($updateStatement, 'sssssssssssssssssssssssssssi', $topHeading, $midHeading, $midContent,  $card1Heading, $card1Content, $card2Heading, $card2Content, $card3Heading, $card3Content, $card4Heading, $card4Content, $card5Heading, $card5Content, $card6Heading, $card6Content, $card7Heading, $card7Content, $teacher1, $teacher2, $teacher3, $teacher4, $courseHeading, $courseContent, $course1, $course2, $course3, $course4, $id);
      }
      if (mysqli_stmt_execute($updateStatement)) {
         header('Location: ./allcontentchange.php?action=view');
      } else {
         echo 'error';
      }
   } elseif ($action === "popup") {
      echo ' 
         <form action="popup.php" method="POST" enctype="multipart/form-data">
         <div class="form-group">
           <label for="popupcontent">POP-UPs Text content if any</label>
           <textarea type="text" class="form-control" name="popupcontent" placeholder="Enter Seconds" rows="10" cols="40" ></textarea>
         </div>
         <div class="form-group">
           <label for="poptime">POP-UPs Time after which the pop-up will appear (only numbers)</label>
           <input type="text" class="form-control" name="poptime" placeholder="Enter Seconds">
         </div>
         <div class="form-group">
           <label for="popimg">POP-IMAGE (SELECT)</label>
           <input type="file" class="form-control" name="popimg" placeholder="select a pop-up image" required>
         </div>
         <button type="submit" class="btn btn-primary" name="pupup_upload">Submit</button>
       </form>
       
       ';
   } elseif ($action == "terms_edit") {
      
      echo ' 
         <form action="termsedit.php" method="POST" >
<div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-8">
            <h1 class="h2 mb-4"> Terms or Privacy & policy (Insert)</h1>
            <label for="type">Please Select a type</label>
            <select name="type" class="form-select" aria-label="Default select example">
               <option value="User Guidelines">User Guidelines</option>
               <option value="privacy and policies">privacy and policies</option>
               <option value="Terms and Condition">Terms and Condition</option>
               <option value="Refund Policy">Refund Policy</option>
            </select>
            <div class="form-group">
                <label for="heading">Please type in a a heading</label>';
                echo'
                <input type="text" class="form-control" name="heading" placeholder="Your heading" value=';  echo'>
            </div>
            <div class="form-group">
              <label for="content">Please type in your Content</label>
              <textarea type="text" class="form-control" name="content" rows="10" cols="50" placeholder="Enter Content"></textarea>
            </div>
            
            <hr>
            <button type="submit" class="btn btn-primary" name="terms_upload">Submit</button>
        </div>
    </div>
</div>
       </form>
       ';
   }elseif ($action == "terms_edit_all"){
      ////starting
      echo'
      <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">Select Type and get bellow Related Content</div>
      <div class="panel-body">
            <div class="form-group">
                <label for="title">Select Type:</label>
                <select name="type" class="form-control">
                    <option value="">--- Select Type (privacy or policy) ---</option>
                    ';
                    $show="valid";
                    $sql = "SELECT DISTINCT typeIs FROM apnaTermsPrivacy WHERE extra = ?;";
                    $stmt = $con->stmt_init();
                    $stmt->prepare($sql);
                    $stmt->bind_param("s", $show);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($type);
                    while ($stmt->fetch()) {
                            echo "<option value='".$type."'>".$type."</option>";
                        }
                        echo'
                </select>
            </div>
            <div class="form-group">
                <label for="title">Select heading:</label>
                <select name="heading" class="form-control" style="width:350px">
                </select>
            </div>
      </div>
    </div>
</div>';
      ////ending
   }
}
?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
   
      let btn = document.querySelector("#side-bar-btn");
      let sideBar = document.querySelector(".ss");
      btn.onclick = function(){
        sideBar.classList.toggle("active");
      }
    </script>
</html>
