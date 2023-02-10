<?php

include_once "../sn/con.php";

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





if (isset($_POST['checking_edit_btn'])) {

    $vidid = $_POST['vidid'];

    $result_array = [];

    $query = "SELECT * FROM apnaVideos WHERE id='$vidid'";

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



if (isset($_POST['update_section'])) {

    $Eid = $_POST['Eid'];

    $Etitle = $_POST['Etitle'];

    $Econtent = $_POST['Econtent'];

    $Edesc = $_POST['Edesc'];

    $Evidno = $_POST['Evidno'];

    $Evidlink = $_POST['Evidlink'];

    $Ecourseid = $_POST['Ecourseid'];

    $Esectionis = $_POST['Esectionis'];

    $file = strtolower($_FILES['EfileIs']['name']);

    $file_tmploc_file = $_FILES['EfileIs']['tmp_name'];

    $file = $Eid . $file;

    $location_file = "./courseattachments/" . $file;

    if ($_FILES['EfileIs']['name'] != null) {

        move_uploaded_file($file_tmploc_file, $location_file);

        $sql = "UPDATE apnaVideos SET courseId=?, titleIs=?, contentIs=?, sectionIs=?, videoNo=?, videoLinkIs = ?, descIs=?, fileIs=?  WHERE id=?";

        $updateStatement = mysqli_prepare($con, $sql);

        mysqli_stmt_bind_param($updateStatement, 'issiisssi', $Ecourseid, $Etitle, $Econtent, $Esectionis, $Evidno, $Evidlink, $Edesc, $file, $Eid);

        if (mysqli_stmt_execute($updateStatement)) {

            header('Location: course_section.php?id=' . $Ecourseid . '');
        } else {

            echo 'error';
        }
    } else {

        $sql = "UPDATE apnaVideos SET courseId=?, titleIs=?, contentIs=?, sectionIs=?, videoNo=?, videoLinkIs = ?, descIs=? WHERE id=?";

        $updateStatement = mysqli_prepare($con, $sql);

        mysqli_stmt_bind_param($updateStatement, 'issiissi', $Ecourseid, $Etitle, $Econtent, $Esectionis, $Evidno, $Evidlink, $Edesc, $Eid);

        if (mysqli_stmt_execute($updateStatement)) {

            header('Location: course_section.php?id=' . $Ecourseid . '');
        } else {

            echo 'error';
        }
    }
}
