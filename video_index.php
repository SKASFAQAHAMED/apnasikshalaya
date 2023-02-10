<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/video.css">
    <link rel="shortcut icon" type="image/png" href="images/s-icon.png">
    

    <title>Course Player</title>
  </head>
  <body>
  <?php include_once "./header.php";?>
    <div class="container-fluid">
     <div class="row play-list">
      <div class="main-video col-md-8">
        <div class="video">
          <video src="videos/vid1.mp4" controls controlslist="nodownload"></video>
          <h3 class="title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias expedita nihil natus, nemo obcaecati doloribus velit eos vel impedit assumenda veniam sed ipsa explicabo modi.</h3> <br>
          
          <div class="buttons" id="buttons">
          <button class="btn btn1 .active" id="course-content"onclick="this.classList.add('btn1'); document.getElementById('comment-btn').classList.remove('btn1'); this.nextElementSibling.classList.remove('btn1'); document.getElementById('comment').style.display='none'; document.getElementById('overview').style.display='none';document.getElementById('course-list').style.display='block';">Content</button>
          <button class="btn" onclick="this.classList.add('btn1'); this.nextElementSibling.classList.remove('btn1'); this.previousElementSibling.classList.remove('btn1'); document.getElementById('course-list').style.display='none';document.getElementById('comment').style.display='none'; document.getElementById('overview').style.display='block';">Overview</button>
          <button class="btn" id="comment-btn"  onclick="this.classList.add('btn1'); document.getElementById('course-content').classList.remove('btn1'); this.previousElementSibling.classList.remove('btn1');document.getElementById('course-list').style.display='none'; document.getElementById('overview').style.display='none'; document.getElementById('comment').style.display='block';">Comment</button> <hr>
          </div>
<div class="buttons" id="buttons-web">
  <button class="btn btn1" onclick="this.classList.add('btn1'); this.nextElementSibling.classList.remove('btn1');document.getElementById('comment').style.display='none'; document.getElementById('overview').style.display='block';">Overview</button>
  <button class="btn" id="comment-btn"  onclick="this.classList.add('btn1');this.previousElementSibling.classList.remove('btn1');document.getElementById('overview').style.display='none'; document.getElementById('comment').style.display='block';">Comment</button>
  <br><br>
  <hr>
</div>
   <!-- Over View -->

    <div class="overview" id="overview">
      <div class="details">
        <h2>About this course</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> <br> <hr>

      <div class="rows">
        <div>By the numbers</div>
        <div>
          <div>Skill level: All Levels</div>
          <div>Students: 113085</div>
          <div>Languages: English</div>
          <div>Captions: Yes</div>
        </div>
        <div>
          <div>Lectures: 41</div>
          <div>Video: 3 total hours</div>
        </div>
        </div> <hr>

        <div class="rows certificates">
          <div>Certificates</div>
          <div>
            <div>
              Get Apnasikshalaya certificate by completing entire course</div>
              <div><button class="c_down">Apnasikshalaya Certificate</button></div><br>
          </div>
          </div> 
         
      </div>
    </div>
    <!-- Overview End -->

    <!-- Comment section Start -->
    <div class="mt-2" id="comment" style="display: none;">
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
      
      <!-- END comment-list -->
      
      <div class="comment-form-wrap pt-5">
        <h3>Leave a comment</h3>
        <p>You are commenting as <span>Name</span></p>
        <form action="#" class="bg-white">
          <div class="form-group">
            <textarea name="" id="message" cols="30" rows="5" class="form-area" placeholder="Write a Comment"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Post Comment" class="arrow-btn py-3 px-4" style="width:100%;">
          </div>

        </form>
      </div>
    </div>

    <!-- Comment Section end -->
    
    <!-- Play List Start -->
        </div>
      </div>
  <div class="con col-md-4" id="course-list">
    <h2 style="padding-left: 10px;">Course content</h2> <hr>
      <div class="video-list">
        <details open>
          <summary>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo aliquid aperiam reiciendis sit.<span>0/3<span>, 14 min</span></span></summary>
          <div class="vid" style="display: block;">
            <video src="videos/vid1.mp4" controlslist="nodownload"></video>
              <div class="description"><h3 class="title"><i class="fas fa-check-circle"></i> 1. Lorem ipsum dolor sit amet consectetur.</h3></div>
              <div class="vid_time"><i class="fas fa-play-circle"></i><p>9 min</p></div>
          </div>
          <div class="vid active">
            <video src="videos/vid2.mp4" controlslist="nodownload"></video>
           <div class="description"><h3 class="title"><i class="fas fa-play-circle red"></i> 2. Lorem ipsum dolor sit amet.</h3></div>
           <div class="vid_time"><i class="fas fa-play-circle"></i><p>8 min</p></div>
          </div>
      </details>

      <details>
        <summary>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo aliquid aperiam reiciendis sit.<span>0/3<span>, 14 min</span></span></summary>
        <div class="vid">
          <video src="videos/vid1.mp4"controlslist="nodownload"></video>
          <h3 class="title">3. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo aliquid aperiam reiciendis sit.</h3>
        </div>
        <div class="vid">
          <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
          <h3 class="title">4. Title goes here</h3>
        </div>
        <div class="vid">
          <video src="videos/vid1.mp4"  controlslist="nodownload"></video>
          <h3 class="title">5. Title goes here</h3>
        </div>
        <div class="vid">
          <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
          <h3 class="title">6. Title goes here</h3>
        </div>
    </details>
    
    <details>
      <summary>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo aliquid aperiam reiciendis sit.<span>0/3<span>, 14 min</span></span></summary>
      <div class="vid">
        <video src="videos/vid1.mp4"controlslist="nodownload"></video>
        <h3 class="title">7. Title goes here</h3>
      </div>
      <div class="vid">
        <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
        <h3 class="title">8. Title goes here</h3>
      </div>
      <div class="vid">
        <video src="videos/vid1.mp4"  controlslist="nodownload"></video>
        <h3 class="title">9. Title goes here</h3>
      </div>
      <div class="vid">
        <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
        <h3 class="title">10. Title goes here</h3>
      </div>
  </details>

  <details>
    <summary>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo aliquid aperiam reiciendis sit.<span>0/3<span>, 14 min</span></span></summary>
    <div class="vid">
      <video src="videos/vid1.mp4"controlslist="nodownload"></video>
      <h3 class="title">11. Title goes here</h3>
    </div>
    <div class="vid">
      <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
      <h3 class="title">12. Title goes here</h3>
    </div>
    <div class="vid">
      <video src="videos/vid1.mp4"  controlslist="nodownload"></video>
      <h3 class="title">13. Title goes here</h3>
    </div>
    <div class="vid">
      <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
      <h3 class="title">14. Title goes here</h3>
    </div>
</details>

<details>
  <summary>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo aliquid aperiam reiciendis sit.<span>0/3<span>, 14 min</span></span></summary>
  <div class="vid">
    <video src="videos/vid1.mp4"controlslist="nodownload"></video>
    <h3 class="title">15. Title goes here</h3>
  </div>
  <div class="vid">
    <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
    <h3 class="title">16. Title goes here</h3>
  </div>
  <div class="vid">
    <video src="videos/vid1.mp4"  controlslist="nodownload"></video>
    <h3 class="title">17. Title goes here</h3>
  </div>
  <div class="vid">
    <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
    <h3 class="title">18. Title goes here</h3>
  </div>
  <div class="vid">
    <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
    <h3 class="title">19. Title goes here</h3>
  </div>
  <div class="vid">
    <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
    <h3 class="title">20. Title goes here</h3>
  </div>
  <div class="vid">
    <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
    <h3 class="title">21. Title goes here</h3>
  </div>
  <div class="vid">
    <video src="videos/vid2.mp4"  controlslist="nodownload"></video>
    <h3 class="title">22. Title goes here</h3>
  </div>
</details>

      </div>
    </div>
  </div>


  </div>



  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Play list Script -->

<Script>
  let videoList = document.querySelectorAll('.video-list .vid');
  let mainVideo = document.querySelector('.main-video video');
  let title = document.querySelector('.main-video .title');

  videoList.forEach( video =>{
    video.onclick = () =>{
      videoList.forEach(vid => vid.classList.remove('active'));
      video.classList.add('active');
      if(video.classList.contains('active')){
        let src = video.children[0].getAttribute('src');
        mainVideo.src = src;
        let text = video.children[1].innerHTML;
        title.innerHTML = text;
      }
    }
  });

</Script>
<?php include_once "./footer.php";?>
  </body>
</html>