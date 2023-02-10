<?php
include_once("../sn/con.php");
session_start();
if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
  $user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
  $pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
} else {
  header('Location: index.php?error=user');
  exit();
}

    if(isset($_POST['Blog_upload'])){
       
       $title = mysqli_real_escape_string($con, htmlspecialchars($_POST['Title'], ENT_QUOTES));
       $content = mysqli_real_escape_string($con, htmlspecialchars($_POST['content'], ENT_QUOTES));
       $sql = "INSERT INTO apnaBlogs (titleIs, contentIs, verifyIs) VALUES (?, ?,?);";
       echo $title;
       echo $content;
       $verifyIs = "show";
       $stmt = $con->stmt_init();
       $stmt->prepare($sql);
       $stmt->bind_param("sss", $title, $content,$verifyIs);
       $stmt->execute();
       $file_name = strtolower($_FILES['Blogimage']['name']);
       $file_tmploc = $_FILES['Blogimage']['tmp_name'];
       $id = $con->insert_id;
       $fileName = $id.$file_name;
       $location = "./blog-images/".$fileName;
       move_uploaded_file($file_tmploc,$location);
       $sql2 = "UPDATE apnaBlogs SET imageIs = ? WHERE id = ?;";
       $stmt2 = $con->stmt_init();
       $stmt2->prepare($sql2);
       $stmt2->bind_param("si", $fileName, $id);
       $stmt2->execute();
       header("Location: blog.php?action=view&status=success");
       exit();
    }

    if(isset($_POST['checking_edit_btn'])){
      $blog_id=$_POST['blog_id'];
      $result_array=[];
      $query = "SELECT * FROM apnaBlogs WHERE id='$blog_id' ";
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
      
       if(isset($_POST['update_blog'])){
          $Eid = $_POST['Eid'];
          $Etitle = $_POST['Etitle'];
          $Econtent = $_POST['Econtent'];
          $file_name = strtolower($_FILES['Blogimage']['name']);
          $file_tmploc = $_FILES['Blogimage']['tmp_name'];
          $fileName = $Eid.$file_name;
          $location = "./blog-images/".$fileName;
          move_uploaded_file($file_tmploc,$location);
          $sql = "UPDATE apnaBlogs SET titleIs=?, contentIs=?, imageIs=? WHERE id=?";
          $updateStatement = mysqli_prepare($con,$sql);
          mysqli_stmt_bind_param($updateStatement, 'sssi',$Etitle,$Econtent,$fileName,$Eid);
          if(mysqli_stmt_execute($updateStatement)){
              header('Location: blog.php?action=view');
          }else{
              echo'error';
          }
          
       }
       if(isset($_POST['delete_blog'])){
        $id = $_POST['blog_id'];
        $sql = "UPDATE apnaBlogs SET verifyIs = ? WHERE id = ?;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("si", $hide, $id);
        $stmt->execute();
        header("Location:https://apnasikshalaya.com/admin/blog.php?action=view");
        exit();
        }