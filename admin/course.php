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
            <a href="./"> <div class="dash-board row">Dashboard</div></a>
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
<div class="col-md-10 col-lg-10" >
<div class="dash">

<div class="row nav" style="margin-left:0;">
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
    $title = mysqli_real_escape_string($con, htmlspecialchars($_POST['title'], ENT_QUOTES));
    $cata = mysqli_real_escape_string($con, htmlspecialchars($_POST['cata'], ENT_QUOTES));
    $subCata = mysqli_real_escape_string($con, htmlspecialchars($_POST['subCata'], ENT_QUOTES));
    $type = mysqli_real_escape_string($con, htmlspecialchars($_POST['type'], ENT_QUOTES));
    $sDesc = mysqli_real_escape_string($con, htmlspecialchars($_POST['sDesc'], ENT_QUOTES));
    $teacher = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
    $lang = mysqli_real_escape_string($con, htmlspecialchars($_POST['lang'], ENT_QUOTES));
    $price = mysqli_real_escape_string($con, htmlspecialchars($_POST['price'], ENT_QUOTES));
    $lDesc = mysqli_real_escape_string($con, htmlspecialchars($_POST['lDesc'], ENT_QUOTES));
    $preview = mysqli_real_escape_string($con, htmlspecialchars($_POST['preview'], ENT_QUOTES));
    $hours = mysqli_real_escape_string($con, htmlspecialchars($_POST['hours'], ENT_QUOTES));
    $chapters = mysqli_real_escape_string($con, htmlspecialchars($_POST['chapters'], ENT_QUOTES));
    $certificate = mysqli_real_escape_string($con, htmlspecialchars($_POST['certificate'], ENT_QUOTES));
    $bestFor = mysqli_real_escape_string($con, htmlspecialchars($_POST['bestFor'], ENT_QUOTES));
    $null = null;
    $sql3 = "SELECT id FROM apnaCourses WHERE title = ?;";
    $stmt3 = $con->stmt_init();
    $stmt3->prepare($sql3);
    $stmt3->bind_param("s", $title);
    $stmt3->execute();
    $stmt3->store_result();
    /*if($stmt3->num_rows() != 0) {
    	header("Location: course.php?action=view&status=error");
    	exit();
    }*/
    $ip = getenv("REMOTE_ADDR");
    $sql = "INSERT INTO apnaCourses (titleIs, cataIs, subCataIs, typeIs, sDescIs, teacherIs, langIs, priceIs, lDescIs, previewIs, hourIs, chapterIs, certificateIs, bestForIs, ipIs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $title, $cata, $subCata, $type, $sDesc, $teacher, $lang, $price, $lDesc, $preview, $hours, $chapters, $certificate, $bestFor, $ip);
    $stmt->execute();
    $id = $con->insert_id;
    $thumb = $_FILES['thumb'];
    if ($thumb['name'] != null) {
      $fileType = strtolower(pathinfo($thumb['name'], PATHINFO_EXTENSION));
      $fileName = 'coursethumb' . $id . "." . $fileType;
      $fileLocation = "./coursethumb/" . $fileName;
      move_uploaded_file($thumb["tmp_name"], $fileLocation);
      $sql2 = "UPDATE apnaCourses SET thumbIs = ? WHERE id = ?;";
      $stmt2 = $con->stmt_init();
      $stmt2->prepare($sql2);
      $stmt2->bind_param("si", $fileName, $id);
      $stmt2->execute();
    }
    header("Location: course.php?action=view&status=success");
    exit();
  } elseif ($action === "video") {
    $id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
    echo '<form enctype="multipart/form-data" method="POST" action="course.php">
		<input name="action" value="videoupload" type="hidden">
		<input name="id" value="' . $id . '" type="hidden">
		<label>Title: </label>
			<input type="text" name="title" placeholder="Enter title of the video" required="">
		
		<label>Description: </label>
			<textarea name="desc" placeholder="Enter description of the video" required=""></textarea>
		
		<label>Content: </label>
    <textarea name="content" placeholder="Enter contents of the video" required=""></textarea>
		
		<label>Section: </label>
			<input name="section" type="number" placeholder="Enter Section" required="" min="0">
		<label>Upload video file: </label>
			<input accept="video/*" name="video" type="file" placeholder="Select the video">
		
		<label>Video link:</label>
			<input type="link" name="videolink" placeholder="Enter video link">
		
		<label>Upload reference file: </label>
			<input name="file" type="file" placeholder="Select the file">
		
		<button type="submit">Submit</button>
	</form>';
  } elseif ($action === "videoupload") {
    $show = "show";
    $id = mysqli_real_escape_string($con, htmlspecialchars($_POST['id'], ENT_QUOTES));
    $title = mysqli_real_escape_string($con, htmlspecialchars($_POST['title'], ENT_QUOTES));
    $content = mysqli_real_escape_string($con, htmlspecialchars($_POST['content'], ENT_QUOTES));
    $section = mysqli_real_escape_string($con, htmlspecialchars($_POST['section'], ENT_QUOTES));
    $desc = mysqli_real_escape_string($con, htmlspecialchars($_POST['desc'], ENT_QUOTES));
    $videolink = mysqli_real_escape_string($con, htmlspecialchars($_POST['videolink'], ENT_QUOTES));
    $sql3 = "SELECT id FROM apnaVideos WHERE courseId = ? && sectionIs = ?;";
    $stmt3 = $con->stmt_init();
    $stmt3->prepare($sql3);
    $stmt3->bind_param("is", $id, $section);
    $stmt3->execute();
    $stmt3->store_result();
    $videoNo = $stmt3->num_rows() + 1;
    $sql = "INSERT INTO apnaVideos (courseId, titleIs, contentIs, sectionIs, videoNo, videoLinkIs, descIs, verifyIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("isssissss", $id, $title, $content, $section, $videoNo, $videolink, $desc, $show, $show);
    $stmt->execute();
    $id = $con->insert_id;
    $thumb = $_FILES['video'];
    $file = $_FILES['file'];
    if ($thumb['name'] != null) {
      $fileType = strtolower(pathinfo($thumb['name'], PATHINFO_EXTENSION));
      $fileName = 'coursevideo' . $id . "." . $fileType;
      $fileLocation = "./coursevideo/" . $fileName;
      move_uploaded_file($thumb["tmp_name"], $fileLocation);
      $sql2 = "UPDATE apnaVideos SET videoIs = ? WHERE id = ?;";
      $stmt2 = $con->stmt_init();
      $stmt2->prepare($sql2);
      $stmt2->bind_param("si", $fileName, $id);
      $stmt2->execute();
    }
    if ($file['name'] != null) {
      $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $fileName = 'coursefile' . $id . "." . $fileType;
      $fileLocation = "./coursefile/" . $fileName;
      move_uploaded_file($file["tmp_name"], $fileLocation);
      $sql2 = "UPDATE apnaVideos SET fileIs = ? WHERE id = ?;";
      $stmt2 = $con->stmt_init();
      $stmt2->prepare($sql2);
      $stmt2->bind_param("si", $fileName, $id);
      $stmt2->execute();
    }
    header("Location: course.php?action=view&status=success");
    exit();
  } elseif ($action === "view") {
    echo '
     <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCourseModallabel">Teacher Details (Update/Edit)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action ="courseview.php" method="POST" enctype="multipart/form-data">
           <div class="modal-body">
              <input type="hidden" name ="Eid" id="edit_id">
              <div class = "form-group">
                  <label for="Etitle">Course Title</label>
                  <input type="text" name ="Etitle" id="edit_title" class="form-control" placeholder="add course title">
              </div>
             <div class = "form-group">
                <label for="Ecatagory">Catagory </label>
                <input type="text" name ="Ecatagory" id="edit_catagory" class="form-control" placeholder="Add catagory of course">
             </div>
             <div class = "form-group">
                <label for="EsubCata">Add Sub-Catagory </label>
                <input type="text" name ="EsubCata" id="edit_subCata" class="form-control" placeholder="Add sub catagory of course">
             </div>
             <div class = "form-group">
                <label for="Etype">Type</label>
                <input type="text" name ="Etype" id="edit_type" class="form-control" placeholder="Add course type">
             </div>
             <div class = "form-group">
                <label for="Esdesc">Short Description</label>
                <input type="text" name ="Esdesc" id="edit_sdesc" class="form-control" placeholder="Add course type">
             </div>
             <div class = "form-group">
                <label for="Eteacher">Teacher </label>
                <input type="text" name ="Eteacher" id="edit_teacher" class="form-control" placeholder="Add teacher">
             </div>
             <div class = "form-group">
                <label for="Elanguage">Language</label>
                <input type="text" name ="Elanguage" id="edit_language" class="form-control" placeholder="Language of course">
             </div>
             <div class = "form-group">
                <label for="Eprice">Price</label>
                <input type="text" name ="Eprice" id="edit_price" class="form-control" placeholder="price of the course">
             </div>
             <div class = "form-group">
                <label for="Eldesc">Long Description</label>
                <input type="text" name ="Eldesc" id="edit_ldesc" class="form-control" placeholder="Long Description">
             </div>
             <div class = "form-group">
                <label for="Epreview">Preview Link</label>
                <input type="text" name ="Epreview" id="edit_preview" class="form-control" placeholder="Preview link of the course">
             </div>
             <div class = "form-group">
                <label for="Ehours">Hours</label>
                <input type="text" name ="Ehours" id="edit_hours" class="form-control" placeholder="Hours long">
             </div>
             <div class = "form-group">
                <label for="Echapters">Chapters</label>
                <input type="number" name ="Echapters" id="edit_chapters" class="form-control" placeholder="no. of chapters">
             </div>
             <div class = "form-group">
                <label for="Ecertification">Certification terms</label>
                <input type="text" name ="Ecertification" id="edit_certification" class="form-control" placeholder="Certification terms">
             </div>
             <div class = "form-group">
                <label for="Ebest">Best for</label>
                <input type="text" name ="Ebest" id="edit_best" class="form-control" placeholder="Best for ">
                </div>
                <div class = "form-group">
                <label for="Ethumb">thumb</label>
                <input accept = "image/*" type="file" class="custom-file-input" id="customFile" name="thumbnail">
                <input type="text"  id="edit_thumb" class="form-control" placeholder="last thumbnail name" readonly>
             </div>
             
           </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name ="update_course" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
      </div>

 
<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModallabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="deleteteacherModallabel">Course (Delete)</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form action = "courseview.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="course_id" id="delete_id">
        <div>
                <h2>Are you sure you want to delete this course from database?!</h2>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-danger" name="delete_course">Delete!</button>
    </form>
    
  </div>
</div>
</div>
</div>

<!--<div class="panel panel-default">
<div class="container">
 <div><h2>Search Teacher name or course title </h2></div>
  <div>&nbsp;</div>
  <div class="form-group">
   <input type="text" name="search" id="search" placeholder="Search.." onkeyup="search_data();">
  </div>
  <div>&nbsp;</div>
  <div id="search_table">
  </div>
</div>
</div> -->


<div class="panel panel-default" style="margin-left:23px;">
  <!-- Default panel contents -->
  <div class="panel-heading">List of ' . $_GET["type"] . ' courses</div>
  <div class="panel-body">
  <div class="row">
    <div class="col-md-2">
    <form action="course.php?action=view" method="GET">
    <input type="hidden" name="action" value="view">
    <input type="hidden" name="type" value="' . $_GET["type"] . '">
    
    <!-- <label>Select Catagory:--> <select name="cata" required=""> 
    <option value="" selected disabled >Select Catagory</option>';
    $show = "show";
    if (isset($_GET['type']) && $_GET['type'] != null) {
      $type = $_GET['type'];
      $sql = "SELECT DISTINCT cataIs FROM apnaCourses WHERE typeIs = ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("s", $type);
    } else {
      $sql = "SELECT DISTINCT cataIs FROM apnaCourses;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cata);
    while ($stmt->fetch()) {
      if (urldecode($_GET['cata']) == $cata) {
        echo '<option value="' . $cata . '" selected="">' . $cata . '</option>';
      } else {
        echo '<option value="' . $cata . '">' . $cata . '</option>';
      }
    }
    echo '</select></label>
    <button class="btn btn-outline-dark" style="width:46%; margin:2px;" type="submit">Filter</button>';
    if ($_GET['fromDate'] != null && $_GET['toDate'] != null) {
      echo '<input type="hidden" name="fromDate" value="' . $_GET["fromDate"] . '">
        <input type="hidden" name="toDate" value="' . $_GET["toDate"] . '">
        <a class="btn btn-light" style="width:48%;padding:6px;margin:2px; float:right;" href="course.php?action=view&type=' . $_GET['type'] . '&fromDate=' . $_GET['fromDate'] . '&toDate=' . $_GET['toDate'] . '" style="margin-left: 12px;">Clear Filter</a>';
    } else {
      echo '<a class="btn btn-light" style="width:48%; padding:6px; margin:2px;" href="course.php?action=view&type=' . $_GET['type'] . '" style="margin-left: 12px;">Clear Filter</a>';
    }
    echo '</form></div><div class="col-md-4">
    <div class="row"><div class="col-md-8">
    <form action="course.php?action=view" method="GET">
    	<input type="hidden" name="action" value="view">
    	<input type="hidden" name="type" value="' . $_GET["type"] . '">
      <table>
      <tr>
      <td><label>From Date:</label>
      </td>
      <td>
      <input type="date" name="fromDate" max="' . date('Y-m-d') . '" value="' . $_GET['fromDate'] . '" required>
      </td>
      </tr>
      <tr>
      <td><label>To Date:</label></td><td><input type="date" name="toDate" max="' . date('Y-m-d') . '" value="' . $_GET['toDate'] . '" required></td></tr></table>
    	
    	 
    </div><div class="col-md-4">
    <table><tr><td>
      <button class="btn btn-outline-dark" style="width:100%;" type="submit">Filter</button>';
    if ($_GET['cata'] != null) {
      echo '<input type="hidden" name="cata" value="' . $_GET["cata"] . '"></td></tr><tr><td>
		<a class="btn btn-light" style="width:100%;" href="course.php?action=view&type=' . $_GET['type'] . '&cata=' . $_GET['cata'] . '" style="margin-left: 12px;">Clear Filter</a>';
    } else {
      echo '<a class="btn btn-light" style="width:100%;" href="course.php?action=view&type=' . $_GET['type'] . '" style="margin-left: 12px;">Clear Filter</a>';
    }
    echo '</td></tr></table></form></div></div></div><div class="col-md-3" style="float:right;margin-right:20px;">

    <button class="btn btn-primary" type="btn"><a href="course.php?action=input';
    if (isset($_GET['type'])) {
      echo '&type=' . $_GET['type'];
    }
    echo '" style="color: #fff;">Upload ' . $_GET["type"] . ' course</a></button>
    <form action="courseview.php" method="POST">
    <button type="submit" name="export_excel" class="btn btn-success">Dowload data (xlss format)</button>
    </form></div>

  </div>
  <table class="table">
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Catagory</th>
        <th>Sub-catagory</th>
        <th>Type</th>
        <th>Date</th>
        <th>Time</th>
        <th>Verification</th>
        <th style="text-align:center;">Operations</th>
        <th style="text-align:center;">View</th>
        <th style="text-align:center;">Edit</th>
        <th style="text-align:center;">Delete</th>
        <th style="text-align:center;">Upload Vedio</th>
    </tr>';
    if (isset($_GET['fromDate']) && $_GET['fromDate'] != null && isset($_GET['toDate']) && $_GET['toDate'] != null) {
      $fromDate = $_GET['fromDate'];
      $toDate = $_GET['toDate'];
    } else {
      $fromDate = '2000-01-01';
      $toDate = date('Y-m-d');
    }
    $show = "show";
    if ($_GET['type'] == "certification") {
      $type = "Certification";
      $sql = "SELECT * FROM apnaCourses WHERE extra = ? AND typeIs = ? AND SUBSTRING(dateTime, 1, 10) BETWEEN ? AND ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("ssss", $show, $type, $fromDate, $toDate);
    } elseif ($_GET['type'] == "professional") {
      $type = "Professional";
      $sql = "SELECT * FROM apnaCourses WHERE extra = ? AND typeIs = ? AND SUBSTRING(dateTime, 1, 10) BETWEEN ? AND ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("ssss", $show, $type, $fromDate, $toDate);
    } else {
      $sql = "SELECT * FROM apnaCourses WHERE extra = ? AND SUBSTRING(dateTime, 1, 10) BETWEEN ? AND ?;";
      $stmt = $con->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("sss", $show, $fromDate, $toDate);
    }
    $slno = 1;
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $title, $cata, $subCata, $type, $sDesc, $teacher, $lang, $price, $lDesc, $preview, $hours, $chapters, $certificate, $bestFor, $thumb, $ip, $dateTime, $extra);
    while ($stmt->fetch()) {
      if ($adminRole == 1 || $extra != 'hide') {
        if (!isset($_GET['cata']) || urldecode($_GET['cata']) == $cata) {
          echo '<tr>
            <td class = "course_id" style="display:none;">' . $id . '</td>
            <td>' . $slno . '</td>
            <td style="text-align:left;">' . $title . '</td>
            <td>' . $cata . '</td>
            <td>' . $subCata . '</td>
            <td>' . $type . '</td>
            <td>' . substr($dateTime, 0, 10) . '</td>
            <td>' . substr($dateTime, 10) . '</td>
            <td>';
          if ($extra == "show") {
            echo "Approved";
          } elseif ($extra == "hide") {
            echo "Rejected";
          } else {
            if ($adminRole == 1) {
              echo '<a href="course.php?action=approve&id=' . $id . '">Approve</a> / <a href="course.php?action=reject&id=' . $id . '">Reject</a>';
            } else {
              echo 'Not approved';
            }
          }
          echo '</td>
            <td style="text-align:center;"><a href="course_section.php?id=' . $id . '">Edit Content</a></td>
            <td style="text-align:center;"><a href="https://apnasikshalaya.com/course_preview?id=' . $id . '" target="_blank"><i class="fas fa-eye"></i></a></td>
            <td style="text-align:center;"><a href="#" class =" bg bg-info edit_btn"><i class="fas fa-edit"></i></a></td>
            <td style="text-align:center;"><a href="#" class =" bg bg-danger delete_btn"><i class="fas fa-trash-alt"></i></a></td>
            <td style="text-align:center;"><a href="course.php?action=video&id=' . $id . '" class =" bg bg-success"> Upload Video </a></td>';
          echo '</tr>';
          $slno++;
        }
      }
    }
    echo '</table>
        </div>';
  } elseif ($action === "input") {
    echo '<div style="width: 90%; overflow: hidden; margin: 24px auto;">';
    if ($_GET['status']) {
      if ($_GET['status'] == 'error') {
        echo '<div class="alert alert-danger" role="alert">This title already exists</div>';
      }
    }
    echo '</div>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading" style="100%; height:60px;" >
    <h4 style="float:left;">Upload ' . $_GET["type"] . ' courses </h4>
    <div style="float:right;">
    <a href="course.php?action=view" class="btn btn-primary" stlye="width:200px; color: #fff;">List of ' . $_GET["type"] . ' courses</a>
    </div>
  </div>
  <div class="panel-body">
    
  
      <form method="POST" action="course.php" style="padding:20px;margin: auto;" enctype="multipart/form-data">
        <input name="from" value="course" type="hidden">
        <input name="action" value="upload" type="hidden"> 
        <div class="row">
        <div class="col-12">';
    if ($_GET['type'] == "certification") {
      echo '<input type="hidden" name="type" value="certification">';
    } elseif ($_GET['type'] == "professional") {
      echo '<input type="hidden" name="type" value="professional">';
    } else {
      echo '<div class="form-group">
          <label for="type">Course Type: </label>
            <select class="form-control" id="type" placeholder="Enter course type" name="type" required="">
              <option value="Professional">Professional</option>
              <option value="Certification">Certification</option>
            </select>
        </div>';
    }
    echo '
           
              <div class="form-group">
                <label for="title">Title: </label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Enter course title" requried="">
              </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="cata">Course Catagory: </label>
                <input class="form-control" id="cata" list="cataList" placeholder="Enter course catagory" name="cata" required="">
                <datalist id="cataList">';
    $sql = "SELECT DISTINCT cataIs FROM apnaCourses WHERE extra = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("s", $show);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cata);
    while ($stmt->fetch()) {
      echo '<option value="' . $cata . '"></option>';
    }
    echo '</datalist>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="subcata">Sub Catagory: </label>
                <input class="form-control" list="subCataList" placeholder="Enter sub-catagory" name="subCata" id="subcata" required="">
                <datalist id="subCataList">';
    $sql2 = "SELECT DISTINCT subCataIs FROM apnaCourses WHERE extra = ?;";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("s", $show);
    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($subCata);
    while ($stmt2->fetch()) {
      echo '<option value="' . $subCata . '"></option>';
    }
    echo '</datalist>
            </div>
          </div>
         
        <div class="form-group">
          <label for="shortDesc">Short Description: </label>
          <input class="form-control" type="text" name="sDesc" id="shortDesc" placeholder="Enter short description">
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="teacher">Teacher Name: </label>
          <input class="form-control" id="teacher" list="teacherList" placeholder="Enter teacher name" name="teacher">
          <datalist id="teacherList">';
    $sql3 = "SELECT DISTINCT nameIs FROM apnaTeachers WHERE extra = ? && verifyIs = ?;";
    $stmt3 = $con->stmt_init();
    $stmt3->prepare($sql3);
    $stmt3->bind_param("ss", $show, $show);
    $stmt3->execute();
    $stmt3->store_result();
    $stmt3->bind_result($teacher);
    while ($stmt3->fetch()) {
      echo '<option value="' . $teacher . '"></option>';
    }
    echo '</datalist>
        </div>
        </div> 
        <div class="col-md-3">
        <div class="form-group">
          <label for="lang">Language: </label>
          <input class="form-control" id="lang" list="langList" placeholder="Enter Language" name="lang">
          <datalist id="langList">';
    $sql4 = "SELECT DISTINCT langIs FROM apnaCourses WHERE extra = ?;";
    $stmt4 = $con->stmt_init();
    $stmt4->prepare($sql4);
    $stmt4->bind_param("s", $show);
    $stmt4->execute();
    $stmt4->store_result();
    $stmt4->bind_result($lang);
    while ($stmt4->fetch()) {
      echo '<option value="' . $lang . '"></option>';
    }
    echo '</datalist>
          </div></div> 
          <div class="col-md-3">
        <div class="form-group">
          <label for="price">Price: </label>
          <input id="price" name="price" placeholder="Enter Price" type="number" class="form-control" min="0">
        </div>
        </div>
       
        <div class="form-group">
          <label for="longDesc">Long Description: </label>
          <textarea class="form-control" id="longDesc" name="lDesc" placeholder="Enter long description" rows="10" style="resize: vertical;"></textarea>
        </div>
        <div class="form-group">
          <label for="preview">Course Preview(Video): </label>
          <input class="form-control" id="preview" name="preview" placeholder="Course preview link" type="url">
        </div>
        <div class="col-md-3">
        <div class="form-group">
          <label for="hours">Course Duration(Hours): </label>
          <input class="form-control" id="hours" name="hours" placeholder="Number of hours" type="number" step="any">
        </div></div><div class="col-md-3">
        <div class="form-group">
          <label for="chapters">Course Chapters(Number): </label>
          <input class="form-control" id="chapters" name="chapters" placeholder="Number of chapters" type="number">
        </div></div><div class="col-md-3">
        <div class="form-group">
          <label for="thumb">Thumbnail(Image 16:9): </label>
          <input class="form-control" id="thumb" name="thumb" placeholder="Thumbnail" type="file" accept="image/*">
        </div></div><div class="col-md-3">
        <div class="form-group">
          <label for="bestFor">Best For: </label>
          <input class="form-control" id="bestFor" name="bestFor" placeholder="Most appropriate for">
        </div></div>
        <div class="form-group">
          <label for="certificate">Certification Terms: </label>
          <input class="form-control" id="certificate" name="certificate" placeholder="Certification Terms">
        </div>
        
        <button type="submit" class="btn btn-primary" style="width:100%;">Submit</button></div>
      </form>
  </div>
</div>
';
  } elseif ($action === "reject" && $adminRole == 1) {
    $id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
    $sql = "UPDATE apnaCourses SET extra = ? WHERE id = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("si", $hide, $id);
    $stmt->execute();
    header("Location: course.php?action=view&status=reject");
    exit();
  } elseif ($action === "approve" && $adminRole == 1) {
    $id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
    $sql = "UPDATE apnaCourses SET extra = ? WHERE id = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("si", $show, $id);
    $stmt->execute();
    header("Location: course.php?action=view&status=approve");
    exit();
  } else {
    header("Location: course.php?action=view&status=error");
    exit();
  }
}
echo '</div>
</div>
</body>'; ?>
<!-- Bootstrap Bundle with Popper -->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
/*--------------------- navbar Sctript start ----------------------------- */
      let btn = document.querySelector("#side-bar-btn");
      let sideBar = document.querySelector(".ss");

      btn.onclick = function(){
        sideBar.classList.toggle("active");
      }
/*--------------------- navbar Sctript End---------------------------- */
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
/*--------------------- For Searchbar Sctript start ----------------------------- */
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
/*--------------------- For Searchbar Sctript End ----------------------------- */
      </script>
</html>

