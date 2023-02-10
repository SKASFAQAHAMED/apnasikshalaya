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
$hide = "hide";

if (isset($_POST['checking_edit_btn'])) {
    $course_id = $_POST['course_id'];
    $result_array = [];
    $query = "SELECT * FROM apnaCourses WHERE id='$course_id' ";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header('content-type: application/json');
            echo json_encode($result_array);
        }
    } else {
        echo '<h4>no records were found</h4>';
    }
}

if (isset($_POST['update_course'])) {
    $Eid = $_POST['Eid'];
    $Etitle = $_POST['Etitle'];
    $Ecatagory = $_POST['Ecatagory'];
    $EsubCata = $_POST['EsubCata'];
    $Etype = $_POST['Etype'];
    $Esdesc = $_POST['Esdesc'];
    $Eteacher = $_POST['Eteacher'];
    $Elanguage = $_POST['Elanguage'];
    $Eprice = $_POST['Eprice'];
    $Eldesc = $_POST['Eldesc'];
    $Epreview = $_POST['Epreview'];
    $Ehours = $_POST['Ehours'];
    $Echapters = $_POST['Echapters'];
    $Ecertification = $_POST['Ecertification'];
    $Ebest = $_POST['Ebest'];
    $file_name = strtolower($_FILES['thumbnail']['name']);
    $file_tmploc = $_FILES['thumbnail']['tmp_name'];
    $fileName = $Eid . $file_name;
    $location = "./coursethumb/" . $fileName;
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name'] != NULL) {
        move_uploaded_file($file_tmploc, $location);
        $sql = "UPDATE apnaCourses SET titleIs=?, cataIs=?, subCataIs=?,typeIs = ?, sDescIs=?,  teacherIs=?, langIS=?, priceIs=?, lDescIs=?, previewIs=?, hourIs=?, chapterIS=?, certificateIs=?, bestForIs=?, thumbIs=?  WHERE id=?";
        $updateStatement = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($updateStatement, 'sssssssssssssssi', $Etitle, $Ecatagory, $EsubCata, $Etype, $Esdesc, $Eteacher, $Elanguage, $Eprice, $Eldesc, $Epreview, $Ehours, $Echapters, $Ecertification, $Ebest, $fileName, $Eid);
    } else {
        $sql = "UPDATE apnaCourses SET titleIs=?, cataIs=?, subCataIs=?,typeIs = ?, sDescIs=?,  teacherIs=?, langIS=?, priceIs=?, lDescIs=?, previewIs=?, hourIs=?, chapterIS=?, certificateIs=?, bestForIs=? WHERE id=?";
        $updateStatement = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($updateStatement, 'ssssssssssssssi', $Etitle, $Ecatagory, $EsubCata, $Etype, $Esdesc, $Eteacher, $Elanguage, $Eprice, $Eldesc, $Epreview, $Ehours, $Echapters, $Ecertification, $Ebest, $Eid);
    }
    if (mysqli_stmt_execute($updateStatement)) {
        header('Location: course.php?action=view');
    } else {
        echo 'error';
    }
}

if (isset($_POST['delete_course'])) {
    $id = $_POST['course_id'];
    $sql = "UPDATE apnaCourses SET extra = ? WHERE id = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("si", $hide, $id);
    $stmt->execute();
    header("Location:/course.php?action=view");
    exit();
}


if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if ($search != '') {
        $sql = "SELECT titleIs, teacherIs from apnaCourses WHERE titleIs like '%$search%' OR teacherIs like '%$search%';";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows() > 0) {
            echo  '<table class="table table-bordered"><thead>
                    <tr>
                        <th>Title</th>
                        <th>Teacher</th>
                      </tr>
                    </thead>';
            $stmt->bind_result($title, $teacher);
            while ($stmt->fetch()) {
                echo '<tr>
                        <td>' . $title . '</td>
                        <td>' . $teacher . '</td>
                      </tr>';
            }
            echo '</table>';
        } else {
            echo "Data not found";
        }
    }
}

if (isset($_POST['export_excel'])) {
    $sql = "SELECT * FROM apnaCourses ORDER BY id DESC";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
                    <table class="table">
                    <tr>
                     <th>ID</th>
                     <th>TITLE</th>
                     <th>CATAGORY</th>
                     <th>SUB-CATAGORY</th>
                     <th>TYPE OF COURSE</th>
                     <th>SHORT DESCRIPTION</th>
                     <th>TEACHERS</th>
                     <th>LANGUAGE</th>
                     <th>PRICE</th>
                     <th>LONG DESCRIPTION</th>
                     <th>PREVIEW LINK</th>
                     <th>DURATION</th>
                     <th>CHAPTERS</th>
                     <th>CERTIFICATE</th>
                     <th>BEST FOR</th>
                     <th>IP-ADDRESS</th>
                     <th>DATE-TIME</th>
                     <th>EXTRA</th>
                    </tr>
                    ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
                        <tr>
                         <td>' . $row["id"] . '</td>
                         <td>' . $row["titleIs"] . '</td>
                         <td>' . $row["cataIs"] . '</td>
                         <td>' . $row["subCataIs"] . '</td>
                         <td>' . $row["typeIs"] . '</td>
                         <td>' . $row["sDescIs"] . '</td>
                         <td>' . $row["teacherIs"] . '</td>
                         <td>' . $row["langIs"] . '</td>
                         <td>' . $row["priceIs"] . '</td>
                         <td>' . $row["lDescIs"] . '</td>
                         <td>' . $row["previewIs"] . '</td>
                         <td>' . $row["hourIs"] . '</td>
                         <td>' . $row["chapterIs"] . '</td>
                         <td>' . $row["certificateIs"] . '</td>
                         <td>' . $row["bestForIs"] . '</td>
                         <td>' . $row["ipIs"] . '</td>
                         <td>' . $row["dateTime"] . '</td>
                         <td>' . $row["extra"] . '</td>
                        </tr>
                        ';
        }
        $output .= '</table>';
        $fileName = date('Y-m-d') . 'courses data.xlsx';
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$fileName");
        echo $output;
    }
}
