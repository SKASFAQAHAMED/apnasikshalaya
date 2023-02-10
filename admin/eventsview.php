<?php

include_once("../sn/con.php");

session_start();

if(isset($_POST['user']) && isset($_POST['pass'])) {

	$user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));

	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));

} elseif(isset($_SESSION['user']) && isset($_SESSION['pass'])) {

	$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));

	$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));

} else {

	header('Location: index.php?error=user');

      	exit();

}





if(isset($_POST['checking_viewbtn'])){

    $event_id=$_POST['event_id'];

$sql = "SELECT * FROM apna_Events WHERE id = ?;";

$stmt = $con->stmt_init();

$stmt->prepare($sql);

$stmt->bind_param("i", $event_id);

$stmt->execute();

$stmt->store_result();

$stmt->bind_result($id, $title, $topic, $content, $organize, $keywords, $eventdate, $eventtime, $views, $enrolled, $uploadtime, $previewvideo, $prereq, $eventlink, $visivlity,$extra);

if($stmt->num_rows() == 1){

$stmt->fetch();

        echo '

        <h5> TITLE : '.$title.'</h5>

        <h5> TOPIC. : '.$topic.'</h5>

        <h5> CONTENT : '.$content.'</h5>

        <h5> ORGANIZER : '.$organize.'</h5>

        <h5> KEYWORDS : '.$keywords.'</h5>

        <h5> EVENT DATE : '.$eventdate.'</h5>

        <h5> EVENT TIME : '.$eventtime.'</h5>

        <h5> VIEWS : '.$views.'</h5>

        <h5> STUDENTS ENROLLED : '.$enrolled.'</h5>

        <h5> UPLOAD TIME : '.$uploadtime.'</h5>

        <h5> PREVIEW VIDEO LINK : '.$previewvideo.'</h5>

        <h5> PREREQUISITES: '.$prereq.'</h5>

        <h5> EVENT LINK : '.$eventlink.'</h5>

        <h5> VISIBILITY : '.$visivlity.'</h5>

        <h5> EXTRA : '.$extra.'</h5>

        ';

}

else{

    echo "<h3>No records were found</h3>";

}

}

if(isset($_POST['checking_edit_btn'])){

    $event_id=$_POST['event_id'];

    $result_array=[];

    $query = "SELECT * FROM apna_Events WHERE id='$event_id' ";

    $query_run = mysqli_query($con,$query);

    if(mysqli_num_rows($query_run)>0){

        foreach($query_run as $row){

            array_push($result_array,$row);

            header('content-type: application/json');

            echo json_encode($result_array);

        }

    }else{

        echo '<h4>no records were found</h4>';

    }

     }





     if(isset($_POST['update_events'])){

        $Eid = $_POST['Eid'];

        $title = $_POST['title'];

        $topic = $_POST['topic'];

        $content = $_POST['content'];

        $organizer = $_POST['organizer'];

        $keywords = $_POST['keywords'];

        $eventdate = $_POST['eventdate'];

        $eventtime = $_POST['eventtime'];

        $pvid = $_POST['pvid'];

        $prereq = $_POST['prereq'];

        $eventlink = $_POST['eventlink'];

        $visi = $_POST['visi'];

        $extra = $_POST['extra'];

        $sql = "UPDATE apna_Events SET titleIs=?, topicIs=?, contentIs=?,organizerIs = ?, keywordIs=?,  eventDate=?, eventTime=?, previewVideo=?, prereqIs=?, eventLink=?, visibleIs=?, extra=? WHERE id=?";

        $updateStatement = mysqli_prepare($con,$sql);

        mysqli_stmt_bind_param($updateStatement, 'ssssssssssssi',$title,$topic,$content, $organizer, $keywords, $eventdate, $eventtime, $pvid, $prereq, $eventlink, $visi, $extra,$Eid);

        if(mysqli_stmt_execute($updateStatement)){

            header('Location: events.php?action=view');

        }else{

            echo'error';

        }

        

     }

     if(isset($_POST['delete_event'])){

        $id = $_POST['event_id'];

        $sql = "UPDATE apna_Events SET extra = ? WHERE id = ?;";

        $stmt = $con->stmt_init();

        $stmt->prepare($sql);

        $stmt->bind_param("si", $hide, $id);

        $stmt->execute();

        header("Location:https://apnasikshalaya.com/admin/teacher.php?action=view");

        exit();

        }

       







        // if(isset($_POST['checking_sendbtn'])){

        // $event_id=$_POST['event_id'];

        // $sql = "SELECT * FROM student_subs_event WHERE eventId = ?;";

        // $stmt = $con->stmt_init();

        // $stmt->prepare($sql);

        // $stmt->bind_param("i", $event_id);

        // if($stmt->execute()){

        //     $stmt->store_result();

        //     $stmt->bind_result($id, $eventId, $eventName, $emailIs, $dateIs, $timeIs, $nameIs, $phoneIs, $eventLinkIs, $extra);

        //     $listofusers=[];

        //     while($stmt->fetch()){

        //         array_push($listofusers,$emailIs);

        //     }

            // $event_id=$_POST['event_id'];

            // $sql = "SELECT * FROM teacher_subs_event WHERE eventId = ?;";

            // $stmt = $con->stmt_init();

            // $stmt->prepare($sql);

            // $stmt->bind_param("i", $event_id);

            // if($stmt->execute()){

            //     $stmt->store_result();

            //     $stmt->bind_result($id, $eventId, $emailIs, $dateIs, $timeIs, $extra);

            //     // while($stmt->fetch()){

            //     //     array_push($listofusers,$emailIs);

    

            //     // }

            // }    

    //         header('content-type: application/json');

    //         echo json_encode($listofusers);

    //     }else{

    //         echo'There was an error';

    //     }

       

    // }

    if(isset($_POST['sendmail'])){

        $event_id=$_POST['event_id'];

        $event_link=$_POST['eventlink'];

        $sql = "SELECT * FROM student_subs_event WHERE eventId = ?;";

        $stmt = $con->stmt_init();

        $stmt->prepare($sql);

        $stmt->bind_param("s", $event_id);

        if($stmt->execute()){

            $stmt->store_result();

            $stmt->bind_result($id, $eventId, $eventName, $emailIs, $dateIs, $timeIs, $nameIs, $phoneIs, $eventLinkIs, $extra);

            $listofusers=[];

            while($stmt->fetch()){

                array_push($listofusers,$emailIs);

            }

    }
        $event_id=$_POST['event_id'];

        $event_link=$_POST['eventlink'];

        $sql = "SELECT * FROM teacher_subs_event WHERE eventId = ?;";

        $stmt = $con->stmt_init();

        $stmt->prepare($sql);

        $stmt->bind_param("s", $event_id);

        if($stmt->execute()){

            $stmt->store_result();

            $stmt->bind_result($id, $eventId, $eventName, $emailIs, $dateIs, $timeIs, $nameIs, $phoneIs, $eventLinkIs, $extra);

            $listofusers=[];

            while($stmt->fetch()){

                array_push($listofusers,$emailIs);

            }

    }





    $emails = implode(',', $listofusers);

    $event_id=$_POST['event_id'];

    $subject = "Event Information";

    $body = "Thank you for subscribing to the Event these are the following details the date of the 

    event is '.$dateIs.' and time of the event is '.$timeIs.' and the link of the Event is '.$event_link.'";

    $headers = "From: no_reply@apnasikshalaya.com" . "\r\n" ."CC: rs@crio77.com";

    if(mail($emails, $subject, $body, $headers)){

        echo "mails sent successfully";

    }else{

        echo"Sorry there was a problem";

    }

}

