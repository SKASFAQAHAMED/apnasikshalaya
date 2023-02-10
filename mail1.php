<?php
echo'
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: \'Gemunu Libre\', sans-serif;
            font-size: 1.25rem;
        }
        
        div {
            display: flex;
            flex-direction: column;
            padding: 10px;
            max-width: 600px;
            width: 100%;
        }
        
        hr {
            line-height: 1px;
            margin: 0;
            background: #840606;
            color: #840606;
        }
        
        section {
            width: 100%;
            background-color: #FFEFAE;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0px;
        }
        
        .header img {
            width: 30%;
            margin-left: auto;
            margin-right: auto;
        }
        
        p {
            margin: 0 20px;
        }
        
        .footer,
        .body {
            flex-direction: column;
        }
        
        body {
            background-image: url(./s.png);
        }
        
        .stays {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            font-weight: 800;
            letter-spacing: 0.2rem;
        }
        
        .birthday {
            align-items: center;
        }
        
        @media only screen and (max-width: 528px) {
            .stays p {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div>
        <section class="header">
            <img src="https://brown-books.web.app/assets/img/logo/logo.png">
        </section>
        <hr>
        <section class="body">
            <p>Dear. Soumalya Chowdhury,<br> &emsp;Brown Books Foundation is Wishing many many happy returns of the day.I hope you are safe with your family. and enjoying this Day with great pleasure.
            </p>
            <div class="stays">
                <p><i class="fa fa-heartbeat"></i>Stay Happy</p>
                <p><i class="fa fa-check-circle-o"></i>Stay Safe</p>
                <p><i class="fa fa-smile-o"></i>Have Fun</p>
            </div>
            <div class="birthday">
                <h2>Happy Birth Day</h2>
            </div>
            <div class="regards">
                <p>
                    Thanks & Regards<br>Soumalya Chowdhury
                </p>
            </div>
        </section>
        <hr>
        <section class="footer">
            <p>This is a system genarated mail. please do not reply this mail.
            </p>
            <center>
                <p>
                    Brown Books Foundation
                </p>
            </center>
        </section>
    </div>
</body>

</html>
';
