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
  <title>Manage Blogs | ApnaAdmin</title>
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
  $show = "show";
  $hide = "hide";
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
    echo ' 
  <div class="panel panel-default" style="margin-left:30px;">
  <h2>Upload BLOG picture and content</h2>
  <p>please select a specific image file and Add the content of your Blog post:</p>
  <form action = "blogview.php" method = "POST" enctype="multipart/form-data">
    <p>Image File:</p>
    <div class="custom-file mb-3">
      <input accept = "image/*" type="file" class="custom-file-input" id="customFile" name="Blogimage">
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    
    <p>Title of your Blog:</p>
    <input type="text" id="Title" name="Title">
    <p>Content of your Blog:</p>
    <textarea id="contentis" name="content" rows="8" cols="60"></textarea>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary" name="Blog_upload">Submit</button>
    </div>
  </form>
</div>



<!------------------------------------------------------The uploading ends here  ---------->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src ="./ckeditor/ckeditor.js"></script>
    <script>
    CKEDITOR.replace("contentis");
    </script>

    <script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
      </script>';
  } elseif ($action === "view") {
    echo '    
    
      <!------------------------------the content goes in here ------------------->
      <!------------------------------The Edit modal gioes in here ------------------->

      <div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBlogModallabel">Blog Details (Update/Edit)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action ="blogview.php" method="POST"  enctype="multipart/form-data">
         <div class="modal-body">
            <input type="hidden" name ="Eid" id="edit_id">
           <div class = "form-group">
              <label for="Etitle">please enter the title</label>
              <input type="text" name ="Etitle" id="edit_title" class="form-control" placeholder="please enter the title">
           </div>
           <div class = "form-group">
              <label for="Econtent">please enter the content</label>
              <input type="text" name ="Econtent" id="edit_content" class="form-control" placeholder="please enter the content">
           </div>
           <div class = "form-group">
              <label for="Eimage">Name of the current selected image is below</label>
              <input type="text" name ="Eimage" id="edit_image" class="form-control" placeholder="image" readonly>
              <input accept = "image/*" type="file" class="custom-file-input" id="customFile" name="Blogimage">
              <label class="custom-file-label" for="customFile">Choose a different file</label>
           </div>
           
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name ="update_blog" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      </div>
    </div>
    

      <!------------------------------the table which shows all the information about the blogs ------------------->
      <div class="modal fade" id="deleteBlogModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModallabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteBlogModallabel">Blog Details (Delete)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action = "blogview.php" method="POST">
            <div class="modal-body">
            <input type="hidden" name="blog_id" id="delete_id">
              <div>
                      <h2>Are you sure you want to delete this Blog from database?!</h2>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" name="delete_blog">Delete!</button>
          </form>
          
        </div>
      </div>
      </div>
      </div>
      <!------------------------------the table which shows all the information about the blogs ------------------->
       
<div class="panel panel-default" style="margin-left: 26px;">
<!-- Default panel contents -->
<div class="panel-heading">List of Blogs
</div>

<!--div class="panel-body">
  <p>Apna Sikshalaya Admin Panel</p>
</div-->
<table class="table table-striped w-auto">
  <tr>
      <th class="text-center"> No</th>
      <th class="text-center"> Image</th>
      <th class="text-center"> TITLE</th>
      <th class="text-center"> CONTENT</th>
      <th class="text-center"> View</th>
      <th class="text-center"> Edit</th>
      <th class="text-center"> Delete</th>
      
  </tr>';
    $show = "show";
    $i = 1;
    $sql = "SELECT * FROM apnaBlogs WHERE verifyIs = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("s", $show);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $title, $content, $createdat, $imageis, $verify, $keyword, $extra);
    while ($stmt->fetch()) {
      echo '<tr>
    	<td>' . $i . '</td>
          <td class = "blog_id" style="display:none;">' . $id . '</td>
          <td class = "stud_img"><a href="./blog-images/' . $imageis . '" target="_blank"><img width ="90" src = "./blog-images/' . $imageis . '"></a></td>
          <td>' . $title . '</td>
          <td>' . $content . '</td>
          
          <td style="text-align:center;">
          <a href="../single_blog?id=' . $id . '" target="_blank" class =" bg bg-primary view_btn"><i class="fas fa-eye"></i></a></td>
          <td style="text-align:center;"> <a class =" bg bg-info edit_btn"><i class="fas fa-edit"></i></a></td>
          <td style="text-align:center; color:red; text-decoration:none;"> <a class =" bg bg-danger delete_btn"><i class="fas fa-trash-alt"></i></a>
           </td>';
      $i++;
      echo '</tr>';
    }
    echo '</table>
      </div>';
  }
} ?>
<script>
  /*--------------------- navbar Sctript start ----------------------------- */
  let btn = document.querySelector("#side-bar-btn");
  let sideBar = document.querySelector(".ss");
  btn.onclick = function() {
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
</script>