<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/courses.css">
  <!-- Owl Stylesheets -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <style>
    input[type="radio"] {
      opacity: 0;
      width: 0;
      margin: 0;
      visibility: hidden;
    }
    label[for="courses"],
    label[for="teachers"],
    label[for="blogs"] {
      margin-bottom: 8px;
      padding-left: 16px;
      cursor: pointer;
    }
    input:checked+label[for="courses"],
    input:checked+label[for="teachers"],
    input:checked+label[for="blogs"] {
      color: #ce1010;
    }
    .selectt {
      display: none;
    }
    img.img {
      width: 388px;
    }
    .post-content.col-md-3 {
      width: 50%;
    }
  </style>
  <title>Most Popular Courses</title>
</head>
<?php include_once './header.php' ?>
<body>
  <?php
  $search = mysqli_real_escape_string($con, htmlspecialchars($_GET['query'], ENT_QUOTES));
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-------- All Popular courses Filter Part ----->
      <div class="col-md-3">
        <div class="filter">
          <h2 style="margin: 10px 0px 10px; font-weight:bold; font-size:2.6rem">Results for <span id="searchresult"><?php echo $search; ?>
            </span></h2>
          <!-- Below is the radio buttons for styling -->
          <form class="page-type">
            <label class="radio-inline"><input type="radio" value="courses" name="type" checked> Courses </label>
            <label class="radio-inline"> <input type="radio" value="teachers" name="type">Teachers</label>
            <label class="radio-inline"> <input type="radio" value="blogs" name="type">Blogs</label>
          </form>
          <h4 class="bg-dark">Filter</h4>
          <details open>
            <summary class="text-dark">Video Duration <span><i class="fas fa-chevron-down"></i></span></summary>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter time" id="onetwo" value="2">
                    Atleast 2 Hour
                  </label>
                </div>
              </li>
            </ul>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter time" id="twofour" value="4">
                    Atleast 4 Hour
                  </label>
                </div>
              </li>
            </ul>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter time" id="foursix" value="6">
                    Atleast 6 Hour
                  </label>
                </div>
              </li>
            </ul>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter time" id="sixten" value="10">
                    Atleast 10 Hour
                  </label>
                </div>
              </li>
            </ul>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter time" id="tentwelve" value="12">
                    Atleast 12 Hour
                  </label>
                </div>
              </li>
            </ul>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter time" id="tentwelve" value="100">
                    Atleast 24 Hour
                  </label>
                </div>
              </li>
            </ul>
          </details>
          <details open>
            <summary class="text-dark">Price <span><i class="fas fa-chevron-down"></i></span></summary>
            <div class="slider">
              <input type="range" class="price-slider course_filter price" id="slider" min="0" max="7000" step="100">
              <label for="">$ 0</label>
              <label for="" id="label" class="label-right"></label>
              <label for="" class="label-right" style="margin-right: 6px;">$</label>
            </div>
          </details>



          <details>
          <summary class="text-dark">Ratings</summary>
        <ul class="duration-list-star">
          <li class="list-group-item">
            <div class="form-check">
              <label class="ratingss">
                <input type="checkbox" class="form-check-input duration course_filter" id="four5star">
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star-half-alt"></span>
                  <span><b>4.5  <i class="fas fa-plus"></i></b></span>
              </label>
            </div>
          </li>
        </ul>
        <ul class="duration-list-star">
          <li class="list-group-item">
            <div class="form-check">
              <label class="ratingss">
                <input type="checkbox" class="form-check-input duration course_filter"  id="fourstar">
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="far fa-star"></span>
                  <span><b>4.0  <i class="fas fa-plus"></i></b></span>
              </label>
            </div>
          </li>
        </ul>
        <ul class="duration-list-star">
          <li class="list-group-item">
            <div class="form-check">
              <label class="ratingss">
                <input type="checkbox" class="form-check-input duration course_filter" id="three5star">
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star-half-alt"></span>
                  <span class="far fa-star"></span>
                  <span><b>3.5  <i class="fas fa-plus"></i></b></span>
              </label>
            </div>
          </li>
        </ul>
        <ul class="duration-list-star">
          <li class="list-group-item">
            <div class="form-check">
              <label class="ratingss">
                <input type="checkbox" class="form-check-input duration course_filter"  id="threestar">
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="far fa-star"></span>
                  <span class="far fa-star"></span>
                  <span><b>3.0   <i class="fas fa-plus"></i></b></span>
              </label>
            </div>
          </li>
        </ul>
        <ul class="duration-list-star">
          <li class="list-group-item">
            <div class="form-check">
              <label class="ratingss">
                <input type="checkbox" class="form-check-input duration course_filter"  id="two5star">
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star"></span>
                  <span class="fas fa-star-half-alt"></span>
                  <span class="far fa-star"></span>
                  <span class="far fa-star"></span>
                  <span> <b>2.5  <i class="fas fa-plus"></i></b></span>
              </label>
            </div>
          </li>
        </ul>
      </details>



      
          <details>
            <summary class="text-dark">Language <span><i class="fas fa-chevron-down"></i></span></summary>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter lang" id="eng" value="english">
                    English
                  </label>
                </div>
              </li>
            </ul>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter lang" id="hin" value="hindi">
                    Hindi (हिंदी)
                  </label>
                </div>
              </li>
            </ul>
            <ul class="duration-list">
              <li class="list-group-item">
                <div class="form-check">
                  <label class="form-check-lable">
                    <input type="checkbox" class="form-check-input duration course_filter lang" id="ben" value="bengali">
                    Bangla (বাংলা)
                  </label>
                </div>
              </li>
            </ul>
          </details>
          <hr>
        </div>
      </div>
      <!-- <div class="col-md-9 result" id="result">
      </div> -->
      <div class="col-md-9 selectt courses" id="result">
        <?php
        $search = mysqli_real_escape_string($con, htmlspecialchars($_GET['query'], ENT_QUOTES));
        $show = "show";
        $sql = "SELECT * FROM apnaCourses WHERE cataIs LIKE '%$search%' || subCataIs LIKE '%$search%' || titleIs LIKE '%$search%' && extra = ?;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $show);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $title, $cata, $subCata, $type, $sDesc, $teacher, $lang, $price, $lDesc, $preview, $hour, $chapter, $certificate, $bestFor, $thumb, $ip, $dateTime, $extra);
        while ($stmt->fetch()) {
          echo '
      	<a href="/course_preview?id=' . $id . '">
         <div class="row product">
           <div class="img col-md-4"><a href="/course_preview?id=' . $id . '"><img src="images/download.jpeg" alt=""></a></div>
            <div class="details col-md-6">
                <a href="/course_preview?id=' . $id . '" style="text-decoration: none;"><h4>' . $title . '</h4></a>
               <p>' . $sDesc . '
               <br>
               <a href="/search?query=' . $cata . '">' . $cata . '</a> > <a href="/search?query=' . $subCata . '">' . $subCata . '</a>
               <br>
               Best for: ' . $bestFor . '</p>
               <!--<ul class="stars rating">
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star-half-alt"></i></li>
                  <span class="reviews">Reviews (24)</span>
                </ul>-->
            </div>
            <div class="price col-md-2">
              <h6><b>&#8377;' . $price . '</b></h6>
            </div>
          </div>
        </a>';
        }
        ?>
      </div>
      <div class="col-md-9 selectt teachers" id="result">
        <?php
        $search = mysqli_real_escape_string($con, htmlspecialchars($_GET['query'], ENT_QUOTES));
        $show = "show";
        $sql = "SELECT * FROM apnaTeachers WHERE nameIs LIKE '%$search%' && extra = ?;";
        $stmt = $con->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("s", $show);
        $stmt->execute();
        $stmt->store_result();
        $total_row = $stmt->num_rows();
        if ($total_row > 0) {
          $stmt->bind_result($id, $name, $gender, $contact, $dob, $altContact, $email, $pass, $address, $city, $state, $pin, $subject, $exp, $quali, $certicourse, $procourse, $tuition, $resume, $ip, $verify, $extra, $lastlogin, $firstupload, $thumbnail, $creditscore);
          while ($stmt->fetch()) {
            echo '
          <a href="/course_preview?id=' . $id . '">
          <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.4s">
          <!-- WORK THUMB -->
          <a href="/teacher" style="text-decoration:none;">
          <div class="work-thumb">
             
          <img draggable="false" src="images/new/teacher1.png" class="img-responsive"  alt="Fine Arts">
            
          </div>
          <h5> Hi.! My name is ' . $name . '</h5>
          <p>The subjects I teache are' . $subject . '</p>
          <p>My educational Qualification is' . $quali . '</p>
          </a>
     </div>
          </a>';
          }
        } else {
          echo '<h2>No data Found</h2>';
        }
        ?>
      </div>
      <main class="squish">
        <section class="container">
          <div class="site-content">
            <div class="posts selectt blogs" id="result">
              <?php
              $search = mysqli_real_escape_string($con, htmlspecialchars($_GET['query'], ENT_QUOTES));
              $show = "show";
              $sql = "SELECT * FROM apnaBlogs WHERE titleIs LIKE '%$search%' || keywordIs LIKE '%$search%' && verifyIs = ?;";
              $stmt = $con->stmt_init();
              $stmt->prepare($sql);
              $stmt->bind_param("s", $show);
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($id, $title, $content, $createdat, $imageis, $verify, $keyword, $extra);
              while ($stmt->fetch()) {
                echo '
        <div class="post-content " data-aos="fade-in" data-aos-delay="200">
        <div class="post-image">
            <div>
                <img draggable="false" src="./assets/Blog-post/blog1.png" class="img" alt="blog1">
            </div>
            <div class="post-info flex-row">
                <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;Admin</span>
                <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August, 6 2021</span>
                <span>2 Commets</span>
            </div>
        </div>
        <div class="post-title">
            <a href="#">' . $title . '</a>
            <p>' . $content . '
            </p>
            <button class=" arrow-btn">Read More &nbsp; <i class="fas fa-arrow-right"></i></button>
        </div>
    </div>';
              }
              ?>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
  
  </div>
  
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <!-- Owl Script -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots: false,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 3
        }
      }
    })
    // Filter Price Script
    var slider = document.querySelector('#slider')
    var label = document.querySelector('#label')
    label.innerHTML = slider.value;
    slider.style.background = 'linear-gradient(90deg, #ff1f5c ' + slider.value / 70 + '%, white 0)'
    slider.oninput = function() {
      label.innerHTML = slider.value;
      slider.style.background = 'linear-gradient(90deg, #ff1f5c ' + slider.value / 70 + '%, white 0)'
    }
  </script>
  <script>
    $(".courses").show();
    $(".filter").show();
    $(document).ready(function() {
      $('input[type="radio"]').click(function() {
        var inputValue = $(this).attr("value");
        if (inputValue == "courses") {
          $(".filter").show();
        } else {
          $(".filter").hide();
        }
        var targetBox = $("." + inputValue);
        $(".selectt").not(targetBox).hide();
        $(targetBox).show()
        $(targetBox).style.color = "red";
      });

      $(".course_filter").click(function() {
        var action = 'data';
        var price = document.getElementById("slider").value;
        var result = document.getElementById("searchresult").innerText;
        var time = get_filter('time');
        var lang = get_filter('lang');
        console.log("price:" + price);
        console.log("time:" + time);
        console.log("language:" + lang);
        console.log("search result:" + result);
        console.log(action);
        $.ajax({
          type: "POST",
          url: "searchfilter.php",
          data: {
            "action": action,
            "price": price,
            "time": time,
            "lang": lang,
            "search": result
          },
          success: function(data) {
            $("#result").html(data);
            console.log("Returned result:" + data)
          }
        });
      });
      // this below function is getting all checked values in an array
      function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
          filter.push($(this).val());
        });
        return filter
      }
    });
  </script>

  <!-- <script>
    $(document).ready(function() {
      $(".course_filter").click(function() {
        var action = 'data';
        var price = document.getElementById("slider").value;
        var result = document.getElementById("searchresult").innerText;
        var time = get_filter('time');
        var lang = get_filter('lang');
        console.log("price:" + price);
        console.log("time:" + time);
        console.log("language:" + lang);
        console.log("search result:" + result);
        console.log(action);
        $.ajax({
          type: "POST",
          url: "searchfilter.php",
          data: {
            "action": action,
            "price": price,
            "time": time,
            "lang": lang,
            "search": result
          },
          success: function(data) {
            $("#result").html(data);
            console.log("Returned result:" + data)
          }
        });
      });
    
      function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
          filter.push($(this).val());
        });
        return filter
      }
    }); 
  </script> -->
</body>
<?php include_once './footer.php' ?>
</html>