<!DOCTYPE html>
<html>
<!-- insert all preloaded PHP scripts here to autoload all data before rendering page contents, manipulated page content scritps go on bottom -->
<?php
//session start to allow variables to be passed in
session_start();

//send person back to index.php if show data button not pressed first
 if(!isset($_SESSION['public'])){
    header("location: /index.php");
 }

 include('conn.php'); //database config file
$roomCapacity = "SELECT DISTINCT Capacity FROM FMRooms WHERE roomName = '$room'"; 
//added limit for media device viewing
$resultCap = $conn->query($roomCapacity);
if(!$resultCap){
    echo $conn->error;
 } 
 else {
        while($row15=$resultCap->fetch_assoc()){
        
            // gets capacity from databases' rooms table
            $roomCap =$row15['Capacity']; 
        }
    }
?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peak Footfall Queens</title>
    <!-- Css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
   
    <!-- custom styles -->
    <link rel="stylesheet" href="css/style.css" type="text/css">


 <!-- Queens logo  on browser tab corner-->
	<!-- ****** faviconit.com favicons ****** -->
	<link rel="shortcut icon" href="imh/favicon.ico">
	<link rel="icon" sizes="16x16 32x32 64x64" href="img/faviconit/favicon.ico">
	<link rel="icon" type="image/png" sizes="196x196" href="img/faviconit/favicon-192.png">
	<link rel="icon" type="image/png" sizes="160x160" href="img/faviconit/favicon-160.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/faviconit/favicon-96.png">
	<link rel="icon" type="image/png" sizes="64x64" href="img/faviconit/favicon-64.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/faviconit/favicon-32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/faviconit/favicon-16.png">
	<link rel="apple-touch-icon" href="img/faviconit/favicon-57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/faviconit/favicon-114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/faviconit/favicon-72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/faviconit/favicon-144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/faviconit/favicon-60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/faviconit/favicon-120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/faviconit/favicon-76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/faviconit/favicon-152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/faviconit/favicon-180.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="img/faviconit/favicon-144.png">
	<meta name="msapplication-config" content="img/faviconit/browserconfig.xml">
	<!-- ****** faviconit.com favicons ****** -->

</head>

<body>
<!-- Hero/carousel Section Begin -->
    <!-- modular as can add sections for each required building -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <!-- start of selected room data -->
            <div class="single-hero-item set-bg" data-setbg="#">
                <div class="container">
                    <div class ="row">
                        <div class="hero-text">
                            <h4>
                                <?php 
                                    //sets var of user
                                    // $id = $_SESSION['public'];
                                    //sets room and building passed in from session variable so they can be used in php querys
                                    $room = $_SESSION['room'];
                                    $building = $_SESSION['building'];
                                    echo " Data shown for $building and room is $room";
                                ?> 
                            </h4>
                            
                            <h1>
                                <?php
                                    $date = $_SESSION['date'];
                                    // need to add capacity from db when created
                                    echo "Average footfall for $date where capacity is $roomCap";
                                ?>
                            </h1>
                    </div>
                </div>
            </div>
            <!-- end of selected room data -->
        </div>
        <!-- end of carousel -->
</section> <!-- end of section -->

<!-- start of progress bars showing average footfall for hours between 9 -5 with values inputted by php and mysql -->
<!-- container to hold all the daily values together -->
<div class="container">
  <h2  style="color:white;">9AM - 10AM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg9 = $_SESSION['avg9am'];
        echo $avg9;
        ?>%;">
                <?php
        echo $avg9; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">10AM - 11AM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg10 = $_SESSION['avg10am'];
        echo $avg10;
        ?>%;">
                <?php
        echo $avg10; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">11AM - 12PM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg11 = $_SESSION['avg11am'];
        echo $avg11;
        ?>%;">
                <?php
        echo $avg11; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">12PM - 1PM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg12 = $_SESSION['avg12pm'];
        echo $avg12;
        ?>%;">
                <?php
        echo $avg12; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">1PM - 2PM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg1 = $_SESSION['avg1pm'];
        echo $avg1;
        ?>%;">
                <?php
        echo $avg1; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">2PM - 3PM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg2 = $_SESSION['avg2pm'];
        echo $avg2;
        ?>%;">
                <?php
        echo $avg2; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">3PM - 4PM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg3 = $_SESSION['avg3pm'];
        echo $avg3;
        ?>%;">
                <?php
        echo $avg3; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">4PM - 5PM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg4 = $_SESSION['avg4pm'];
        echo $avg4;
        ?>%;">
                <?php
        echo $avg4; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>

  <h2  style="color:white;">5PM - 6PM</h2>
  <div class="progress">
    <!-- value is passed in through session value of last page into the style tag and displayed  -->
    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php
        $avg5 = $_SESSION['avg5pm'];
        echo $avg5;
        ?>%;">
                <?php
        echo $avg5; //this displays value numerically ontop of bar
        ?>
    </div>
  </div>
</div>
<!-- end of progress bars -->

</body>



    <!-- Js Plugins -->
    <!-- <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>

</html>