<!--

This website is designed & developed by



                          ________          _________         _________         _______    

                         /  _____/         / / __   /        /___  ___/        / __   /   

                        / /               / / /__/ /            / /           / /  / /    

                       / /               / /  ____/            / /           / /  / /     

                      / /______         / / \ \            ___/ /___        / /__/ /       

                     /________/        /_/   \_\          /________/       /______/   



     ___           _________ _________ _________  ________ _________  ________ _________  ___           __

    / _ \         / / __   //___  ___//___  ___/ / ______//___  ___/ / ______//___  ___/ / _ \         / /

   / / \ \       / / /__/ /    / /       / /    / /__        / /    / /          / /    / / \ \       / /

  / /   \ \     / /  ____/    / /       / /    / ___/       / /    / /          / /    / /   \ \     / /

 / /_____\ \   / / \ \       / /    ___/ /___ / /       ___/ /___ / /______ ___/ /___ / /_____\ \   / /_____

/___________\ /_/   \_\     /_/    /________//_/       /________//________//________//___________\ /_______/



Visit crioit.com for more info.

-->

<!DOCTYPE html>

<html lang="en">
<head>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Apnasikshalaya Tution</title>

  <link rel="stylesheet" href="css/tution_index.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
  <!-- Owl carousel -->
  <link rel="stylesheet" href="./css/owl.carousel.min.css">
  <link rel="stylesheet" href="./css/owl.theme.default.min.css">
  <?php include_once "header.php"; ?>
  <style>
    #subjectdiv{
      display: none;
    }
    #showonof{
      display: none;
    }
    #tutionsection{
      display: none;
    }
    section#tutionsection {
    margin-top: -244px;
    margin-bottom: 86px;
}
  img.offlineimg {
    width: 32rem;
}
  </style>

</head>



<body>

  <!-- Main section of the body -->

  <div class="container-fluid">

    <div class="row section1">

      <div class="col-md-6 col-sm-6 col-lg-6">

        <h2>

          Lorem ipsum dolor sit, amet consectetur adipisicing elit.

        </h2>

        <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias numquam, atque recusandae praesentium provident soluta odit deleniti</h3>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex rem suscipit cupiditate quia sed, corrupti fuga earum libero saepe. Sed asperna </p>

        <button id="showtuition" class="arrow-btn button registar_btn" type="button">Register Now</button>
        <div id="showonof" class="col-md" style="margin-top: 40px;">
          <label class="radio-inline tuitionselect"><input type="radio" value="online" name="typeoftuition">Online Tuition</label>
          <label class="radio-inline tuitionselect"><input type="radio" value="offline" name="typeoftuition">Offline Tuition</label>
        </div>

        <div id="subjectdiv" class="col-md" style="margin-top: 40px;">
          <label for="subjects">Select a Subject:</label>
          <input list="tuitionsubjects" name="subjects" id="tsub">
          <datalist id="tuitionsubjects">
            <!-- <option value="Edge"> -->
          </datalist>
        </div>
      </div>

      <div class="col-md-6 col-sm-6 col-lg-6">

        <img src="./images/tution1.png" draggable="false" class="teacher" alt="teacher">

        <div class="color-box"></div>



      </div>

    </div>

<!-- showing the dynamic tuition -->
<section id="tutionsection" class="parallax-section">


<div class="col-md-12 col-sm-12">

  <div class="wow animate__animated animate__fadeInUp section-title t-tution" data-wow-delay="0.2s">

    <h1 id="searchfor">Search Result for: </h1>

    <p id="tuitiontypeis"></p>

  </div>

</div>



<div  class="swiper mySwiper">
  <div id="summontuition"  class="swiper-wrapper">
     
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>

</div>
</section>
<!-- the dynamic tuition ends here -->

    <!--Teacher Section-->

    <section id="tution" class="parallax-section">


      <div class="col-md-12 col-sm-12">

        <div class="wow animate__animated animate__fadeInUp section-title t-tution" data-wow-delay="0.2s">

          <h1>Trending Tutions</h1>

          <p>Proin efficitur, tortor et fringilla finibus, felis enim euismod eros, vitae pharetra nisi nibh eu urna. Ut vitae lectus magna. Duis rutrum neque non finibus aliquam. Aenean lacinia ante sit amet dignissim vestibulum. Vestibulum ut libero lacinia magna congue mattis. Maecenas non ultrices nibh.</p>

        </div>

      </div>



      <div class="swiper mySwiper">
        <div  class="swiper-wrapper">
          <div class="swiper-slide">
            <a draggable="false" href="/search?query=Spoken English">
              <div class="product-item">
                <img draggable="false" src="assets/images/product_01.jpg" alt="">
                <div class="down-content">
                  <h3>Spoken English</h3>
                  <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                </div>
              </div>
            </a>
          </div>


          <div class="swiper-slide">
            <a draggable="false" href="/search?query=Foreign Language">
              <div class="product-item">
                <img draggable="false" src="assets/images/product_02.jpg" alt="">
                <div class="down-content">
                  <h3>Foreign Language</h3>
                  <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                </div>
              </div>
            </a>
          </div>


          <div class="swiper-slide">
            <a draggable="false" href="/search?query=IT">
              <div class="product-item">
                <img draggable="false" src="assets/images/product_03.jpg" alt="">
                <div class="down-content">
                  <h3>IT</h3>
                  <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                </div>
              </div>
            </a>
          </div>


          <div class="swiper-slide">
            <a draggable="false" href="/search?query=Physics">
              <div class="product-item">
                <img draggable="false" src="assets/images/product_04.jpg" alt="">
                <div class="down-content">
                  <h3>Physics</h3>
                  <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                </div>
              </div>
            </a>
          </div>


          <div class="swiper-slide">
            <a draggable="false" href="/search?query=Law">
              <div class="product-item">
                <img draggable="false" src="assets/images/product_05.jpg" alt="">
                <div class="down-content">
                  <h3>Law</h3>
                  <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                </div>
              </div>
            </a>
          </div>


          <div class="swiper-slide">
            <a draggable="false" href="/search?query=Language">
              <div class="product-item">
                <img draggable="false" src="assets/images/see_more.jpg" alt="">
                <div class="down-content">
                  <h3>SEE MORE</h3>
                  <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                </div>
              </div>
            </a>
          </div>
        </div>


        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>

      </div>
    </section>



    <!--Why Tution-->



    <div id="menu-4" class="content blog-section">

      <div class="blog-header  section-title w-tution">

        <h1>Why Tutions</h1>

        <p>Proin efficitur, tortor et fringilla finibus, felis enim euismod eros, vitae pharetra nisi nibh eu urna. Ut vitae lectus magna. Duis rutrum neque non finibus aliquam. Aenean lacinia ante sit amet dignissim vestibulum. Vestibulum ut libero lacinia magna congue mattis. Maecenas non ultrices nibh.</p>

      </div>

      <div class="row blog-posts">

        <div class="col-md-4 col-sm-12">

          <div class="blog-item post-1 animated zoomIn">

            <div class="blog-bg blog-pink"></div>

            <div class="blog-content">

              <h3>Text1</h3>

              <span class="solid-line"></span>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo.</p>



            </div>

          </div>

        </div>

        <div class="col-md-4 col-sm-12">

          <div class="blog-item post-2 animated zoomIn">

            <div class="blog-bg blog-blue"></div>

            <div class="blog-content" style="border-radius: 10px;">

              <h3>Text2</h3>

              <span class="solid-line"></span>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo.</p>



            </div>

          </div>

        </div>

        <div class="col-md-4 col-sm-12">

          <div class="blog-item post-3 animated zoomIn">

            <div class="blog-bg blog-green"></div>

            <div class="blog-content">

              <h3>Text3</h3>

              <span class="solid-line"></span>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo.</p>



            </div>

          </div>

        </div>

      </div>

    </div>

    <!--Teacher Section-->

    <section id="work" class="parallax-section">



      <div class="col-md-12 col-sm-12">

        <!-- SECTION TITLE -->

        <div class="wow animate__animated animate__fadeInUp section-title b-tution" data-wow-delay="0.2s">

          <h1>Our Best Teacher</h1>

          <p>Proin efficitur, tortor et fringilla finibus, felis enim euismod eros, vitae pharetra nisi nibh eu urna. Ut vitae lectus magna. Duis rutrum neque non finibus aliquam. Aenean lacinia ante sit amet dignissim vestibulum. Vestibulum ut libero lacinia magna congue mattis. Maecenas non ultrices nibh.</p>

        </div>

      </div>



      <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.4s">

        <!-- WORK THUMB -->

        <a href="/teacher" style="text-decoration:none;">

          <div class="work-thumb">



            <img draggable="false" src="images/new/teacher1.png" class="img-responsive" alt="Fine Arts">



          </div>

          <h4>Teacher Name 1</h4>

        </a>

      </div>



      <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.6s">

        <!-- WORK THUMB -->

        <a href="/teacher" style="text-decoration:none;">

          <div class="work-thumb">



            <img src="images/new/teacher3.png" class="img-responsive" draggable="false" alt="Logo Design">



          </div>

          <h4>Teacher Name 2</h4>
        </a>

      </div>



      <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.8s">

        <!-- WORK THUMB -->

        <a href="/teacher" style="text-decoration:none;">

          <div class="work-thumb">



            <img src="images/new/teacher4.png" class="img-responsive" draggable="false" alt="Photography">



          </div>

          <h4>Teacher Name 3</h4>
        </a>

      </div>



      <div class="wow animate__animated animate__fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.8s">

        <!-- WORK THUMB -->

        <a href="/teacher" style="text-decoration:none;">

          <div class="work-thumb">

            <a href="images/new/teacher4.png" class="image-popup">

              <img src="images/new/teacher4.png" class="img-responsive" draggable="false" alt="Photography">



          </div>

          <h4>Teacher Name 4</h4>
        </a>

      </div>





    </section>


    <div id="provide">


      <div class="blog-header section-title" style="margin-bottom: 40px;">

        <h1>What We Provide</h1>
        <p>Proin efficitur, tortor et fringilla finibus, felis enim euismod eros, vitae pharetra nisi nibh eu urna. Ut vitae lectus magna. Duis rutrum neque non finibus aliquam. Aenean lacinia ante sit amet dignissim vestibulum. Vestibulum ut libero lacinia magna congue mattis. Maecenas non ultrices nibh.</p>

      </div>

      <div class="row blog-posts">

        <div class="col-md-4 col-sm-12">

          <div class="blog-item post-1 animated zoomIn">

            <div class="blog-bg blog-pink"></div>

            <div class="blog-content">

              <h3>Text1</h3>

              <span class="solid-line"></span>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo.</p>



            </div>

          </div>

        </div>

        <div class="col-md-4 col-sm-12">

          <div class="blog-item post-2 animated zoomIn">

            <div class="blog-bg blog-blue"></div>

            <div class="blog-content" style="border-radius: 10px;">

              <h3>Text2</h3>

              <span class="solid-line"></span>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo.</p>



            </div>

          </div>

        </div>

        <div class="col-md-4 col-sm-12">

          <div class="blog-item post-3 animated zoomIn">

            <div class="blog-bg blog-green"></div>

            <div class="blog-content">

              <h3>Text3</h3>

              <span class="solid-line"></span>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ipsum tellus, tristique eu molestie at, maximus ut leo.</p>



            </div>

          </div>

        </div>

      </div>



    </div>



    <!-- Review section -->

    <div class="testimonial-container">

      <h2>What our students think:</h2>

      <div class="progress-bar"></div>

      <div class="fas fa-quote-left fa-quote"></div>

      <div class="fas fa-quote-right fa-quote"></div>

      <p class="testimonial">

        I've worked with literally hundreds of HTML/CSS developers and I have to

        say the top spot goes to this guy. This guy is an amazing developer. He

        stresses on good, clean code and pays heed to the details.

      </p>

      <div class="user">

        <div class="user-details">

          <h3 class="username">Miyah Myles</h3>

          <p class="role">Marketing</p>

        </div>

      </div>

    </div>
    <!-- --------- Owl-Carousel js ------------------->
    <script src="./js/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Review section ends here -->

    <script src="/js/course_preview.js"></script>

    <script>
      function toggle(e) {

        if (e.childNodes[3].classList.contains("fa-plus")) {

          e.childNodes[3].classList.remove("fa-plus");

          e.childNodes[3].classList.add("fa-minus");

        } else {

          e.childNodes[3].classList.remove("fa-minus");

          e.childNodes[3].classList.add("fa-plus");

        }

      };

      // this is not a bug but a feature on clicking the li the class changes and it changes the icon inside the i tag with plus and minus icon but the feature is it doesnt changes when clickd on the padding of the li
    </script>';

    <script>
      $(document).ready(function() {
        $(document).on('click', '.sendonlinetuitionpage', function(e){
          e.preventDefault();
          console.log("wew are in");
let teach_id = $(this).closest("a").find(".teacherid").text();
let link = '/single_tution.php?typeis=online&id='+teach_id+'&useris';
console.log(link);
window.location.href=link;
});
        $(document).on('click', '.sendofflinetuitionpage', function(e){
          e.preventDefault();
          console.log("wew are in offline");
let teach_id = $(this).closest("a").find(".teachersid").text();
let link = '/single_tution.php?typeis=online&id='+teach_id;
console.log(link);
window.location.href=link;
});

        $("#owl-demo").owlCarousel({
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items: 3,
        });
        $(document).on('click', '#showtuition', function(e){
          var showbtn = $('#showonof').show();
        })

        $(document).on('click', '.tuitionselect', function(e) {
          var typeoftuition = $('input[name="typeoftuition"]:checked').val();
          $.ajax({         
            type: "POST", 
            url: "tuitionview.php",
            data:{
              'typeoftuition':typeoftuition,
              'choosingsub':"TRUE",
            },
            success: function(data) {
               data = JSON.parse(data)
               for(var i=0, len=data.length; i<len; i++) {
					var opt = $("<option></option>").attr("value", data[i]);
					$("#tuitionsubjects").append(opt);
				}
              console.log(data);
            }
        });
          $("#subjectdiv").show();
          

        });
        $(document).on('input', '#tsub', function(e) {
          let subis=$("#tsub").val();
          console.log("double check sub value: "+subis);
         console.log(typeof(subis));
          var typeoftuition = $('input[name="typeoftuition"]:checked').val();
          console.log("still in tuition "+subis+" typeis "+typeoftuition);
          $.ajax({         
            type: "POST", 
            url: "tuitionview.php",
            data:{
              'subis':subis,
              'typeoftuition':typeoftuition,
              'showcontent':"TRUE",
            },
            success: function(data) {
              if(subis===""){
            $('#tutionsection').hide();
            console.log("inside hide");
          }else{
              $('#summontuition').html(data);
              $('#tutionsection').show();
              if(typeoftuition=="offline"){
              $('#searchfor').html(' '+typeoftuition +' '+subis+' tuition' );
              $('#tuitiontypeis').html('These are our best teachers we got for you apply now and get ready for a bright and succusful future. our teachers are specialized in teaching vairety of subjects, and making your study sessions as fun and educative as possible');
              }else{

              }
          }
            
            }
        });
        });

      });
    </script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
  </div>

  <!-- main ends here -->



</body>

<?php include_once "footer.php"; ?>

</html>