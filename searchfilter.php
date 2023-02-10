<?php

include_once('./sn/con.php');

$show = 'show';

$i = 0;

$search =mysqli_real_escape_string($con, htmlspecialchars($_POST['search'], ENT_QUOTES));

$price = mysqli_real_escape_string($con, htmlspecialchars($_POST['price'], ENT_QUOTES));

if(isset($_POST['search'])){

    $sql = "SELECT * FROM apnaCourses WHERE extra = $show AND titleIs LIKE '%$search%' || keywordIs LIKE '%$search%'";

    if(isset($_POST["price"]) && !empty($_POST["price"])){

     $sql .= " AND priceIs <= '".$_POST["price"]."'

     ";

    }

    if(isset($_POST["lang"]) && !empty($_POST["lang"])){

  $language = implode("','", $_POST["lang"]);

  $sql .= " AND langIs IN('".$language."')

  ";

    }

    if(isset($_POST["time"])  && !empty($_POST["time"])){

  $time = implode("','", $_POST["time"]);

  $sql .= " AND hourIs >= '$time'

  ";

 }



    // if(isset($_POST['price']) && $_POST['price'] != null && $_POST['price'] != []){

    //     $sql .= " AND priceIs >= ?";

    //     $i += 1;

    // }

    // if(isset($_POST['lang']) && $_POST['lang'] != null && $_POST['lang'] != []){

    //     $langfilter = implode("','",$_POST['lang']);

    //     $sql .=" AND langIs IN('".$langfilter."')"; 

    //     $i += 2;

    // }

    // if(isset($_POST['time']) && $_POST['time'] != null && $_POST['time'] != []){

    //     $timefilter = max($_POST['time']);

    //     $sql .=" AND hourIs <= $timefilter"; 

    //     $i += 4;

    // }

    // $stmt = $con->stmt_init();

    // $stmt->prepare($sql);

    // if($i == 0) {

    // 	$stmt->bind_param("ss", $show, $search);

    // } elseif($i == 1) {

    // 	$stmt->bind_param("ss", $show, $price);

    // } elseif($i == 2) {

    // 	$stmt->bind_param("ss", $show, $langfilter);

    // } elseif($i == 3) {

    // 	$stmt->bind_param("sss", $show, $price, $langfilter);

    // } elseif($i == 4) {

    // 	$stmt->bind_param("ss", $show, $time);

    // } elseif($i == 5) {

    // 	$stmt->bind_param("sss", $show, $price, $time);

    // } elseif($i == 6) {

    // 	$stmt->bind_param("sss", $show, $langfilter, $time);

    // } elseif($i == 7) {

    // 	$stmt->bind_param("ssss", $show, $price, $langfilter, $time);

    // } else {

    // 	$stmt->bind_param("ss", $show, $search);

    // }

    $stmt = $con->prepare($sql);

    $stmt->execute();

    $stmt->store_result();

    $total_row = $stmt->num_rows();

    $output = '';

    if($total_row > 0){

    $stmt->bind_result($id, $title, $cata, $subCata, $type, $sdesc, $teacher, $lang, $price, $ldesc, $preview, $hour, $chapter, $certificate, $bestFor, $thumb, $ip, $dateTime, $extra);

        while($stmt->fetch())
        {

        if($thumb == null) {

        	$thumb = 'coursethumb113.png';

        }

            $output .= '

            <a href="/course_preview?id='.$id.'">

         <div class="row product">

           <div class="img col-md-4"><a href="/course_preview?id='.$id.'"><img src="./admin/coursethumb/'.$thumb.'" alt=""></a></div>

            <div class="details col-md-6">

                <a href="/course_preview?id='.$id.'" style="text-decoration: none;"><h4>'.$title.'</h4></a>

               <p>'.$sdesc.'

               <br>

               <a href="/search?query='.$cata.'">'.$cata.'</a> > <a href="/search?query='.$subCata.'">'.$subCata.'</a>

               <br>

               Best for: '.$bestFor.'</p>

               <ul class="stars rating">

                  <li><i class="fas fa-star"></i></li>

                  <li><i class="fas fa-star"></i></li>

                  <li><i class="fas fa-star"></i></li>

                  <li><i class="fas fa-star"></i></li>

                  <li><i class="fas fa-star-half-alt"></i></li>

                  <span class="reviews">Reviews (24)</span>

                </ul>

            </div>

            <div class="price col-md-2">

              <h6><b>&#8377;'.$price.'</b></h6>

            </div>

          </div>

        </a>

            ';

        }

    }else{

        $output = "<h3>NO DATA FOUND</h3>";

    }

    echo $output;

}



 ?>

