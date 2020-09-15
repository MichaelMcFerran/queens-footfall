<!DOCTYPE html>
<html>
<script type="text/javascript"> 
// //connection to db test
// var mysql = require('mysql'); //fix

// var con = mysql.createConnection({
//   host: "eu-cdbr-west-03.cleardb.net",
//   user: "b357da7f3209b9",
//   password: "f1318198",
//   database : 'heroku_58f73cf4b46766d'
// });

// con.connect(function(err) {
//     if (err) throw err;
//     con.query("SELECT * FROM FMusers", function (err, result, fields) {
//       if (err) throw err;
//       var resultLo = result;
//       console.log(resultLo);
//     });
//   });

</script>
<!-- insert all preloaded PHP scripts here to autoload all data before rendering page contents, manipulated page content scritps go on bottom -->
<?php
//finds logged data entry that can populate table on down the page
// include('conn.php') //changed to /
// $dBLogConnect = "SELECT * FROM FMusers";
// $resultLog = $conn->query($dBLogConnect);

// if(!$resultLog){
//   echo $conn->error;
// }
?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Footfall CSB </title>
    <!-- Css -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/public/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/public/css/owl.carousel.min.css" type="text/css">
   
    <!-- custom styles -->
    <!-- <link rel="stylesheet" href="../css/style.css" type="text/css"> -->
    <link rel="stylesheet" href="/monitorstyle.css" type="text/css">


 <!-- Queens logo fix -->
    <!-- ****** faviconit.com favicons ****** -->
    <link rel="shortcut icon" href="/public/img/faviconit/favicon.ico">
  <link rel="icon" sizes="16x16 32x32 64x64" href="/public/img/faviconit/favicon.ico">
  <link rel="icon" type="image/png" sizes="196x196" href="/public/img/faviconit/favicon-192.png">
  <link rel="icon" type="image/png" sizes="160x160" href="/public/img/faviconit/favicon-160.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/public/img/faviconit/favicon-96.png">
  <link rel="icon" type="image/png" sizes="64x64" href="/public/img/faviconit/favicon-64.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/public/img/faviconit/favicon-32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/public/img/faviconit/favicon-16.png">
  <link rel="apple-touch-icon" href="/public/img/faviconit/favicon-57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/public/img/faviconit/favicon-114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/public/img/faviconit/favicon-72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/public/img/faviconit/favicon-144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/public/img/faviconit/favicon-60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/public/img/faviconit/favicon-120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/public/img/faviconit/favicon-76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/public/img/faviconit/favicon-152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/public/img/faviconit/favicon-180.png">
  <meta name="msapplication-TileColor" content="#FFFFFF">
  <meta name="msapplication-TileImage" content="/public/img/faviconit/favicon-144.png">
  <meta name="msapplication-config" content="/public/img/faviconit/browserconfig.xml">
  <!-- ****** faviconit.com favicons ****** -->

</head>

<body>
    <!-- Preloading screen -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->

    <!-- Navigation Bar Start -->
    <!-- <header class="header-section">
        <div class="container">
            <div class="logo">
                <a href="/index.php">
                    <img src="img/logo2.png" alt="">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./about.php">About</a></li>
                        <li><a href="#">Workouts</a>
                            <ul class="dropdown">
                                <li><a href="./calisthenics.php">Calisthenics</a></li>
                                <li><a href="./crossfit.php">Crossfit</a></li>
                                <li><a href="./bodybuilding.php">BodyBuilding</a></li>
                            </ul>
                        </li>
                        <li><a href="trainer.php">Trainer</a></li>
                        <li><a href="client.php">Client</a></li>
                        <li><a href="./Admin/login.php">Login</a></li>
                    </ul>
                </nav>
          
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header> -->
    <!-- Nav Bar End -->


<!-- <div class="site-wrapper">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="inner cover">
        <h1 class="cover-heading">CSB foyer</h1> -->
        <!-- <div class="alert alert-success" role="alert">
            Current People : <p id ="myCount"> </p>
          </div> -->
          <!-- below is for front end to pi manipulation -->
      <!-- <h1 class="cover-heading">PI Button state</h1>
          <div class="onoffswitch" style="margin:0px auto;">
            <div class="switch demo3">
              <input type="checkbox" id="mybuttonGPIO">
              <label><i></i></label>
            </div>
          </div> -->
      <!-- </div> -->
    <!-- </div>
  </div>
</div> -->

<div class="container-fluid">
        <div class="row">
                 <!-- Table of logging info start-->
                 <div class="col-lg-6">
                    <div class="footer-form set-bg" data-setbg="">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="section-title">
                                    <h2>Current footfall in all buildings Demo</h2>

                                </div>
                                    "<script> resultLo </script>";
                                       <!-- //added for testing -->
                                       <form action="/" method="post">
                                       <?php console.log("pass vars");?>
                                      </form> 
                                     <!-- table of clients fatLoss Progress -->
                                     <table class="table table-hover table-dark">
                                    <thead>
                                        <tr >
                                        <th width="15%">building ID</th>
                                        <th width="15%">Room ID</th>
                                        <th width="30%">Concurrent Footfall</th>
                                        <th width="30%">Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- gets progress from DB table, then displays -->
                                        <?php
                                        //    //must be name of result to check dB data on top, fetchs data
                                        //     while($row=$resultLog->fetch_assoc()){
                                                
                                        //         //var names = row of data with explicit dB row name used
                                        //         $build =$row['BuildingID'];
                                        //         $room =$row['RoomID']; 
                                        //         $currentF =$row['CurrentFootfall']; 
                                        //         $Times =$row['Time'];       
                                        //     //now echo to display vars with fetched data from dB
                                        //       echo "
                                              
                                        //       <tr>
                                        //       <td>$build</td> 
                                        //       <td>$room</td> 
                                        //       <td>$currentF</td>
                                        //       <td>$Times</td>
                                        //       </tr>";
                                        //     }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- end of logging info -->
            <!-- form for weight plan start-->
            <div class="col-lg-6">
                    <div class="footer-form set-bg">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="section-title">
                                    <h2>Sensor Connect Test</h2>
                                    <div class="alert alert-success" role="alert">
                                        Current People : <p id ="myCount"> </p>
                                    </div>
                                    <!-- <h1 class="cover-heading">PI Button state</h1>
                                        <div class="onoffswitch" style="margin:0px auto;">
                                            <div class="switch demo3">
                                            <input type="checkbox" id="mybuttonGPIO">
                                            <label><i></i></label>
                                            </div>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- form for weight plan end-->
        <div>
    </div>
    <!-- Hero/carousel Section Begin -->
    <!-- <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-item set-bg" data-setbg="#">
                <div class="container">
                    <div class="hero-text">
                        <h4>Body Building Coaching</h4>
                        <h1>Leave your Ego</h1>
                        <a href="./Admin/login.php" class="primary-btn">Login</a>
                    </div>
                </div>
            </div>
            <div class="single-hero-item set-bg" data-setbg="#">
                <div class="container">
                    <div class="hero-text">
                        <h4>Crossfit beginner?</h4>
                        <h1>Let's start with the fundamentals</h1>
                        <a href="./Admin/login.php" class="primary-btn">Login</a>
                    </div>
                </div>
            </div>
            <div class="single-hero-item set-bg" data-setbg="#">
                <div class="container">
                    <div class="hero-text">
                        <h4>Calisthenics Wannabe?</h4>
                        <h1>Let's get those ring Muscle Ups!</h1>
                        <a href="./Admin/login.php" class="primary-btn">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Hero Section End -->


    <!-- Footer Section Begin -->
    <!-- <footer class="footer-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="map-location">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2312.852038465756!2d-5.974364484115035!3d54.571359380254044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x486108a0080eec35%3A0x9027d28ca7db7e7d!2s99A%20Stockmans%20Ln%2C%20Belfast%20BT9%207JD!5e0!3m2!1sen!2suk!4v1586364860999!5m2!1sen!2suk" style="border:0;" allowfullscreen=""></iframe>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-form set-bg" data-setbg="img/squat.jpg">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="section-title">
                                    <h2>Any Queries? Contact us today!</h2>
                                    <p>Tomorrow isn't promised, so let us help you with your fitness goals today.</p>
                                </div>
                                <form action="#" method='POST' enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Name" name="name">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Email" name="email">
                                        </div>
                                        <div class="col-lg-12">
                                            <input type="text" placeholder="Subject" name="subject">
                                            <textarea placeholder="Message" name="body"></textarea>
                                            <button type="submitInterest" id="registerInterestBtn" name="registerInterest">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->
    <!-- Footer Section End -->

<?php

// if(isset($_POST['registerInterest'])){

// //send email to admin from interested person
//                 $Name = $_POST['name'];
//                 $email_user = $_POST['email'];
//                 $subject = $_POST['subject'];
//                 $message = $_POST['body'];

//                 // //admin details, only one admin but can be expanded
//                  $adminemail = "mmcferran628@qub.ac.uk";
//                  //$adminmessage = "Test";
//                  $adminmessage = "$Name has sent you a message. Contact on $email_user - $message";
               

//                  mail($adminemail, $subject, $adminmessage);


//                 //may not be needed
//                 session_destroy(); 
}

?>
    <!-- Js Plugins -->
    <script src="/public/js/jquery-3.3.1.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/jquery.slicknav.js"></script>
    <script src="/public/js/owl.carousel.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script> -->
    <script src="/public/js/main.js"></script>

    <script src="socket.io/socket.io.js"></script>
    <!-- script for conencting to Pi  -->
    <script type="text/javascript">

    // //connect to GPIO of PI
    // var socket = io.connect('/');
	// //jquery takes changed state of toggle on page and passes state to server
    // // $("#myonoffswitch").change(function(){
    // //   socket.emit("stateChanged", this.checked);
    // // });
    
    // socket.on("updatecount", function (count) {
    // 	console.log("The count is: " + count); //checks count is received
	// //js below changes checkbox on html page dynamically as state is send from PI-server-HTML
    // // var personCount = document.getElementById("myCount");
    // // personCount.firstChild.nodeValue = count;
    // document.getElementById("myCount").innerHTML = count;
    
    // });
	
    </script>

    
</body>

</html>