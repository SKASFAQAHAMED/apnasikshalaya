<?php
include_once("../sn/con.php");
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
} elseif(isset($_POST['user']) && isset($_POST['pass'])) {
	$user = mysqli_real_escape_string($con, htmlspecialchars($_POST['user'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
} else {
	header('Location: index.php?error=user');
      	exit();
}
$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
$show = "show";
$sql = "SELECT * FROM apnaCourses WHERE id = ?;";
$stmt = $con->stmt_init();
$stmt-> prepare($sql);
$stmt-> bind_param("i",$id);
$stmt-> execute();
$stmt-> store_result();
if($stmt-> num_rows()!=0){
    $stmt-> bind_result($id, $title, $catagory, $subcata, $type, $shortdesc, $teacher, $language, $price, $longdesc, $preview, $hour, $chapter, $certi, $bestfor, $thumbnail, $ipaddress, $datetime, $extra);
    $stmt-> fetch();
    $sql2 = "SELECT DISTINCT sectionIs FROM apnaVideos WHERE courseId = ? && verifyIs = ? && extra = ?;";
    $stmt2 = $con->stmt_init();
    $stmt2->prepare($sql2);
    $stmt2->bind_param("iss", $id, $show, $show);
    $stmt2->execute();
    $stmt2->store_result();
    $noOfSection = $stmt2->num_rows();
    $sql3 = "SELECT id FROM apnaVideos WHERE courseId = ? && verifyIs = ? && extra = ?;";
    $stmt3 = $con->stmt_init();
    $stmt3->prepare($sql3);
    $stmt3->bind_param("iss", $id, $show, $show);
    $stmt3->execute();
    $stmt3->store_result();
    $noOfChapter = $stmt3->num_rows();
    echo'<html>
    <head>
        <title>Apna Sikshalaya Admin | Courses</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <style>
        </style>
    </head>
    <body>
    <div class="modal fade" id="editCoursesectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCoursesectionModal">Section Details (Update/Edit)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action ="course_section_view.php" method="POST" enctype="multipart/form-data">
           <div class="modal-body">
              <input type="hidden" name ="Eid" id="edit_id">
              <input type="hidden" name ="Ecourseid" id="edit_courseid">
              <input type="hidden" name ="Esectionis" id="edit_sectionis">
              <div class = "form-group">
                  <label for="Etitle">Video title</label>
                  <input type="text" name ="Etitle" id="edit_title" class="form-control" placeholder="Add title">
              </div>
              <div class = "form-group">
                  <label for="Econtent">Video Content</label>
                  <input type="text" name ="Econtent" id="edit_content" class="form-control" placeholder="Add title">
              </div>
              <div class = "form-group">
                  <label for="Edesc">Video Description</label>
                  <input type="text" name ="Edesc" id="edit_desc" class="form-control" placeholder="Add title">
              </div>
              <div class = "form-group">
                  <label for="Evidno">Video number</label>
                  <input type="text" name ="Evidno" id="edit_vidno" class="form-control" placeholder="Add title">
              </div>
              <div class = "form-group">
                  <label for="Evidlink">Video Link</label>
                  <input type="text" name ="Evidlink" id="edit_vidlink" class="form-control" placeholder="Add title">
              </div>
              <div class = "form-group">
                  <label for="EfileIs">Attached File(if any)</label>
                  <input type="file" name ="EfileIs" id="edit_file" class="form-control" placeholder="Add title">
              </div>
           </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name ="update_section" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
      </div>
      <div class="container">
             <div class="row justify-content-center"> <h1>'.$title.'</h1>
    <p>'.$noOfSection.' sections • '.$noOfChapter.' lectures • '.$hour.' hours</p>
    </div>
    <table class="table table-striped w-auto">';
            $sql4 = "SELECT DISTINCT sectionIs FROM apnaVideos WHERE courseId = ? && verifyIs = ? && extra = ?;";
            $stmt4 = $con->stmt_init();
            $stmt4->prepare($sql4);
            $stmt4->bind_param("iss", $id, $show, $show);
            $stmt4->execute();
            $stmt4->store_result();
            $stmt4->bind_result($videoSection);
            while($stmt4->fetch()) {
                    $i = 1;
                    $sql5 = "SELECT id, titleIs, videoIs FROM apnaVideos WHERE sectionIs = ? && courseId = ? && verifyIs = ? && extra = ?;";
                    $stmt5 = $con->stmt_init();
                    $stmt5->prepare($sql5);
                    $stmt5->bind_param("ssss", $videoSection, $id, $show, $show);
                    $stmt5->execute();
                    $stmt5->store_result();
                    $stmt5->bind_result($vid, $vtitle, $vlink);
                    echo'
                    <tr>
                        
                        <th class="text-center">Section- '.$videoSection.' </th>
                        <th class="text-center"> Operations </th>
                    </tr>';

                    while($stmt5->fetch()) {
                echo '<tr> <td class="videosid" style="display:none;">'.$vid.' </td> <td class="text-center"> <a href="./admin/coursevideo/'.$vlink.'" target="_blank" style="display: block;"> &nbsp; '.$i.' &nbsp;'.$vtitle.'</a> </td> <td class="text-center"> <a href="#" class =" bg bg-info edit_btn"> Edit </a> </td> </tr>';
                $i++;
                }
                }
    echo'
    </table>
    </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function (){  
        $(".edit_btn").click(function (e){
          e.preventDefault();
          var vidid= $(this).closest("tr").find(".videosid").text();
          console.log(vidid)
          $.ajax({
            type:"POST",
            url:"course_section_view.php",
            data:{
              "checking_edit_btn":true,
              "vidid":vidid,
            },
            success: function (response){
              $.each(response, function(key, value){
                $("#edit_id").val(value["id"]);
                $("#edit_title").val(value["titleIs"]);
                $("#edit_content").val(value["contentIs"]);
                $("#edit_desc").val(value["descIs"]);
                $("#edit_vidno").val(value["videoNo"]);
                $("#edit_vidlink").val(value["videoLinkIs"]);
                $("#edit_file").val(value["fileIs"]);
                $("#edit_courseid").val(value["courseId"]);
                $("#edit_sectionis").val(value["sectionIs"]);
              });
              $("#editCoursesectionModal").modal("show");
            }
          });
        });
      });
    </script>
    </html>
    ';
}