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

                <h4>' . $adminRoleName . '</h4>

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

  $desig = mysqli_real_escape_string($con, htmlspecialchars($_GET['desig'], ENT_QUOTES));
  $email = mysqli_real_escape_string($con, htmlspecialchars($_GET['email'], ENT_QUOTES));

  //take all the variables from the url and find if its teacher or student then show his profile
  if ($desig == "student") {
    $sql = "SELECT * FROM apnaStudents WHERE emailIs = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $slno = 1;
    $stmt->bind_result($id, $googleId, $name, $gender, $contact, $altContact, $dob, $email, $pass, $address, $addressline2, $city, $state, $district, $pin, $quality, $institute, $test, $tuition, $professionalCourse, $certificationCourse, $competitiveCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra, $lastlogin, $firstupload, $thumbnail, $creditscore);
    $stmt->fetch();
    //run query search the students table and get all the corresponding user info 
    //all the variables has to be universal in a sense that both students and teacher info can be stored 
    //extra info can be stored in extra variables
    //later wwe will check if the variables existt then we show them
    echo '
    <style>
   
#useremail{
  display: none;
}
.form-control:focus {
box-shadow: none;
border-color: #BA68C8
}

.profile-button {
background: rgb(99, 39, 120);
box-shadow: none;
border: none
}

.profile-button:hover {
background: #682773
}

.profile-button:focus {
background: #682773;
box-shadow: none
}

.profile-button:active {
background: #682773;
box-shadow: none
}

.back:hover {
color: #682773;
cursor: pointer
}

.labels {
font-size: 11px
}

.add-experience:hover {
background: #BA68C8;
color: #fff;
cursor: pointer;
border: solid 1px #BA68C8
}
</style>


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
              <label for="Ealtaddress"> Alternate-Address</label>
              <input type="text" name ="Ealtaddress" id="edit_addressline2" class="form-control" placeholder="Enter address">
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
              <label for="Edistrict">District</label>
              <input type="text" name ="Edistrict" id="edit_districtIs" class="form-control" placeholder="Enter State ">
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
            <button type="submit" name ="update_student_profile" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="' . $thumbnail . '"><span class="font-weight-bold">'.$name.'</span><span class="text-black-50">'.$email.'</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">' . $desig . ' Profile</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><p>Name: ' . $name . ' </p></div>
                    <div class="col-md-6"><p>Gender: ' . $gender . ' </p></div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><p>Contact-info: '.$contact.'</p></div>
                    <div class="col-md-12"><p>Alternate Contact-info: '.$altcontact.'</p></div>
                    <div class="col-md-12"><p>Date of Birth: '.$dob.'</p></div>
                    <p id="useremail">'.$email.'</p>
                    <div class="col-md-12"><p>Address: '.$address.'</p></div>
                    <div class="col-md-12"><p>Alternate Address: '.$addressline2.'</p></div>
                    <div class="col-md-12"><p>City: '.$city.'</p></div>
                    <div class="col-md-12"><p>State: '.$state.'</p></div>
                    <div class="col-md-12"><p>District: '.$district.'</p></div>
                    <div class="col-md-12"><p>PIN: '.$pin.'</p></div>
                    <div class="col-md-12"><p>Qualification: '.$quality.'</p></div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><p>Institute: '.$institute.'</p></div>
                    <div class="col-md-6"><p>Test: '.$test.'</p></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Edit Details</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="col-md-12"><p>Credit Score: '.$creditscore.'</p></div> <br>
                <div class="col-md-12"><p>Tuition: '.$tuition.'</p> <a href="/"><button class="btn">Tuitions subscribed</button></a></div> <br>
                <div class="col-md-12"><p>Professional Course: '.$professionalCourse.'</p></div> <br>
                <div class="col-md-12"><p>Certificational Course: '.$certificationCourse.'</p></div> <br>
                <div class="col-md-12"><p>Competitive Course: '.$competitiveCourse.'</p></div> <br>
                <div class="col-md-12"><p>Crash Course: '.$crashCourse.'</p></div> <br>
                <div class="col-md-12"><p>Study Material: '.$studyMaterial.'</p></div> <br>
                <div class="col-md-12"><p>IP-Address: '.$ip.'</p></div> <br>
                <div class="col-md-12"><p>Last-Login: '.$lastlogin.'</p></div> <br>
                <div class="col-md-12"><p>First-Login: '.$firstupload.'</p></div> <br>
                
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>';
  } elseif ($desig == "teacher") {
    $sql = "SELECT * FROM apnaTeachers WHERE emailIs = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  $slno=1;
  $stmt->bind_result($id, $googleId, $name, $gender, $contact, $dob, $altContact, $email, $pass, $address, $addressline2, $city, $state, $district, $pin, $subject, $exp, $quali,$certicourse,$procourse,$tuition, $resume, $ip, $verify, $extra, $lastlogin, $firstupload, $thumbnail, $creditscore);
  $stmt->fetch();
    echo '
    <style>
   
#useremail{
  display: none;
}
.form-control:focus {
box-shadow: none;
border-color: #BA68C8
}

.profile-button {
background: rgb(99, 39, 120);
box-shadow: none;
border: none
}

.profile-button:hover {
background: #682773
}

.profile-button:focus {
background: #682773;
box-shadow: none
}

.profile-button:active {
background: #682773;
box-shadow: none
}

.back:hover {
color: #682773;
cursor: pointer
}

.labels {
font-size: 11px
}

.add-experience:hover {
background: #BA68C8;
color: #fff;
cursor: pointer;
border: solid 1px #BA68C8
}
</style>

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
          <label for="Ealtaddress">Address</label>
          <input type="text" name ="Eaddress" id="edit_address" class="form-control" placeholder="Enter address">
       </div>
       <div class = "form-group">
          <label for="Eaddress">Alt-Address</label>
          <input type="text" name ="Ealtaddress" id="edit_altaddress" class="form-control" placeholder="Enter alt address">
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
          <label for="Edistrict">District</label>
          <input type="text" name ="Edistrict" id="edit_district" class="form-control" placeholder="Enter district ">
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
        <button type="submit" name ="update_teacherprofile" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
  </div>
</div>

  
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="' . $thumbnail . '"><span class="font-weight-bold">'.$name.'</span><span class="text-black-50">'.$email.'</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">' . $desig . ' Profile</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><p>Name: ' . $name . ' </p></div>
                    <div class="col-md-6"><p>Gender: ' . $gender . ' </p></div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><p>Contact-info: '.$contact.'</p></div>
                    <div class="col-md-12"><p>Alternate Contact-info: '.$altcontact.'</p></div>
                    <div class="col-md-12"><p>Date of Birth: '.$dob.'</p></div>
                    // below para tag is needed dont change it
                    <p id="useremail">'.$email.'</p>
                    //----
                    <div class="col-md-12"><p>Address: '.$address.'</p></div>
                    <div class="col-md-12"><p>Alternate Address: '.$addressline2.'</p></div>
                    <div class="col-md-12"><p>City: '.$city.'</p></div>
                    <div class="col-md-12"><p>State: '.$state.'</p></div>
                    <div class="col-md-12"><p>District: '.$district.'</p></div>
                    <div class="col-md-12"><p>PIN: '.$pin.'</p></div>
                    <div class="col-md-12"><p>Subjects: '.$subject.'</p></div>
                    <div class="col-md-12"><p>Experience: '.$exp.'</p></div>
                    <div class="col-md-12"><p>Qualification: '.$quality.'</p></div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><p>Institute: '.$institute.'</p></div>
                    <div class="col-md-6"><p>Test: '.$test.'</p></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary teacherprofile-button" type="button">Edit Details</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="col-md-12"><p>Credit Score: '.$creditscore.'</p></div> <br>
                <div class="col-md-12"><p>Tuition: '.$tuition.'</p> <a href="/userprofiletuition.php?email='.$email.'&desig=teacher"><button class="btn">Tuitions by this teacher</button></a></div> <br>
                <div class="col-md-12"><p>Professional Course: '.$procourse.'</p></div> <br>
                <div class="col-md-12"><p>Certificational Course: '.$certicourse.'</p></div> <br>
                
                <div class="col-md-12"><p>IP-Address: '.$ip.'</p></div> <br>
                <div class="col-md-12"><p>Last-Login: '.$lastlogin.'</p></div> <br>
                <div class="col-md-12"><p>First-Login: '.$firstupload.'</p></div> <br>
                
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>';



  }
}
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
  $(".profile-button").click(function(e) {   
    e.preventDefault();
    var stud_email = $("#useremail").text();
    console.log(stud_email);
    $.ajax({
      type: "POST",
      url: "studentview.php",
      data: {
        "profile_edit_btn": true,
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
          $("#edit_addressline2").val(value["addressline2"]);
          $("#edit_city").val(value["cityIs"]);
          $("#edit_state").val(value["stateIs"]);
          $("#edit_districtIs").val(value["districtIs"]);
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
          $("#edit_creditScore").val(value["creditScore"]);
        });
        $("#editStudentModal").modal("show");
      }
    });
  });
  $(".teacherprofile-button").click(function (e){
            e.preventDefault();
            var teacher_email = $("#useremail").text();
            $("#editTeacherModal").modal("show");
            $.ajax({
              type:"POST",
              url:"teacherview.php",
              data:{
                "checking_edit_profile":true,
                "teacher_email":teacher_email,
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
                  $("#edit_altaddress").val(value["addressline2"]);
                  $("#edit_city").val(value["cityIs"]);
                  $("#edit_state").val(value["stateIs"]);
                  $("#edit_district").val(value["districtIs"]);
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
</script>