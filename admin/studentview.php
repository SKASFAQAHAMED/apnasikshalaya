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

	header('Location: login.php?error=user');

      	exit();

}



if(isset($_POST['checking_viewbtn'])){

    $eml=$_POST['student_email'];

$sql = "SELECT * FROM apnaStudents WHERE emailIs = ?;";

$stmt = $con->stmt_init();

$stmt->prepare($sql);

$stmt->bind_param("s", $eml);

$stmt->execute();

$stmt->store_result();

$stmt->bind_result($id, $name, $gender, $contact, $altContact, $dob, $email, $pass, $address, $city, $state, $pin, $quality, $institute, $test, $tuition, $professionalCourse, $certificationCourse, $competitiveCourse, $crashCourse, $studyMaterial, $verify, $ip, $extra,$lastlogin, $firstupload, $thumbnail, $creditscore);

if($stmt->num_rows() == 1){

$stmt->fetch();

if($verify==1){

    $style="'color: green;'";

    $verify="verified";

}else{

    $style="'color: red;'";

}

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

        <h5> Interested in professional courses : '.$professionalCourse.'</h5>

        <h5> Interested in certification courses : '.$certificationCourse.'</h5>

        <h5> Interested in competitive courses : '.$competitiveCourse.'</h5>

        <h5> Interested in crash courses : '.$crashCourse.'</h5>

        <h5> Interested in study materials : '.$studyMaterial.'</h5>

        <h5> IP address : '.$ip.'</h5>

        <h5 id ="verification" style='.$style.'> Verification : '.$verify.'</h5>

        <h5> Lastlogin : '.$lastlogin.'</h5>

        <h5> First Login : '.$firstupload.'</h5>

        <h5> Credit-Score : '.$creditscore.'</h5>

        ';

}

else{

    echo "<h3>No records were found</h3>";

}

}

// the below is code is used for updating 



if(isset($_POST['checking_edit_btn'])){

$eml=$_POST['student_email'];

$result_array=[];

$query = "SELECT * FROM apnaStudents WHERE emailIs='$eml' ";

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



 if(isset($_POST['update_student'])){

    $Eid = $_POST['Eid'];

    $Ename = $_POST['Ename'];

    $Egender = $_POST['Egender'];

    $Econtact = $_POST['Econtact'];

    $Ealtcontact = $_POST['Ealtcontact'];

    $Edob = $_POST['Edob'];

    $Eemail = $_POST['Eemail'];

    $Epassword = $_POST['Epassword'];

    $Eaddress = $_POST['Eaddress'];

    $Ecity = $_POST['Ecity'];

    $Estate = $_POST['Estate'];

    $Epin = $_POST['Epin'];

    $Equality = $_POST['Equality'];

    $Einstitute = $_POST['Einstitute'];

    $Etest = $_POST['Etest'];

    $Etuition = $_POST['Etuition'];

    $Eprof = $_POST['Eprof'];

    $Ecerti = $_POST['Ecerti'];

    $Ecompete = $_POST['Ecompete'];

    $Ecrash = $_POST['Ecrash'];

    $Ematerials = $_POST['Ematerials'];

    $Everification = $_POST['Everification'];

    $sql = "UPDATE apnaStudents SET nameIs=?, genderIs=?, contactIs=?, altContactIs=?, dobIs = ?, emailIs=?, passIs=?, addressIs=?, cityIs=?, stateIs=?, pinIs=?, qualityIs=?, instituteIs = ?,testSeriesIs = ?,tuitionServiceIs = ?,professionalCourseIs = ?,certificationCourseIs = ?,competitiveCourseIs = ?,crashCourseIs = ?,studyMaterialIs = ?, verifyIs=? WHERE id=?";

    $updateStatement = mysqli_prepare($con,$sql);

    mysqli_stmt_bind_param($updateStatement, 'sssssssssssssssssssssi',$Ename,$Egender,$Econtact,$Ealtcontact, $Edob, $Eemail, $Epassword, $Eaddress, $Ecity, $Estate, $Epin, $Equality, $Einstitute, $Etest, $Etuition, $Eprof, $Ecerti, $Ecompete, $Ecrash,$Ematerials,$Everification, $Eid);

    if(mysqli_stmt_execute($updateStatement)){

        header('Location: student.php?action=view');

    }else{

        echo'error';

    }

    

 }

if(isset($_POST['search'])){

$search=$_POST['search'];

if($search!=''){

	$sql="SELECT nameIs, contactIs, emailIs from apnaStudents WHERE nameIs like '%$search%' OR contactIs like '%$search%' OR emailIs like '%$search%';";

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

 if(isset($_POST['delete_student'])){

     $email = $_POST['student_email'];

     $query = "DELETE FROM apnaStudents WHERE emailIs = '$email' ";

     $query_run = mysqli_query($con,$query);

     if($query_run){

        echo 'Deleted';

        header("location:./student.php?action=view");

     }else{

        echo'Something went wrong';

     }

 }

if(isset($_POST['export_excel'])){

    $gender = mysqli_real_escape_string($con, htmlspecialchars($_POST['gender'], ENT_QUOTES));

    $fromDate = mysqli_real_escape_string($con, htmlspecialchars($_POST['fromDate'], ENT_QUOTES));

    $toDate = mysqli_real_escape_string($con, htmlspecialchars($_POST['toDate'], ENT_QUOTES));

    	$sql = "SELECT * FROM apnaStudents ORDER BY id DESC;";

    $result = mysqli_query($con, $sql);

        $output.='

        <table class="table">

        <tr>

         <th>ID</th>

         <th>NAME</th>

         <th>GENDER</th>

         <th>CONTACT NO.</th>

         <th>ALTERNATE CONTACT NO.</th>

         <th>DATE OF BIRTH</th>

         <th>EMAIL</th>

         <th>ADDRESS</th>

         <th>CITY</th>

         <th>STATE</th>

         <th>PIN-CODE</th>

         <th>QUALIFICATION</th>

         <th>INSTITUTE</th>

         <th>TEST SERIES</th>

         <th>TUITION SERVICE</th>

         <th>PROFESSIONAL COURSE</th>

         <th>CERTIFICATION COURSE</th>

         <th>COMPETETIVE COURSE</th>

         <th>CRASH COURSE</th>

         <th>STUDY MATERIAL</th>

         <th>IP ADDRESS</th>

         <th>LAST LOGIN</th>

         <th>FIRST JOINING DATE</th>

         <th>CREDIT-SCORE</th>

        </tr>

        ';

        if(mysqli_num_rows($result)>0){

        while($row = mysqli_fetch_array($result)){

            $output .='

            <tr>

             <td>'.$row["id"].'</td>

             <td>'.$row["nameIs"].'</td>

             <td>'.$row["genderIs"].'</td>

             <td>'.$row["contactIs"].'</td>

             <td>'.$row["altContactIs"].'</td>

             <td>'.$row["dobIs"].'</td>

             <td>'.$row["emailIs"].'</td>

             <td>'.$row["addressIs"].'</td>

             <td>'.$row["cityIs"].'</td>

             <td>'.$row["stateIs"].'</td>

             <td>'.$row["pinIs"].'</td>

             <td>'.$row["qualityIs"].'</td>

             <td>'.$row["instituteIs"].'</td>

             <td>'.$row["testSeriesIs"].'</td>

             <td>'.$row["tuitionServiceIs"].'</td>

             <td>'.$row["professionalCourseIs"].'</td>

             <td>'.$row["certificationCourseIs"].'</td>

             <td>'.$row["competitiveCourseIs"].'</td>

             <td>'.$row["crashCourseIs"].'</td>

             <td>'.$row["studyMaterialIs"].'</td>

             <td>'.$row["ipIs"].'</td>

             <td>'.$row["lastloginIs"].'</td>

             <td>'.$row["firstUploadTime"].'</td>

             <td>'.$row["creditScore"].'</td>

            </tr>

            ';

        }

    }

    $output .='</table>';

        $fileName = date('Y-m-d').' student data.xlsx';

        header("Content-Type: application/xlsx");

        header("Content-Disposition: attachment; filename=$fileName");

        header("Pragma: no-cache");

        header("Expires: 0");

        echo $output;

}

///////////////////////////////Below data is coming from userprofileinfo//////////////////////////


if(isset($_POST['profile_edit_btn'])){

    $eml=$_POST['student_email'];
    
    $result_array=[];
    
    $query = "SELECT * FROM apnaStudents WHERE emailIs='$eml' ";
    
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



     if(isset($_POST['update_student_profile'])){
        $Eid = $_POST['Eid'];
        $Ename = $_POST['Ename'];
        $Egender = $_POST['Egender'];
        $Econtact = $_POST['Econtact'];
    
        $Ealtcontact = $_POST['Ealtcontact'];
    
        $Edob = $_POST['Edob'];
    
        $Eemail = $_POST['Eemail'];
    
        $Epassword = $_POST['Epassword'];
    
        $Eaddress = $_POST['Eaddress'];
        $Ealtaddress = $_POST['Ealtaddress'];
    
        $Ecity = $_POST['Ecity'];
    
        $Estate = $_POST['Estate'];
        $Edistrict = $_POST['Edistrict'];
    
        $Epin = $_POST['Epin'];
    
        $Equality = $_POST['Equality'];
    
        $Einstitute = $_POST['Einstitute'];
    
        $Etest = $_POST['Etest'];
    
        $Etuition = $_POST['Etuition'];
    
        $Eprof = $_POST['Eprof'];
    
        $Ecerti = $_POST['Ecerti'];
    
        $Ecompete = $_POST['Ecompete'];
    
        $Ecrash = $_POST['Ecrash'];
    
        $Ematerials = $_POST['Ematerials'];
    
        $Everification = $_POST['Everification'];
    
        $sql = "UPDATE apnaStudents SET nameIs=?, genderIs=?, contactIs=?, altContactIs=?, dobIs = ?, emailIs=?, passIs=?, addressIs=?, addressline2=?,  cityIs=?, stateIs=?, districtIs=?, pinIs=?, qualityIs=?, instituteIs = ?,testSeriesIs = ?,tuitionServiceIs = ?,professionalCourseIs = ?,certificationCourseIs = ?,competitiveCourseIs = ?,crashCourseIs = ?,studyMaterialIs = ?, verifyIs=? WHERE id=?";
    
        $updateStatement = mysqli_prepare($con,$sql);
    
        mysqli_stmt_bind_param($updateStatement, 'sssssssssssssssssssssssi',$Ename,$Egender,$Econtact,$Ealtcontact, $Edob, $Eemail, $Epassword, $Eaddress, $Ealtaddress, $Ecity, $Estate, $Edistrict, $Epin, $Equality, $Einstitute, $Etest, $Etuition, $Eprof, $Ecerti, $Ecompete, $Ecrash,$Ematerials,$Everification, $Eid);
    
        if(mysqli_stmt_execute($updateStatement)){
    
            header('Location: /userprofileinfo.php?desig=student&email='.$Eemail.'');
    
        }else{
    
            echo'error';
    
        }
    
        
    
     }

?>

