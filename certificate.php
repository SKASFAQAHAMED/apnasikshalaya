<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/png" href="images/s-icon.png">
    <link rel="stylesheet" href="./css/certificate.css">
    <title>Certificate | Verifies</title>
</head>

<body>
    <?php include_once "./header.php";?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="certificate_area">
                    <div class="c_img">
                        <img src="img/certificate.jpg" alt="certificate image">
                    </div>
                    <div class="c_dec">
                        <p>This certificate above Verifies that <a href="#">User's Name</a> successfully completed the <span>Topic</span> concepts on <span>10/05/2021</span>. The certificate is verified by Apnasikshalaya Team.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="about_course">
                    <h4>About the Course:</h4>
                    <div class="about_content">
                        <img src="img/5778017.jpg" alt="course image">
                        <h3>AWS Concept</h3>
                        <h5>Course content description is added here with the hole description successfully completed.</h5>
                        <h5>Course duration: <span>40h</span></h5>
                        <h5>completed on: <span>1/1/2022</span></h5>
                    </div>
                    <div class="buttons_section">
                        <button class="download_button arrow-btn"><i class="fas fa-download"></i>Download</button>
                        <button class="share_button arrow-btn" onclick="this.style.display='none'; document.getElementById('showOrHide').style.display='flex'; " style="cursor: pointer;"><i class="fas fa-share-square"></i>Share</button>
                        <div class="social-share" id="showOrHide" style="display:none;">
                            <a onclick="Share.twitter('URL','TITLE')" target="_blank" class="arrow-btn"><i class="fab fa-twitter-square"></i></a>
                            <a onclick="Share.facebook('URL','TITLE','IMG_PATH','DESC')" class="arrow-btn" target="_blank"><i class="fab fa-facebook-square"></i></a>
                            <a href="#" target="_blank" class="arrow-btn"><i class="fab fa-linkedin"></i></a>
                            <a href="#" target="_blank" class="arrow-btn"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        Share = {
            facebook: function(purl, ptitle, pimg, text) {
                url = 'http://www.facebook.com/sharer.php?s=100';
                url += '&p[title]=' + encodeURIComponent(ptitle);
                url += '&p[summary]=' + encodeURIComponent(text);
                url += '&p[url]=' + encodeURIComponent(purl);
                url += '&p[images][0]=' + encodeURIComponent(pimg);
                Share.popup(url);
            },
            twitter: function(purl, ptitle) {
                url = 'http://twitter.com/share?';
                url += 'text=' + encodeURIComponent(ptitle);
                url += '&url=' + encodeURIComponent(purl);
                url += '&counturl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            popup: function(url) {
                window.open(url, '', 'toolbar=0,status=0,width=626, height=436');
            }
        };
    </script>
    <?php include_once "./footer.php";?>
</body>

</html>