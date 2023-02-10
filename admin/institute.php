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
    $name = mysqli_real_escape_string($con, htmlspecialchars($_POST['iName'], ENT_QUOTES));
    $type = mysqli_real_escape_string($con, htmlspecialchars($_POST['iType'], ENT_QUOTES));
    $person = mysqli_real_escape_string($con, htmlspecialchars($_POST['iPersonName'], ENT_QUOTES));
    $contact = mysqli_real_escape_string($con, htmlspecialchars($_POST['iContact'], ENT_QUOTES));
    $altContact = mysqli_real_escape_string($con, htmlspecialchars($_POST['iAltContact'], ENT_QUOTES));
    $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['iEmail'], ENT_QUOTES));
    $address = mysqli_real_escape_string($con, htmlspecialchars($_POST['iAddress'], ENT_QUOTES));
    $faculty = mysqli_real_escape_string($con, htmlspecialchars($_POST['iFaculty'], ENT_QUOTES));
    $exp = mysqli_real_escape_string($con, htmlspecialchars($_POST['iExperiences'], ENT_QUOTES));
    $quality = mysqli_real_escape_string($con, htmlspecialchars($_POST['iQualification'], ENT_QUOTES));
    $ip = getenv("REMOTE_ADDR");
    $sql2 = "SELECT id FROM apnaInstitutes WHERE emailIs = ? && extra = ?;";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("ss", $email, $show);
    $stmt2->execute();
    $stmt2->store_result();
    if($stmt2->num_rows() != 0) {
        header("Location: ../index.php?from=institute&action=upload&status=emailerror");
        exit();
    } else {
        $sql = "INSERT INTO apnaInstitutes (nameIs, typeIs, personIs, contactIs, altContactIs, emailIs, addressIs, facultyIs, expIs, qualityIs, ipIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ssssssssssss", $name, $type, $person, $contact, $altContact, $email, $address, $faculty, $exp, $quality, $ip, $show);
        $stmt->execute();
        header("Location: ../index.php?from=institute&action=upload&status=success");
        exit();
    }
} elseif($action === "view") {
    echo '<html>
        <head>
            <title>Apna Sikshalaya Admin | Institute</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            <style>
                th, td {text-align: center;}
            </style>
        </head>
        <body>
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Apna Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Institute <span class="sr-only">(current)</span></a></li>
        <li><a href="/teacher.php?action=view">Teacher</a></li>
        <li><a href="/student.php?action=view">Student</a></li>
        <li><a href="/courses.php?action=view">Courses</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Others <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Events</a></li>
            <li><a href="#">NewsLetter</a></li>
            <li><a href="#">Blogs</a></li>
            <li><a href="#">Tuition</a></li>
            <li><a href="#">Consultancy</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">T&C</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/">Admin Panel</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home Page <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="apnasikshalaya.com">Home</a></li>
            <li><a href="apnasikshalaya.com">Courses</a></li>
            <li><a href="apnasikshalaya.com">Institute</a></li>
            <li><a href="apnasikshalaya.com">Tuition</a></li>
            <li><a href="apnasikshalaya.com">Teacher</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="apnasikshalaya.com">Students</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">List of institutes</div>
  <!--div class="panel-body">
    <p>Apna Sikshalaya Admin Panel</p>
  </div-->
  <table class="table">
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Person</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Faculty</th>
        <th>Experience</th>
        <th>Qualification</th>
    </tr>';
    $sql = "SELECT * FROM apnaInstitutes WHERE extra = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("s", $show);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $type, $person, $contact, $altContact, $email, $address, $faculty, $exp, $quality, $time, $ip, $extra);
    while($stmt->fetch()) {
        echo '<tr>
            <td>'.$name.'</td>
            <td>'.$type.'</td>
            <td>'.$person.'</td>
            <td>'.$contact.'</td>
            <td>'.$email.'</td>
            <td>'.$address.'</td>
            <td>'.$faculty.'</td>
            <td>'.$exp.'</td>
            <td>'.$quality.'</td>
            <td>'.$scl.'</td>
            <td>'.$mode.'</td>';
        echo '</tr>';
    }
    echo '</table>
        </div>
    </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </html>';
}