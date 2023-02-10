<?php
include_once("./sn/con.php");
session_start();

if(isset($_POST['choosingsub'])){
    $typeIs = $_POST['typeoftuition'];
    if($typeIs=="offline"){
        $on = "on";
        $sql = "SELECT DISTINCT subjectIs  FROM apnaTeachers WHERE tuitionServiceIs = ?;";
        $list= [];
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $on);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($subjects);
        while($stmt->fetch()){
            array_push($list, $subjects);
        }
        echo json_encode($list);
    }else{
        $on = "show";
        $sql = "SELECT DISTINCT subjectIs  FROM onlineTeacherTuition ;";
        $list= [];
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($subjects);
        while($stmt->fetch()){
            array_push($list, $subjects);
        }
        echo json_encode($list);
    }
}

if(isset($_POST['showcontent'])){
    $typeIs = $_POST['typeoftuition'];
    $subis = $_POST['subis'];
    $on = 'on';
    if($typeIs=="offline"){
        // echo $typeIs." ".$subis;
         $sql = "SELECT * FROM apnaTeachers WHERE tuitionServiceIs=? AND subjectIs = ?;";
         $stmt = $con->stmt_init();
         $stmt->prepare($sql);
         $stmt->bind_param("ss", $on,$subis);
         $stmt->execute();
         $stmt->store_result();
         $total_row = $stmt->num_rows();
         if($total_row > 0){
            $stmt->bind_result($id, $googleid, $name, $gender, $contact, $dob, $altContact, $email, $password, $address, $addressline2, $city, $state, $district, $pin, $subject, $experience, $qualification, $certi, $proCourse, $tuitionservice, $resume, $ip, $verify, $extra, $lastlogin, $firstuploadtime, $thumbnail, $creditscore);
            while($stmt->fetch()){
                if($thumbnail == null){
                  $thumbnail = './admin/coursethumb/coursethumb113.png';
                }
                $output .= '
                <div class="swiper-slide">
                <a class="sendofflinetuitionpage" draggable="false" href="/search?query=Spoken English">
                <p class="teachersid" style="display:none;">'.$id.'</p>
                  <div class="product-item">
                    <img class ="offlineimg" draggable="false" src="'.$thumbnail.'" alt="">
                    <div class="down-content">
                      <h3>'.$subject.'</h3>
                      <p style="margin-top: 6px;"> Teacher Name :'.$name.'</p>
                      <p style="margin-top: 6px;"> Teacher Address :'.$address.'</p>
                      <p style="margin-top: 6px;"> Qualification :'.$qualification.'</p>
                    </div>
                  </div>
                </a>
              </div>
        ';
                }
         }else{
             $output = "No tuitions Found";
         }
         echo $output;
    }else{
        $sql = "SELECT * FROM onlineTeacherTuition WHERE subjectIs = ?;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s",$subis);
        $stmt->execute();
        $stmt->store_result();
        $total_row = $stmt->num_rows();
        if($total_row > 0){
            $stmt->bind_result($id, $Tid, $icon, $teacherEmail, $tuitionName, $tdescription, $gradeIs, $boardIs, $subjectIs, $secondarysubIs, $speciIs, $hourIs, $weekdaysIs, $extra);
           while($stmt->fetch()){
               if($icon == null){
                 $icon = './admin/coursethumb/coursethumb113.png';
               }
               $output .= '
               <div class="swiper-slide">
               <a class="sendonlinetuitionpage"  draggable="false" href="/search?query=Spoken English">
               <p class="teacherid" style="display:none;">'.$Tid.'</p>
                 <div class="product-item">
                   <img class ="offlineimg" draggable="false" src="'.$icon.'" alt="">
                   <div class="down-content">
                     <h3>'.$subject.'</h3>
                     <p style="margin-top: 6px;"> Tuition Name :'.$tuitionName.'</p>
                     <p style="margin-top: 6px;"> Days in a Week :'.$weekdaysIs.'</p>
                     <p style="margin-top: 6px;">:'.$tdescription.'</p>
                   </div>
                 </div>
               </a>
             </div>
       ';
               }
        }else{
            $output = "No tuitions Found";
        }
        echo $output;
    }
}
