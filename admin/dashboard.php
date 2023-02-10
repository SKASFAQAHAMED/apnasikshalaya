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
  $sql1 = "SELECT COUNT(DISTINCT titleIs) FROM apnaCourses ;";
$stmt = $con->stmt_init();
$stmt->prepare($sql1);	
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($coursecount);
$stmt->fetch();
$sql2 = "SELECT COUNT(DISTINCT Adminname) FROM admin_users ;";
$stmt = $con->stmt_init();
$stmt->prepare($sql2);	
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($admincount);
$stmt->fetch();
$sql3 = "SELECT COUNT(DISTINCT emailIs) FROM apnaStudents ;";
$stmt = $con->stmt_init();
$stmt->prepare($sql3);	
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($studentcount);
$stmt->fetch();
$sql4 = "SELECT COUNT(DISTINCT emailIs) FROM apnaTeachers ;";
$stmt = $con->stmt_init();
$stmt->prepare($sql4);	
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($teachercount);
$stmt->fetch();
$sql5 = "SELECT COUNT(DISTINCT ipaddressIs) FROM visitorsIs ;";
$stmt = $con->stmt_init();
$stmt->prepare($sql5);	
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($anonyusers);
$stmt->fetch();
$deviceis = "PC";
$sql6 = "SELECT COUNT(DISTINCT ipaddressIs) FROM visitorsIs WHERE deviceIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql6);	
$stmt->bind_param("s", $deviceis);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($anonypcuser);
$stmt->fetch();
$window = "Window";
$android = "Android";
$ios = "IOS";
$sql9 = "SELECT COUNT(DISTINCT ipaddressIs) FROM visitorsIs WHERE osIs = ?;";
$stmt9 = $con->stmt_init();
$stmt9->prepare($sql9);	
$stmt9->bind_param("s", $window);
$stmt9->execute();
$stmt9->store_result();
$stmt9->bind_result($windowUser);
$stmt9->fetch();
$today = date('Y-m-d');
$sql12 = "SELECT COUNT(ipaddressIs) FROM visitorsIs WHERE dateIs = ?;";
$stmt12 = $con->stmt_init();
$stmt12->prepare($sql12);	
$stmt12->bind_param("s", $today);
$stmt12->execute();
$stmt12->store_result();
$stmt12->bind_result($todayVisitors);
$stmt12->fetch();
$studentText = "Student";
$sql13 = "SELECT COUNT(ipaddressIs) FROM visitorsIs WHERE dateIs = ? && desigIs = ?;";
$stmt13 = $con->stmt_init();
$stmt13->prepare($sql13);	
$stmt13->bind_param("ss", $today, $studentText);
$stmt13->execute();
$stmt13->store_result();
$stmt13->bind_result($todayStudents);
$stmt13->fetch();
$teacherText = "Teacher";
$sql14 = "SELECT COUNT(ipaddressIs) FROM visitorsIs WHERE dateIs = ? && desigIs = ?;";
$stmt14 = $con->stmt_init();
$stmt14->prepare($sql14);	
$stmt14->bind_param("ss", $today, $teacherText);
$stmt14->execute();
$stmt14->store_result();
$stmt14->bind_result($todayTeachers);
$stmt14->fetch();
$sql10 = "SELECT COUNT(DISTINCT ipaddressIs) FROM visitorsIs WHERE osIs = ?;";
$stmt10 = $con->stmt_init();
$stmt10->prepare($sql10);	
$stmt10->bind_param("s", $ios);
$stmt10->execute();
$stmt10->store_result();
$stmt10->bind_result($iosUser);
$stmt10->fetch();
$sql11 = "SELECT COUNT(DISTINCT ipaddressIs) FROM visitorsIs WHERE osIs = ?;";
$stmt11 = $con->stmt_init();
$stmt11->prepare($sql11);	
$stmt11->bind_param("s", $android);
$stmt11->execute();
$stmt11->store_result();
$stmt11->bind_result($androidUser);
$stmt11->fetch();

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

<title>Apna Sikshalaya admin panel</title>
<style>
.filtered{
  display: none;
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
                <h2><b>' . $adminrealname . '</b></h2>
                <h4>'.$adminRoleName.'</h4>
                <p>Last Logged in:<i>09-sep-2021 05:37 PM</i></p>
            </div>
          </div>
          <a href="./dashboard.php"> <div class="dash-board row">Dashboard</div></a>
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
                <a href="./tuitions.php?action=upload"><button>Upload Tuition</button></a>
                <a href="./tuitions.php?action=selecttuition"><button>View Tuitions</button></a>
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
                <div type="button" style="width:30px;display:flex; flex-direction:;" id="side-bar-btn" >
                  <span type="button" style="width:30px;" id="side-bar-btn">
                    <i class="fa fa-bars"></i>
                  </span>
                  <span><b>Apnasikshalaya</b></span>
                </div>
                <a class="logout" style="float:right;" href="./logout.php"><button>Logout</button></a>
              </div>
          </div>
<!-- Row 1 -->
          <div class="row first">
            <!-- Admin Info -->
            <div class="col-lg-2 col-md-2" style="padding-right: 0;">
              <div class="admin">
               
               <h3><b>'.date("Y-m-d").'</b></h3>
               <h5>Visitor Count</h5>
               <h4>'.$todayVisitors.' anonymous users
               <br>'.$todayStudents.' students
               <br>'.$todayTeachers.' teachers</h4>
              </div>
            </div>
            <!-- User Graph -->
            <div class="col-lg-5 col-md-5">
              <div class="enrolment-graph">
               <div style="text-align: center; font-weight: 700; font-size: 18px;" ><h4>Total Users in PC/Mobile</h4></div>
               <div id="usergraph" class="graph"></div>
              </div>
            </div>
            <!-- OS Graph -->
            <div class="col-lg-5 col-md-5">
              <div class="courses-graph">
               <div style="text-align: center; font-weight: 700; font-size: 18px;" ><h4>Total Users according to OS</h4></div>
               <div id="osgraph"></div>
              </div>
            </div>
          </div>

<!-- Row 2 -->
';
//bellow sql code is used for building the
// $sql8 = "SELECT COUNT(DISTINCT ipaddressIs) AS icount,deviceIs  FROM visitorsIs GROUP BY deviceIs;";
// $stmt8=$con->prepare($sql8);	
// $stmt8->execute();
// $arr = $stmt8->fetchAll(PDO::FETCH_ASSOC);



$deviceismob = "Mobile";
$sql7 = "SELECT COUNT(DISTINCT ipaddressIs) FROM visitorsIs WHERE deviceIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql7);	
$stmt->bind_param("s", $deviceismob);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($anonymobileuser);
$stmt->fetch();
echo'
       <div class="row second">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="visitor-graph">
              <div style="text-align: center; font-weight: 700; font-size: 18px;" ></div>
            <div id="osgraph"></div>
          </div>
        </div>
        ';  if ($adminRole == 1) {
          echo'
          <a href="/admin.php?action=view" class="totaladmins">
          <div class="col-md-4 col-lg-4" style="padding-left: 0;">  
               <div class="admins">
                <div class="col-md-1"><img src="icons/admin.png" height="25px" width="28px" draggable="false" alt=""></div>
                <div class="col-md-6"><h5>Total Admins</h5></div>
                <div class="col-md-5"><span>'.$admincount.'</span></div>
               </div>
             </div>
          </a>
          ';
        }else{ 
          echo'
          <div class="col-md-4 col-lg-4" style="padding-left: 0;">
               <div class="admins">
                <div class="col-md-1"><img src="icons/admin.png" height="25px" width="28px" draggable="false" alt=""></div>
                <div class="col-md-6"><h5>Total Courses</h5></div>
                <div class="col-md-5"><span>'.$coursecount.'</span></div>
               </div>
             </div>
          ';
        }echo'
             
             <div class="col-md-4 col-lg-4">
               <div class="teachers">
                <div class="col-md-1"><img src="icons/teacher.png" height="25px" width="28px" draggable="false" alt=""></div>
                <div class="col-md-6"><h5>Total Teachers</h5></div>
                <div class="col-md-5"><span>'.$teachercount.'</span></div>
               </div>
              </div>
              <div class="col-md-4 col-lg-4">
               <div class="students">
                <div class="col-md-1"><img src="icons/student.png" height="25px" width="28px" draggable="false" alt=""></div>
                <div class="col-md-6"><h5>Total Students</h5></div>
                <div class="col-md-5"><span>'.$studentcount.'</span></div>
               </div>
              </div>
        </div>
<!-- Filter Section -->
        <div class="row filter">
          <div class="col-md-3 col-lg-3"><h3 class="showresult">See number of Visitors</h3></div>
          <div class="col-md-7 col-lg-7">
              <div class="from-date col-md-6">
                <div class="col-md-4" style="padding: 0; text-align: center;"><h4>From </h4></div>
                <div class="col-md-8" style="padding: 0;"><input id="fromdate" type="date"></div>
              </div>
              <div class="To-date col-md-6">
                <div class="col-md-3" style="padding: 0; text-align: center;"><h4>To </h4></div>
                <div class="col-md-9" style="padding: 0;"><input id="todate" type="date"></div>
              </div>
          </div>
          <div class="col-md-2 col-lg-2">
            <button id="filterbutton">Filter</button>
          </div>
        </div>
<!-- Filter Result -->
        <div class="row filtered">
        <div class="col-md-3 col-lg-3" style="padding-left: 0;">
        <div class="result-admin filter-result">
          <div style="display: flex; align-items: center; justify-content: center;"><img src="icons/admin.png" height="25px" width="28px" draggable="false" alt=""></div>
          <div style="display: flex; align-items: center; justify-content: center;"><h4>Total Anonymous Users</h4></div>
          <div style="display: flex; align-items: center; justify-content: center;"><span>'.$anonyusers.'</span></div>
        </div>
      </div>
      <div class="col-md-3 col-lg-3">
        <div class="result-admin filter-result">
          <div style="display: flex; align-items: center; justify-content: center;"><img src="icons/teacher.png" height="25px" width="28px" draggable="false" alt=""></div>
          <div style="display: flex; align-items: center; justify-content: center;"><h4>Total PC Visitors</h4></div>
          <div style="display: flex; align-items: center; justify-content: center;"><span>'.$anonypcuser.'</span></div>
        </div>
      </div>
      <div class="col-md-3 col-lg-3">
        <div class="result-admin filter-result">
          <div style="display: flex; align-items: center; justify-content: center;"><img src="icons/student.png" height="25px" width="28px" draggable="false" alt=""></div>
          <div style="display: flex; align-items: center; justify-content: center;"><h4>Total Mobile Visitors</h4></div>
          <div style="display: flex; align-items: center; justify-content: center;"><span>'.$anonymobileuser.'</span></div>
        </div>
      </div>
        </div>
        <div class="row result">
          <!-- Filter Result of Admin -->
          <div class="col-md-3 col-lg-3" style="padding-left: 0;">
            <div class="result-admin filter-result">
              <div style="display: flex; align-items: center; justify-content: center;"><img src="icons/admin.png" height="25px" width="28px" draggable="false" alt=""></div>
              <div style="display: flex; align-items: center; justify-content: center;"><h4>Total Anonymous Users</h4></div>
              <div style="display: flex; align-items: center; justify-content: center;"><span>'.$anonyusers.'</span></div>
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="result-admin filter-result">
              <div style="display: flex; align-items: center; justify-content: center;"><img src="icons/teacher.png" height="25px" width="28px" draggable="false" alt=""></div>
              <div style="display: flex; align-items: center; justify-content: center;"><h4>Total PC Visitors</h4></div>
              <div style="display: flex; align-items: center; justify-content: center;"><span>'.$anonypcuser.'</span></div>
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="result-admin filter-result">
              <div style="display: flex; align-items: center; justify-content: center;"><img src="icons/student.png" height="25px" width="28px" draggable="false" alt=""></div>
              <div style="display: flex; align-items: center; justify-content: center;"><h4>Total Mobile Visitors</h4></div>
              <div style="display: flex; align-items: center; justify-content: center;"><span>'.$anonymobileuser.'</span></div>
            </div>
          </div>
          <div class="col-md-3 col-lg-3" style="padding-right: 0;">
            <div class="result-admin filter-result">
              <div style="display: flex; align-items: center; justify-content: center;"><img src="icons/enrolments.gif" height="25px" width="28px" draggable="false" alt=""></div>
              <div style="display: flex; align-items: center; justify-content: center;"><h4>Total Enrolments</h4></div>
              <div style="display: flex; align-items: center; justify-content: center;"><span>667675</span></div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>


    <script>
      let btn = document.querySelector("#side-bar-btn");
      let sideBar = document.querySelector(".ss");

      btn.onclick = function(){
        sideBar.classList.toggle("active");
      }
    </script>
    <!-- google chart api -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
';

?>

<script>
$(document).ready(function() {
 // Load the Visualization API and the corechart package.
 google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

  // Create the data table.
  var data = google.visualization.arrayToDataTable([
    ['Device','Count'],  
    ['PC', <?php echo $anonypcuser; ?>],
    ['Mobile', <?php echo $anonymobileuser; ?>],
  ]);
  var data2 = google.visualization.arrayToDataTable([
    ['OS','Count'],  
    ['Windows', <?php echo $windowUser; ?>],
    ['iOS', <?php echo $iosUser; ?>],
    ['Android', <?php echo $androidUser; ?>],
  ]);

  // Set chart options
  var options = {'title':'The Ratio of Mobile Vs PC users',
                 'width':400,
                 'height':300};
  var options2 = {'title':'The Ratio of OS',
                 'width':400,
                 'height':300};

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('usergraph'));
  var chart2 = new google.visualization.PieChart(document.getElementById('osgraph'));
  chart.draw(data, options);
  chart2.draw(data2, options2);
}



  $("#filterbutton").click(function(e){
    let todate = $("#todate").val();
    let fromdate = $("#fromdate").val();
  //  console.log(fromdate);
  //  console.log(todate);
  $.ajax({
        type: "POST",
        url: "dashboardview.php",
        data: {
          "datefilter": true,
          "todate": todate,
          "fromdate": fromdate,
        },
        success: function(response) {
          console.log(response);
          $(".showresult").html(response);
        }
      });
  });
});
</script>
<?php
echo'
  </body>
</html>';
}
