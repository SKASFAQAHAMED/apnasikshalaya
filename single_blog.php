<?php

include_once './sn/con.php';

$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));

$show = "show";

$sql = "SELECT * FROM apnaBlogs WHERE id = ?;";

$stmt = $con->stmt_init();

$stmt->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$stmt->store_result();

if ($stmt->num_rows() != 0) {

    $stmt->bind_result($id, $title, $content, $createdat, $imageis, $verify, $keyword, $extra);

    $stmt->fetch();

    echo '

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>' . $title . '</title>



    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="./css/all.css">





    <!-- --------- Owl-Carousel ------------------->

    <link rel="stylesheet" href="./css/owl.carousel.min.css">

    <link rel="stylesheet" href="./css/owl.theme.default.min.css">



    <!-- ------------ AOS Library ------------------------- -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">



    <!-- Custom Style   -->

    <link rel="stylesheet" href="./css/single_blog.css">



</head>';

    include_once "header.php";

    echo '

<body>

    <!----------------------------- Main Site Section ------------------------------>



    <main class="squish">



      

      

        <!-- <div class="owl-navigation">

            <span class="owl-nav-prev"><i class="fas fa-long-arrow-alt-left"></i></span>

            <span class="owl-nav-next"><i class="fas fa-long-arrow-alt-right"></i></span>

        </div> -->

        <!-- ---------------------- Site Content -------------------------->



        <section class="container-fluid">

            <div class="site-content">

                <div class="posts">

                    <div class="post-content" data-aos="fade-in" data-aos-delay="200">

                        <div class="post-image">

                            <div>

                                <img draggable="false" src="./admin/blog-images/' . $imageis . '" class="img" alt="blog1">

                            </div>

                            <div class="post-info flex-row">

                                <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;Admin</span>

                                <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;' . substr($createdat, 0, 10) . '</span>

                                <span>2 Commets</span>

                            </div>

                        </div>

                        <div class="post-title">

                            <h2>' . $title . '</h2>

                            <p>Catagory > Sub catagory</p>

                            <img src="./images/share-icon.png" draggable="false"  onclick="this.style.display=\'none\'; document.getElementById(\'showOrHide\').style.display=\'block\'; " style="cursor: pointer;">

                            <div class="social-share" id="showOrHide" style="display:none;">

                            <a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>

                            <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>

                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>

                            <a href="#" target="_blank"><i class="fab fa-youtube-square"></i></a>

                            </div>';

    echo html_entity_decode(str_replace("\\r\\n", "", $content));

    echo '<hr>

                        </div>

                    </div>



                    <!--Start comment section-->



                    <div class="pt-5 mt-5">

              <h3 class="mb-5">3 Comments</h3>

              <ul class="comment-list">

                <li class="comment">

                  

                  <div class="comment-body">

                    <h3>John Doe</h3>

                    <div class="meta">April 12, 2020 at 1:21am</div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>

                 

                  </div>

                </li>



                <li class="comment">

                 

                  <div class="comment-body">

                    <h3>John Doe</h3>

                    <div class="meta">April 12, 2020 at 1:21am</div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>

                   

                  </div>



                    </li>



                    <li class="comment">

                 

                 <div class="comment-body">

                   <h3>John Doe</h3>

                   <div class="meta">April 12, 2020 at 1:21am</div>

                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>

                  

                 </div>



                   </li>

                  </ul>

                </li>

              </ul>

              <!-- END comment-list -->

              

              <div class="comment-form-wrap pt-5">

                <h3 class="mb-5">Leave a comment</h3>

                <form action="#" class="p-5 bg-light">

                  <div class="form-group">

                    <label for="name">Name *</label>

                    <input type="text" class="form-text" id="name" placeholder="Enter name">

                  </div>

                  <div class="form-group">

                    <label for="email">Email *</label><br>

                    <input type="email" class="form-text" id="email"  placeholder="Enter email">

                  </div>

                  <div class="form-group">

                    <label for="message">Message *</label>

                    <textarea name="" id="message" cols="30" rows="5" class="form-area"  placeholder="Write something"></textarea>

                  </div>

                  <div class="form-group">

                    <input type="submit" value="Post Comment" class="arrow-btn py-3 px-4" style="width:100%;">

                  </div>



                </form>

              </div>

            </div>

            <!--end section-->

                </div>

                

                <aside class="sidebar">

                    <div class="category">

                        <h2>Category</h2>

                        <ul class="category-list">

                            <li class="list-items" data-aos="fade-in" data-aos-delay="100">

                                <a draggable="false" href="#">Software</a>

                                <span>(05)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="200">

                                <a draggable="false" href="#">Techonlogy</a>

                                <span>(02)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="300">

                                <a draggable="false" href="#">Lifestyle</a>

                                <span>(07)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="400">

                                <a draggable="false" href="#">Shopping</a>

                                <span>(01)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="500">

                                <a draggable="false" href="#">Food</a>

                                <span>(08)</span>

                            </li>

                        </ul>

                    </div>

                    <div class="popular-post">

                        <h2>Popular Post</h2>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="200">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-1.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;January 14,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="300">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-2.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="400">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-3.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="500">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-4.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="600">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-5.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                    </div>

                   

                    <div class="popular-tags">

                        <h2>Popular Tags</h2>

                        <div class="tags flex-row">

                            <span class="tag" data-aos="fade-in" data-aos-delay="100">Software</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="200">technology</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="300">travel</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="400">illustration</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="500">design</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="600">lifestyle</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="700">love</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="800">project</span>

                        </div>

                    </div>

                </aside>

            </div>

        </section>



        <!-- -----------x---------- Site Content -------------x------------>



    </main>



    <!---------------x------------- Main Site Section ---------------x-------------->







    <!-- -------------x------------- Footer --------------------x------------------- -->



    <!-- Jquery Library file -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



    <!-- --------- Owl-Carousel js ------------------->

    <script src="./js/owl.carousel.min.js"></script>



    <!-- ------------ AOS js Library  ------------------------- -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>



    <!-- Custom Javascript file -->

    <script src="./js/blogger.js"></script>

</body>';

    include_once "footer.php";

    echo '

</html>';
} else {

    echo '

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Single Blog</title>



    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="./css/all.css">





    <!-- --------- Owl-Carousel ------------------->

    <link rel="stylesheet" href="./css/owl.carousel.min.css">

    <link rel="stylesheet" href="./css/owl.theme.default.min.css">



    <!-- ------------ AOS Library ------------------------- -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">



    <!-- Custom Style   -->

    <link rel="stylesheet" href="./css/single_blog.css">



</head>';

    include_once "header.php";

    echo '

<body>





    <!----------------------------- Main Site Section ------------------------------>



    <main class="squish">



      

      

        <!-- <div class="owl-navigation">

            <span class="owl-nav-prev"><i class="fas fa-long-arrow-alt-left"></i></span>

            <span class="owl-nav-next"><i class="fas fa-long-arrow-alt-right"></i></span>

        </div> -->

        <!-- ---------------------- Site Content -------------------------->



        <section class="container-fluid">

            <div class="site-content">

                <div class="posts">

                    <div class="post-content" data-aos="fade-in" data-aos-delay="200">

                        <div class="post-image">

                            <div>

                                <img draggable="false" src="./assets/Blog-post/post-1.jpg" class="img" alt="blog1">

                            </div>

                            <div class="post-info flex-row">

                                <span><i class="fas fa-user text-gray"></i>&nbsp;&nbsp;Admin</span>

                                <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August, 6 2021</span>

                                <span>2 Commets</span>

                            </div>

                        </div>

                        <div class="post-title">

                            <h2>this is the default headding</h2>

                            <p>the content goes in here

                            </p>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque voluptas deserunt beatae

                                adipisci iusto totam placeat corrupti ipsum, tempora magnam incidunt aperiam tenetur a

                                nobis, voluptate, numquam architecto fugit. Eligendi quidem ipsam ducimus minus magni

                                illum similique veniam tempore unde?

                            </p>



                            <h2>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste, fugit animi amet delenit</h2>



                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque voluptas deserunt beatae

                                adipisci iusto totam placeat corrupti ipsum, tempora magnam incidunt aperiam tenetur a

                                nobis, voluptate, numquam architecto fugit. Eligendi quidem ipsam ducimus minus magni

                                illum similique veniam tempore unde?

                            </p>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque voluptas deserunt beatae

                                adipisci iusto totam placeat corrupti ipsum, tempora magnam incidunt aperiam tenetur a

                                nobis, voluptate, numquam architecto fugit. Eligendi quidem ipsam ducimus minus magni

                                illum similique veniam tempore unde?

                            </p>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque voluptas deserunt beatae

                                adipisci iusto totam placeat corrupti ipsum, tempora magnam incidunt aperiam tenetur a

                                nobis, voluptate, numquam architecto fugit. Eligendi quidem ipsam ducimus minus magni

                                illum similique veniam tempore unde?

                            </p>

                        </div>

                    </div>



                    <!--Start comment section-->



                    <div class="pt-5 mt-5">

              <h3 class="mb-5">3 Comments</h3>

              <ul class="comment-list">

                <li class="comment">

                  

                  <div class="comment-body">

                    <h3>John Doe</h3>

                    <div class="meta">April 12, 2020 at 1:21am</div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>

                 

                  </div>

                </li>



                <li class="comment">

                 

                  <div class="comment-body">

                    <h3>John Doe</h3>

                    <div class="meta">April 12, 2020 at 1:21am</div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>

                   

                  </div>



                    </li>



                    <li class="comment">

                 

                 <div class="comment-body">

                   <h3>John Doe</h3>

                   <div class="meta">April 12, 2020 at 1:21am</div>

                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>

                  

                 </div>



                   </li>

                  </ul>

                </li>

              </ul>

              <!-- END comment-list -->

              

              <div class="comment-form-wrap pt-5">

                <h3 class="mb-5">Leave a comment</h3>

                <form action="#" class="p-5 bg-light">

                  <div class="form-group"><br>

                    <label for="name">Name *</label>

                    <input type="text" class="form-text" id="name" placeholder="Enter name">

                  </div>

                  <div class="form-group">

                    <label for="email">Email *</label><br>

                    <input type="email" class="form-text" id="email"  placeholder="Enter email">

                  </div>

                  <div class="form-group">

                    <label for="message">Message *</label>

                    <textarea name="" id="message" cols="30" rows="5" class="form-area"  placeholder="Write something"></textarea>

                  </div>

                  <div class="form-group">

                    <input type="submit" value="Post Comment" class="arrow-btn py-3 px-4" style="width:100%;">

                  </div>



                </form>

              </div>

            </div>

            <!--end section-->

                </div>

                

                <aside class="sidebar">

                    <div class="category">

                        <h2>Category</h2>

                        <ul class="category-list">

                            <li class="list-items" data-aos="fade-in" data-aos-delay="100">

                                <a draggable="false" href="#">Software</a>

                                <span>(05)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="200">

                                <a draggable="false" href="#">Techonlogy</a>

                                <span>(02)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="300">

                                <a draggable="false" href="#">Lifestyle</a>

                                <span>(07)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="400">

                                <a draggable="false" href="#">Shopping</a>

                                <span>(01)</span>

                            </li>

                            <li class="list-items" data-aos="fade-in" data-aos-delay="500">

                                <a draggable="false" href="#">Food</a>

                                <span>(08)</span>

                            </li>

                        </ul>

                    </div>

                    <div class="popular-post">

                        <h2>Popular Post</h2>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="200">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-1.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;January 14,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="300">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-2.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="400">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-3.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="500">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-4.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                        <div class="post-content" data-aos="fade-in" data-aos-delay="600">

                            <div class="post-image">

                                <div>

                                    <img draggable="false" src="./assets/popular-post/m-blog-5.jpg" class="img" alt="blog1">

                                </div>

                                <div class="post-info flex-row">

                                    <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;August 6,

                                        2021</span>

                                    <span>2 Commets</span>

                                </div>

                            </div>

                            <div class="post-title">

                                <a draggable="false" href="#">New data recording system to better analyse road accidents</a>

                            </div>

                        </div>

                    </div>

                   

                    <div class="popular-tags">

                        <h2>Popular Tags</h2>

                        <div class="tags flex-row">

                            <span class="tag" data-aos="fade-in" data-aos-delay="100">Software</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="200">technology</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="300">travel</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="400">illustration</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="500">design</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="600">lifestyle</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="700">love</span>

                            <span class="tag" data-aos="fade-in" data-aos-delay="800">project</span>

                        </div>

                    </div>

                </aside>

            </div>

        </section>



        <!-- -----------x---------- Site Content -------------x------------>



    </main>



    <!---------------x------------- Main Site Section ---------------x-------------->







    <!-- -------------x------------- Footer --------------------x------------------- -->



    <!-- Jquery Library file -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

   

<script>

    function showOrHideDiv() {

        var v = document.getElementById("showOrHide");

        if (v.style.display === "none") {

            v.style.display = "block";

        } else {

            v.style.display = "none";

        }

    }

</script>



    <!-- --------- Owl-Carousel js ------------------->

    <script src="./js/owl.carousel.min.js"></script>



    <!-- ------------ AOS js Library  ------------------------- -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>



    <!-- Custom Javascript file -->

    <script src="./js/blogger.js"></script>

</body>';

    include_once "footer.php";

    echo '

</html>';
}
