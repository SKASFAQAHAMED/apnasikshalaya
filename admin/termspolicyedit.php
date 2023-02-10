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

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

<link rel="stylesheet" href="./css/super-admin.css">

<title>All Content Change | ApnaAdmin</title>
<style>
.btn-primary {
  width: 113px;
  color: #fff;
  background-color: #337ab7;
  border-color: #2e6da4;
}
p.contenteditor {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
}

.pandb {
  display: flex;
  justify-content: space-between;
}
div#contentdiv {
  display: block;
}
</style>

  </head>

  <body>

  <div class="container-fluid">

    <div class="row main">

      <div class="col-md-2 col-lg-2 ss" style="padding-right: 0;">

        <div class="side-bar square scrollbar-dusty-grass square thin">

          <div class="row side-pro">

            <div class="nu col-md-12 col-lg-12">

                <h1><b>' . $adminrealname . '</b></h1>

                <h4>'.$adminRoleName.'</h4>

                <p>Last Logged in:<i>09-sep-2021 05:37 PM</i></p>

            </div>

          </div>

          <div class="dash-board row"><a href="./dashboard.php">Dashboard</a></div>

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

      

      <div class="col-md-10 col-lg-10" style="padding-left: 0px;">

        <div class="dash">



          <div class="row nav">

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

    if ($action == "terms_edit_all"){
        ////starting
        echo'
        <p id="suc">Upload-Success</p>
        <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">Select Type and get bellow Related Content</div>
        <div class="panel-body">
              <div class="form-group">
                  <label for="title">Select Type:</label>
                  <select id="typeid" name="type" class="form-control">
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
  
              <div id="headingdiv" class="form-group editme">    
              <span id="showme">-After selecting a type Headings will appear below, click on it to start editing (Data will be saved automatically)</span>      
              </div>
               
              <div id="contentdiv" class="form-group editmeascontent">
              <h3 id="contentheader">Here content will appear of the selected heading<span id="headerofcon"></span></h3>
              </div>
      </div>
        </div>
        
  </div>';
        ////ending
     }
}
?>
 <script>
   $(document).ready(function (){
    $("#suc").hide()
    $( "select[name='type']" ).change(function () {
    var typeis = $(this).val();
    
    if(typeis) {
        $.ajax({         
            type: "POST", 
            url: "termsedit.php",
            data: {'typeis':typeis},
            success: function(data) {
              $("#headingdiv").html(data); 
              $("#contentdiv").hide(); 
            }
        });

    }
    
});
$(document).on('click', '.contenteditor' , function(e){   
                      
           var headingval = $(this).closest("p").text()
            $(this).closest("p").on('blur', function(e){    
              console.log("initial value"+headingval);
              let realheadingvalue =  $(this).text()
              console.log("after blur value"+realheadingvalue);
              if(headingval === realheadingvalue){
                console.log("no changes has been made");
              }else{
            let typeid =  $("#typeid option:selected").text()
            $.ajax({         
            type: "POST", 
            url: "termsedit.php",
            data:{
              'realheading':headingval,
              'editedheading':realheadingvalue,
              'typeistype':typeid,
            },
            success: function(data) {
              console.log(data);
              if(data=="success"){
                $("#suc").show();
		           setTimeout(function (){
                 $("#suc").hide();
                }, 4000);
              }
                         
            }
        });
              }   
              });
          });
          $(document).on('click', '.editbtn' , function(e){
            console.log("clicked the see content button");
            var headis = $(this).parent().prev().text();
           var typeid =  $("#typeid option:selected").text()
           
           $.ajax({         
            type: "POST", 
            url: "termsedit.php",
            data:{
              'headingcontent':headis,
              'typeisfrom':typeid,
            },
            success: function(data) {   
               $("#contentdiv").show();                     
               $("#contentdiv").html(data)            
              }
            
        });
          });
          $(document).on('blur', '#txt_name' , function(e){
            let typiscontent =  $("#typeid option:selected").text()
            let headingofco =  $("#headingofcontent").text()
            let contentis =  $("#txt_name").text()
            $.ajax({         
            type: "POST", 
            url: "termsedit.php",
            data:{
              'headingofco':headingofco,
              'typiscontent':typiscontent,
              'contentis':contentis,
            },
            success: function(data) {      
              console.log(data);                  
              if(data === "success"){
                $("#suc").show();
		           setTimeout(function (){
                $("#suc").hide();
               }, 4000);
              } else{
                console.log("there was an error upddating the content");
              }          
              }
            
        });
          });

      let btn = document.querySelector("#side-bar-btn");
      let sideBar = document.querySelector(".ss");
      btn.onclick = function(){
        sideBar.classList.toggle("active");
      }
});
    </script>

</body>
</html>