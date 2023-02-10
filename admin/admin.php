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
  <title>Set Admin | ApnaAdmin</title>
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
  if ($action === "input") {
    echo '
    <div class="card">
        <h2>Add Admin account </h2><br>
        <h3><p>With great power comes great responsibility</p></h3>
       
       <form action="admin.php" method="POST">
        <input type="hidden" name="action" value="upload">
        <div class="input-border">
         <input type="text" class="text" name="name" required placeholder="Name of the Admin">
         <label>Name of the Admin</label>
         <div class="border"></div>
        </div>
        <div class="input-border">
         <input type="text" class="text" name="username" required placeholder="Username of the Admin">
         <label>Username of the Admin</label>
         <div class="border"></div>
        </div>
        
        <div class="input-border">
         <input type="password" class="text" name="password" required placeholder="Please Choose a Password">
         <label>Password</label>
         <div class="border"></div>
        </div>
        <select class="input-border" name="role" required>
            <option value="1">Super Admin</option>
            <option value="2">Admin</option>
            <option value="3">Edtor</option>
            <option value="4">Explorer</option>
            <option value="5">Blogger</option>
        </select>
        
        <input type="submit" class="btn" value="Submit" style="cursor: pointer;">
       </form>
        
       </div>
';
  } elseif ($action === "upload") {
    $user = mysqli_real_escape_string($con, htmlspecialchars($_POST['username'], ENT_QUOTES));
    $pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['password'], ENT_QUOTES));
    $role = mysqli_real_escape_string($con, htmlspecialchars($_POST['role'], ENT_QUOTES));
    $name = mysqli_real_escape_string($con, htmlspecialchars($_POST['name'], ENT_QUOTES));
    $one = 1;
    if ($role == 1) {
      $roleName = "Super Admin";
    } elseif ($role == 2) {
      $roleName = "Admin";
    } elseif ($role == 2) {
      $roleName = "Editor";
    } elseif ($role == 2) {
      $roleName = "Explorer";
    } else {
      $roleName = "Blogger";
    }
    $sql2 = "INSERT INTO  admin_users (Adminname, Adminpass, Adminrole, extra, AdminRealName, AdminroleName) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("ssiiss", $user, $pass, $role, $one, $name, $roleName);
    $stmt2->execute();
    header('Location: /admin/admin?action=view&status=success');
    exit();
  } elseif ($action === "view") {
    echo '
        <div class="modal fade" id="editadminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editadminModal">Admin Details (Update/Edit)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action ="adminedit.php" method="POST">
           <div class="modal-body">
              <input type="hidden" name ="Eid" id="edit_id">
              <div class = "form-group">
                  <label for="Ename">Name</label>
                  <input type="text" name ="Ename" id="edit_name" class="form-control" placeholder="Name">
              </div>
             <div class = "form-group">
                <label for="Role">Select Role</label>
                <select name ="Erole" id="edit_role" class="form-control">
                  <option value="1">Super Admin</option>
                  <option value="2">Admin</option>
                  <option value="3">Editor</option>
                  <option value="4">Explorer</option>
                  <option value="5">Blogger</option>
                </select>
             </div>
             <div class = "form-group">
                <label for="EUsername">Change Username</label>
                <input type="text" name ="EUsername" id="edit_username" class="form-control" placeholder="Enter new Username">
             </div>
             <div class = "form-group">
                <label for="Epass">Change Password</label>
                <input type="text" name ="Epass" id="edit_pass" class="form-control" placeholder="Enter a Password">
             </div>
             
           </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name ="update_admin" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
        </div>
      </div>
      
<div class="modal fade" id="deleteadminModal" tabindex="-1" role="dialog" aria-labelledby="deleteadminModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="deleteadminModallabel">Student Details (Delete)</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form action = "adminedit.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="admin_u" id="delete_id">
        <div>
                <h2>Are you sure you want to delete this Admin from database?!</h2>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-danger" name="delete_admin">Delete!</button>
    </form>
    
  </div>
</div>
</div>
</div>
<div class="panel panel-default" style="margin-left:30px;">
  <!-- Default panel contents -->
  <div class="panel-heading">List of Admins</div>
  <table class="table">
    <tr> <th>#</th>
        <th>Username</th>
        <th>Name</th>
        <th>Role</th>
        <th style="text-align:center;">Edit</th>
        <th style="text-align:center;">Delete</th>
    </tr>';
    $one = 1;
    $sql3 = "SELECT * FROM admin_users WHERE extra = ?;";
    $stmt3 = $con->stmt_init();
    $stmt3->prepare($sql3);
    $stmt3->bind_param("i", $one);
    $stmt3->execute();
    $stmt3->store_result();
    $slno = 1;
    $stmt3->bind_result($id, $username, $password,  $role, $extra, $name, $roleName);
    while ($stmt3->fetch()) {
      echo '<tr>
            <td>' . $slno . '</td>
            <td class = "username">' . $username . '</td>
            <td>' . $name . '</td>
            <td>';
      if ($role == 1) {
        echo 'Super Admin';
      } elseif ($role == 2) {
        echo 'Admin';
      } elseif ($role == 3) {
        echo 'Editor';
      } elseif ($role == 4) {
        echo 'Explorer';
      } elseif ($role == 5) {
        echo 'Blogger';
      }
      echo '</td>
            <td style="text-align:center;"><a href="#" class =" bg bg-info edit_btn"><i class="fas fa-edit"></i></a></td>
            <td style="text-align:center; color:red;"><a href="#" class =" bg bg-danger delete_btn"><i class="fas fa-trash-alt"></i></a></td>
        </tr>';
      $slno++;
    }
    echo '</table>
        </div>';
  } else {
    header('Location: index.php');
    exit();
  }
} ?>
</div>
</div>

<body>
  <!-- Bootstrap Bundle with Popper -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".edit_btn").click(function(e) {
        e.preventDefault();
        var username = $(this).closest("tr").find(".username").text();
        $.ajax({
          type: "POST",
          url: "adminedit.php",
          data: {
            "checking_edit_btn": true,
            "username": username,
          },
          success: function(response) {
            $.each(response, function(key, value) {
              $("#edit_id").val(value["id"]);
              $("#edit_username").val(value["Adminname"]);
              $("#edit_pass").val(value["Adminpass"]);
              $("#edit_role").val(value["Adminrole"]);
              $("#edit_name").val(value["AdminRealName"]);
            });
            $("#editadminModal").modal("show");
          }
        });
      });
      $(".delete_btn").click(function(e) {
        e.preventDefault();
        var admin_u = $(this).closest("tr").find(".username").text();
        $("#delete_id").val(admin_u);
        $("#deleteadminModal").modal("show");
      });
    });
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

  </html>