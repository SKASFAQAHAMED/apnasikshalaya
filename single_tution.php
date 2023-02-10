<!--
This website is designed & developed by
     ___           _________ _________ _________  ________ _________  ________ _________  ___           __
    / _ \         / / __   //___  ___//___  ___/ / ______//___  ___/ / ______//___  ___/ / _ \         / /
   / / \ \       / / /__/ /    / /       / /    / /__        / /    / /          / /    / / \ \       / /
  / /   \ \     / /  ____/    / /       / /    / ___/       / /    / /          / /    / /   \ \     / /
 / /_____\ \   / / \ \       / /    ___/ /___ / /       ___/ /___ / /______ ___/ /___ / /_____\ \   / /_____
/___________\ /_/   \_\     /_/    /________//_/       /________//________//________//___________\ /_______/


                          ________          _________         _________         _______    
                         /  _____/         / / __   /        /___  ___/        / __   /   
                        / /               / / /__/ /            / /           / /  / /    
                       / /               / /  ____/            / /           / /  / /     
                      / /______         / / \ \            ___/ /___        / /__/ /       
                     /________/        /_/   \_\          /________/       /______/       

Visit crioit.com for more info.
-->
<?php 
include_once("./sn/con.php");
session_start();
$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
$typeoftuition = mysqli_real_escape_string($con, htmlspecialchars($_GET['typeis'], ENT_QUOTES));
if($typeoftuition=="online"){
  // below query is for online tuitions 
  $sql = "SELECT * FROM onlineTeacherTuition WHERE teacherId = ?;";
  $stmt = $con->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("s",$id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id, $Tid, $icon, $teacherEmail, $tuitionName, $tdescription, $gradeIs, $boardIs, $subjectIs, $secondarysubIs, $speciIs, $hourIs, $weekdaysIs, $price);
  $stmt->fetch();
  $sql = "SELECT * FROM apnaTeachers WHERE id = ?;";
  $stmt = $con->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("s",$Tid);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($teacherrealid, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
  $stmt->fetch();
  // the price is stored in the extra column 
}else{
  // below query is used to fetch data from the offline tuition 
  $sql = "SELECT * FROM teacherTuition WHERE teacherId = ?;";
  $stmt = $con->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("s",$id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($id, $Tid, $gradeIs, $boardIs, $subjectIs, $secondarysubIs, $speciIs, $hourIs, $price);
  $stmt->fetch();
  // below query is used to get data from the teachers table
  $sql = "SELECT * FROM apnaTeachers WHERE id = ?;";
  $stmt = $con->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("s",$Tid);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($teacherrealid, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
  $stmt->fetch();
  // the price is stored in the extra column
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/single_tution.css">
    <link rel="shortcut icon" type="image/png" href="images/s-icon.png">    
    <title><?php echo $tuitionName; ?></title>
    <style>
      <?php 
      if($thumbnail!==null){
        echo '.thumb_img img {
          width: 12%;
          border-radius: 12px;
          box-shadow: 0 16px 22px 0 rgb(90 91 95 / 30%);
      }';
      }
       ?>
    </style>
  </head>
  <?php include_once 'header.php'; ?>
  <body>
  <div class="container-fluid">
  <div class="row">
      <div class="col-md-8">
       <div class="thumb_img">
         <?php if($thumbnail==null){
           $thumbnail = './images/green.jpg';
         }
         ?>
           <img src="<?php echo $thumbnail; ?>" alt="tution thumb">
       </div>
       <div class="tution_desc">
         <?php 
         if($typeoftuition=="online" && $tdescription!==null){
          echo "<h2>'.$tdescription.'.</h2>";
         }else{
           echo"
          <h2>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat.</h2>
           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt nobis beatae modi atque ut impedit sit praesentium eos natus eaque, officia inventore ex recusandae veniam adipisci officiis veritatis asperiores debitis.</p>
        ";
         }
         ?>
           
        </div>
      </div>
      <div class="col-md-4">
          <div class="tution_sec">
            <?php if(isset($_GET['loginrequired'])){
              echo '<h3 style ="color:red;">Please Login to continue to Your subscription</h3><hr>';
            }elseif(isset($_GET['subscription'])){
              echo '<h3 style ="color:green;">Congratulations successfully subscribed You will be Contacted by our Team shortly</h3><hr>';
            }elseif(isset($_GET['serverproblem'])){
              echo '<h3 style ="color:yellow;">Sorry for your inconvenience our server is currently down please try again later</h3><hr>';
            } ?>
            <h2><?php echo $tuitionName; ?></h2><hr>
            <h4><b>Subject:</b> <span><?php echo $subjectIs; ?></span></h4>
            <h4><b>Secondary subjects: </b><span><?php echo $secondarysubIs; ?></span></h4>
            <h4><b>Start date: </b><span>12.20.2021</span></h4>
            <h4><b>Hours: </b><span><?php echo $hourIs; ?></span></h4>
            <h4><b> Days: </b><span><?php echo $weekdaysIs; ?></span></h4>
          </div>
      <div class="teacher-sec">
        <h2>About teacher</h2><hr>
        <h4><b>Name:</b> <span><?php echo $name; ?></span></h4>
        <h4><b>Specialization: </b><span><?php echo $speciIs; ?></span></h4>
      </div>
      <div class="other_sec">
        <h2>Other descriptions</h2><hr>
        <h4><b>Grade:</b> <span><?php echo $gradeIs ?></span></h4>
        <h4><b>Board: </b><span><?php echo $boardIs ?></span></h4>
        <h4 class="price"><b>Price:  </b><i class="fas fa-rupee-sign"></i><span><?php echo $price ?></span></h4><br>
        <form  action="tuitionvalidation.php" method="POST">
        <input style="display:none;" name="useremail"  type="text" value=" <?php echo $_SESSION['user'] ?>">
        <input style="display:none;" name="tuitionId" type="text" value=" <?php echo $id ?>">
        <input style="display:none;" name="teacheremail" type="text" value=" <?php echo $email ?>">
        <input style="display:none;" name="teacherid" type="text" value=" <?php echo $Tid ?>">
        <input style="display:none;" name="price" type="text" value=" <?php echo $price ?>">
        <input style="display:none;" name="tuitiontype" type="text" value=" <?php if($typeoftuition=="online"){
          echo 'online';
        }else{
          echo'offline';
        } ?>">
        <?php
          $userEmail = $_SESSION['user'];
          $sql4 = "SELECT tuitionId FROM tuitionPaymentFinal WHERE userIs = ?;";
          $stmt4 = $con->stmt_init();
          $stmt4->prepare($sql4);
          $stmt4->bind_param("s",$userEmail);
          $stmt4->execute();
          $stmt4->store_result();
          $stmt4->bind_result($subscribedTuitionId);
          $subTuitionarray = array();
          if($stmt4->fetch()){
            echo "it runs";
          }else{
            echo "query problem";
          }
          // while($stmt4->fetch()) {
          //   array_push($subTuitionarray, $subscribedTuitionId);
          // }
          if(in_array($id, $subTuitionarray)){
            echo '<button  class="arrow-btn joinbtn">Already Subscribed/Applied(Please check your profile) </button>';
          }else{
            echo '<button  class="arrow-btn joinbtn" type="submit">Join Now</button>';
            // echo "the sub ids are:".$subscribedTuitionId.$userEmail;
            // print_r($subscribedTuitionId);
          }
         ?>        
        </form>
      </div>
      </div>
  </div>

  </div>


  <?php include_once 'footer.php';?>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>

//   $(document).ready(function (){
//     $(".joinbtn").show()
// $(".joinbtn").click(function(e){
// let useremailis = $(this).closest("form").find(".useremail").val();
// let desig = "teacher";
// let link = '/userprofileinfo.php?desig='+desig
// console.log("i am in");
// console.log(useremailis);
// window.location.href=link;
// });

// });
  </script>
</html>
<?php 
$tasty='yummy';
?>