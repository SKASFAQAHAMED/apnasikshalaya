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

    $teachers_id=$_POST['teacher_id'];

$sql = "SELECT * FROM apnaTeachers WHERE id = ?;";

$stmt = $con->stmt_init();

$stmt->prepare($sql);

$stmt->bind_param("i", $teachers_id);

$stmt->execute();

$stmt->store_result();

$stmt->bind_result($id, $name, $gender, $contact, $dob, $altContact,  $email, $pass, $address, $city, $state, $pin, $subject, $exp, $qualification, $certificationCourse, $professionalCourse,  $tuition, $resume, $ip, $verify, $extra,$lastlogin, $firstupload, $thumbnail, $creditscore);

if($stmt->num_rows() == 1){

$stmt->fetch();

        echo '

        <h5> NAME : '.$name.'</h5>

        <h5> Alternate no. : '.$altContact.'</h5>

        <h5> Date of birth : '.$dob.'</h5>

        <h5> Address : '.$address.'</h5>

        <h5> City : '.$city.'</h5>

        <h5> State : '.$state.'</h5>

        <h5> Pin : '.$pin.'</h5>

        <h5> Educational Qualification : '.$quality.'</h5>

        <h5> Institute : '.$institute.'</h5>

        <h5> Interested in test series : '.$test.'</h5>

        <h5> Interested in tuition services : '.$tuition.'</h5>

        <h5> Professional courses : '.$professionalCourse.'</h5>

        <h5> Certification courses : '.$certificationCourse.'</h5>

        <h5> IP address : '.$ip.'</h5>

        <h5> Verification : '.$verify.'</h5>

        <h5> Lastlogin : '.$lastlogin.'</h5>

        <h5> First Login : '.$firstupload.'</h5>

        <h5> Credit-Score : '.$creditscore.'</h5>

        ';

}

else{

    echo "<h3>No records were found</h3>";

}

}





if(isset($_POST['checking_edit_btn'])){

    $teacher_id=$_POST['teacher_id'];

    $result_array=[];

    $query = "SELECT * FROM apnaTeachers WHERE id='$teacher_id' ";

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

    

     if(isset($_POST['update_teacher'])){

        $Eid = $_POST['Eid'];

        $Ename = $_POST['Ename'];

        $Egender = $_POST['Egender'];

        $Econtact = $_POST['Econtact'];

        $Edob = $_POST['Edob'];

        $Ealtcontact = $_POST['Ealtcontact'];

        $Eemail = $_POST['Eemail'];

        $Epassword = $_POST['Epassword'];

        $Eaddress = $_POST['Eaddress'];

        $Ecity = $_POST['Ecity'];

        $Estate = $_POST['Estate'];

        $Epin = $_POST['Epin'];

        $Esubjects = $_POST['Esubjects'];

        $Eexperience = $_POST['Eexperience'];

        $Equali = $_POST['Equali'];

        $Ecerti = $_POST['Ecerti'];

        $Eprocourse = $_POST['Eprocourse'];

        $Etuition = $_POST['Etuition'];

        $Everification = $_POST['Everification'];

        $sql = "UPDATE apnaTeachers SET nameIs=?, genderIs=?, contactIs=?,dobIs = ?, altContactIs=?,  emailIs=?, passIs=?, addressIs=?, cityIs=?, stateIs=?, pinIs=?, subjectIs=?, expIs=?, qualificationIs=?, certificationCourseIs=?, professionalCourseIs=?, tuitionServiceIs=?, verifyIs=?  WHERE id=?";

        $updateStatement = mysqli_prepare($con,$sql);

        mysqli_stmt_bind_param($updateStatement, 'ssssssssssssssssssi',$Ename,$Egender,$Econtact, $Edob, $Ealtcontact, $Eemail, $Epassword, $Eaddress, $Ecity, $Estate, $Epin, $Esubjects,$Eexperience,$Equali,$Ecerti,$Eprocourse,$Etuition,$Everification,$Eid);

        if(mysqli_stmt_execute($updateStatement)){

            header('Location: teacher.php?action=view');

        }else{

            echo'error';

        }

        

     }

     if(isset($_POST['delete_teacher'])){

    $id = $_POST['teacher_id'];

    $sql = "UPDATE apnaTeachers SET extra = ? WHERE id = ?;";

    $stmt = $con->stmt_init();

    $stmt->prepare($sql);

    $stmt->bind_param("si", $hide, $id);

    $stmt->execute();

    header("Location:./teacher.php?action=view");

    exit();

    }

   

    if(isset($_POST['search'])){

        $search=$_POST['search'];

        if($search!=''){

            $sql="SELECT nameIs, contactIs, emailIs from apnaTeachers WHERE nameIs like '%$search%' OR contactIs like '%$search%' OR emailIs like '%$search%';";

        $stmt=$con->stmt_init();

        $stmt->prepare($sql);

        $stmt->execute();

        $stmt->store_result();

        if($stmt->num_rows() > 0) {

        echo  '<table class="table table-bordered"><thead>

                <tr>

                    <th>Name</th>

                    <th>Contact</th>

                    <th>Email</th>

                  </tr>

                </thead>';

        $stmt->bind_result($name, $contact, $email);

        while($stmt->fetch()) {

            echo '<tr>

                    <td>'.$name.'</td>

                    <td>'.$contact.'</td>

                    <td>'.$email.'</td>

                  </tr>';

            }

            echo '</table>';	

        }else{

            echo "Data not found";

        }

        }

         }





         if(isset($_POST['export_excel'])){

            $sql = "SELECT * FROM apnaTeachers ORDER BY id DESC";

            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result)>0){

                $output.='

                <table class="table">

                <tr>

                 <th>ID</th>

                 <th>NAME</th>

                 <th>GENDER</th>

                 <th>CONTACT NO.</th>

                 <th>DATE OF BIRTH</th>

                 <th>ALTERNATE CONTACT NO.</th>

                 <th>EMAIL</th>

                 <th>ADDRESS</th>

                 <th>CITY</th>

                 <th>STATE</th>

                 <th>PIN-CODE</th>

                 <th>SUBJECT</th>

                 <th>EXPERIENCE</th>

                 <th>QUALIFICATION</th>

                 <th>CERTIFICATION COURSE</th>

                 <th>PROFESSIONAL COURSE</th>

                 <th>TUITION SERVICE</th>

                 <th>IP ADDRESS</th>

                 <th>LAST LOGIN</th>

                 <th>FIRST JOINING DATE</th>

                 <th>CREDIT-SCORE</th>

                </tr>

                ';

                while($row = mysqli_fetch_array($result)){

                    $output.='

                    <tr>

                     <td>'.$row["id"].'</td>

                     <td>'.$row["nameIs"].'</td>

                     <td>'.$row["genderIs"].'</td>

                     <td>'.$row["contactIs"].'</td>

                     <td>'.$row["dobIs"].'</td>

                     <td>'.$row["altContactIs"].'</td>

                     <td>'.$row["emailIs"].'</td>

                     <td>'.$row["addressIs"].'</td>

                     <td>'.$row["cityIs"].'</td>

                     <td>'.$row["stateIs"].'</td>

                     <td>'.$row["pinIs"].'</td>

                     <td>'.$row["subjectIs"].'</td>

                     <td>'.$row["expIs"].'</td>

                     <td>'.$row["qualityIs"].'</td>

                     <td>'.$row["certificationCourseIs"].'</td>

                     <td>'.$row["professionalCourseIs"].'</td>

                     <td>'.$row["tuitionServiceIs"].'</td>

                     <td>'.$row["ipIs"].'</td>

                     <td>'.$row["lastloginIs"].'</td>

                     <td>'.$row["firstUploadTime"].'</td>

                     <td>'.$row["creditScore"].'</td>

                    </tr>

                    ';

                }

                $output .='</table>';

                $fileName = date('Y-m-d').'teacher data.xlsx';

                header("Content-Type: application/xls");

                header("Content-Disposition: attachment; filename=$fileName");

                echo $output;

            }

        

        }

        
///////////////-----------------below code is used for userprofileinfo page---------///////////////

if(isset($_POST['checking_edit_profile'])){

    $teacher_email=$_POST['teacher_email'];

    $result_array=[];

    $query = "SELECT * FROM apnaTeachers WHERE emailIs='$teacher_email' ";

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
        

     if(isset($_POST['update_teacherprofile'])){

        $Eid = $_POST['Eid'];

        $Ename = $_POST['Ename'];

        $Egender = $_POST['Egender'];

        $Econtact = $_POST['Econtact'];

        $Edob = $_POST['Edob'];

        $Ealtcontact = $_POST['Ealtcontact'];

        $Eemail = $_POST['Eemail'];

        $Epassword = $_POST['Epassword'];

        $Eaddress = $_POST['Eaddress'];
        $Ealtaddress = $_POST['Ealtaddress'];

        $Ecity = $_POST['Ecity'];

        $Estate = $_POST['Estate'];
        $Edistrict = $_POST['Edistrict'];

        $Epin = $_POST['Epin'];

        $Esubjects = $_POST['Esubjects'];

        $Eexperience = $_POST['Eexperience'];

        $Equali = $_POST['Equali'];

        $Ecerti = $_POST['Ecerti'];

        $Eprocourse = $_POST['Eprocourse'];

        $Etuition = $_POST['Etuition'];

        $Everification = $_POST['Everification'];

        $sql = "UPDATE apnaTeachers SET nameIs=?, genderIs=?, contactIs=?,dobIs = ?, altContactIs=?,  emailIs=?, passIs=?, addressIs=?, addressline2=?, cityIs=?, stateIs=?, districtIs=?, pinIs=?, subjectIs=?, expIs=?, qualificationIs=?, certificationCourseIs=?, professionalCourseIs=?, tuitionServiceIs=?, verifyIs=?  WHERE id=?";

        $updateStatement = mysqli_prepare($con,$sql);

        mysqli_stmt_bind_param($updateStatement, 'ssssssssssssssssssssi',$Ename,$Egender,$Econtact, $Edob, $Ealtcontact, $Eemail, $Epassword, $Eaddress, $Ealtaddress, $Ecity, $Edistrict, $Estate, $Epin, $Esubjects,$Eexperience,$Equali,$Ecerti,$Eprocourse,$Etuition,$Everification,$Eid);

        if(mysqli_stmt_execute($updateStatement)){

            header('Location: teacher.php?action=view');

        }else{

            echo'error';

        }

        

     }
    

        ?>



