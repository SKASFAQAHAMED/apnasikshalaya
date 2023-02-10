<?php

include_once("../sn/con.php");

session_start();

if (isset($_POST['user']) && isset($_POST['pass'])) {

   $user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));

   $pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));

} elseif (isset($_SESSION['user']) && isset($_SESSION['pass'])) {

   $user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));

   $pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));

} else {

   header('Location: index.php?error=user');

   exit();

}

if(isset($_POST['terms_upload'])){

    $heading = mysqli_real_escape_string($con, htmlspecialchars($_POST['heading'], ENT_QUOTES));

    $content = mysqli_real_escape_string($con, htmlspecialchars($_POST['content'], ENT_QUOTES));

    $type = mysqli_real_escape_string($con, htmlspecialchars($_POST['type'], ENT_QUOTES));

    $extra = "valid";

    $sql = "INSERT INTO apnaTermsPrivacy (typeIs,headingIs,contentIs,extra) VALUES(?,?,?,?);";

    $stmt = $con->stmt_init();

    $stmt->prepare($sql);

    $stmt->bind_param("ssss",$type,$heading,$content,$extra);

    if($stmt->execute()){

        header('Location: allcontentchange.php?action=view');

    }else{

        echo'error';

    }



}
if(isset($_POST['typeis'])){
$typeIs = $_POST['typeis'];
$sql = "SELECT headingIs FROM apnaTermsPrivacy WHERE typeIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("s", $typeIs);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($heading);
$index = 1;
while ($row=$stmt->fetch()) {
 $output .= '<div class="pandb"> <p class = " contenteditor" contenteditable>'.$heading.'<p> <button type="button" class="btn btn-primary editbtn" contenteditable="false">See its content</button> </div>';
} 
echo $output;
}

if(isset($_POST['realheading'])){
    $realheading = $_POST['realheading'];
    $editedheading = $_POST['editedheading'];
    $typeIs = $_POST['typeistype'];
    $sql2 = "UPDATE apnaTermsPrivacy SET headingIs = ? WHERE typeIs = ? AND headingIs = ?;";
			$stmt2 = $con->stmt_init();
			$stmt2->prepare($sql2);
			$stmt2->bind_param("sss", $editedheading, $typeIs,$realheading);
			if($stmt2->execute()){
                echo "success";
            }else{
                echo $realheading.$editedheading.$typeIs;
            }
}

if(isset($_POST['headingcontent'])){
    $heading = $_POST['headingcontent'];
    $typeIs = $_POST['typeisfrom'];
    $sql3 = "SELECT contentIs FROM apnaTermsPrivacy WHERE typeIs = ? AND headingIs = ?;";
			$stmt3 = $con->stmt_init();
			$stmt3->prepare($sql3);
			$stmt3->bind_param("ss", $typeIs, $heading);
			if($stmt3->execute()){
                $stmt3->store_result();
                $stmt3->bind_result($contentis);
                $stmt3->fetch();
                $outputis = "<h3 >Below is the content of header-<span id='headingofcontent'>".$heading."</span></h3><p id='txt_name' contenteditable>".$contentis."</p>";
                echo $outputis;
            }else{
                echo "error";
            }
}
if(isset($_POST['typiscontent'])){
    $headingofco = $_POST['headingofco'];
    $typiscontent = $_POST['typiscontent'];
    $contentis = $_POST['contentis'];
    $sql2 = "UPDATE apnaTermsPrivacy SET contentIs = ? WHERE typeIs = ? AND headingIs = ?;";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("sss", $contentis, $typiscontent,$headingofco);
    if($stmt2->execute()){
        echo "success";
    }else{
        echo"there was an error";
    }
}
?>