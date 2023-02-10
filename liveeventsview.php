<?php
include_once("./sn/con.php");
session_start();
if(isset($_POST['action'])){ 
  $organizer = json_decode($_POST["organizer"], true);
  $type = json_decode($_POST["type"], true);
  $date = json_decode($_POST["date"], true);
  $show = "show";
  $todaysDate = date("Y-m-d");
  $calculated_date = date('Y-m-d', strtotime($todaysDate. ' + '.$date.' days'));
  if($todaysDate == $calculated_date){
    $calculated_date = date('Y-m-d', strtotime($todaysDate. ' + 1  years'));
  }
  $sql = "SELECT * FROM apna_Events WHERE extra = ?";
    if(!empty($organizer) && $organizer != null && $organizer != [] && $organizer != false && $organizer != "[]"){
      $output .= 'organizer filter = true';
      // $test = " ".implode(",", $organizer);
//  $organizer = implode(",", $organizer);
//    $sql .= " AND organizerIs IN('$organizer')";
    }
    if(isset($_POST["type"]) && !empty($type) && $type != null && $type != [] && $type != false && $type != "[]"){
      $output .= 'type filter = true';
  // $type = implode(",", $type);
  // $sql .= " AND keywordIs IN('$type')";
  // $test .= " ".implode(",", $type);
    }
    if(isset($_POST["date"])  && !empty($_POST["date"])){
      $output .= 'date filter = true';
  // $sql .= " AND eventDate <= '$calculated_date'";
  // $test .= " ".$date;
 }
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("s", $show);
$stmt->execute();
$stmt->store_result();
$total_row = $stmt->num_rows();
if($total_row > 0){
$stmt->bind_result($id, $title, $topic, $content, $organize, $keywords, $eventdate, $eventtime, $views, $enrolled, $uploadtime, $thumb, $prereq, $eventlink, $visivlity, $extra);
    while($stmt->fetch()){
    if($thumb == null){
      $thumb = './admin/coursethumb/coursethumb113.png';
    }
        $output .= '
<div class="row product">
            <div class="img col-md-4"><img src="'.$thumb.'" alt=""></div>
            <div class="details col-md-6">
              <h4>'.$title.'</h4>
              <h5>'.$topic.'</h5>
              <p>'.$content.'</p> '.$organizer.' <span> Date-'.$eventdate.'</span><span> Time - '.$eventtime.'</span>
            </div>
            <div class="price col-md-2">
              <h6><a href="#" style="color: rgba(255, 86, 0, 1); text-decoration:none;">Enroll Now <i class="fas fa-chevron-right"></i> </a></h6>
            </div>
          </div>';
    }
} else{
  $output = "No Events, Please Visit Later";
}
 echo $output;
}
elseif(isset($_POST['subscribe_btn'])){
$role = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['Role'], ENT_QUOTES));
$extra='show';
$username=mysqli_real_escape_string($con, htmlspecialchars($_POST['event_rusername'], ENT_QUOTES));
$event_id=mysqli_real_escape_string($con, htmlspecialchars($_POST['event_id'], ENT_QUOTES));
$event_date=mysqli_real_escape_string($con, htmlspecialchars($_POST['event_date'], ENT_QUOTES));
$event_time=mysqli_real_escape_string($con, htmlspecialchars($_POST['event_time'], ENT_QUOTES));
$nameIs=mysqli_real_escape_string($con, htmlspecialchars($_POST['studentname'], ENT_QUOTES));
$phoneIs=mysqli_real_escape_string($con, htmlspecialchars($_POST['studentphone'], ENT_QUOTES));
$eventNameis=mysqli_real_escape_string($con, htmlspecialchars($_POST['eventName'], ENT_QUOTES));
    if(isset($_POST['event_userole']) && $role == "student"){
        $sql = "INSERT INTO student_subs_event (eventId, eventName, emailIs, dateIs, timeIs, nameIs, phoneIs, extra) VALUES ('$event_id','$eventNameis','$username','$event_date','$event_time','$nameIs','$phoneIs','$extra');";
         if ($con->query($sql)===TRUE){
            $_SESSION['eventID']=$event_id;
            echo "Successfully Subscribed";
          } else {
            echo "Error";
          }
    }if(isset($_POST['event_userole']) && $role == "teacher"){
        $sql = "INSERT INTO teacher_subs_event (eventId, eventName, emailIs, dateIs, timeIs, nameIs, phoneIs, extra) VALUES ('$event_id','$eventNameis','$username','$event_date','$event_time','$nameIs','$phoneIs','$extra');";
         if ($con->query($sql)===TRUE){
            $_SESSION['eventID']=$event_id;
            echo "Successfully Subscribed";
          } else {
            echo "Error";
          }
    }
  }