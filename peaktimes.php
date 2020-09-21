<!DOCTYPE html>
<html>
<!-- insert all preloaded PHP scripts here to autoload all data before rendering page contents, manipulated page content scritps go on bottom -->
<?php
//session start to allow variables to be passed in
session_start();

//send person back if show data button not pressed first
 //send person back if not logged in, security
 if(!isset($_SESSION['public'])){
    header("location: index.php");
 }

// finds logged data entry that can populate table on down the page
include('conn.php'); //changed to /
// $dBLogConnect = "SELECT * FROM FMusers ORDER BY `Time` DESC
// LIMIT 10"; //added limit for media device viewing
// $resultLog = $conn->query($dBLogConnect);

// if(!$resultLog){
//   echo $conn->error;
// }


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


 <!-- Queens logo -->
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
                                    echo "Average footfall for $date where capacity is 100";
                                ?>
                            </h1>
                    </div>
                    <!-- <div class="row"> -->
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> -->
                    <!-- </div> -->
                    <!-- end of row  gathering all hours of specified day and their peak counts  -->
                </div>
            </div>
            <!-- end of selected room data -->
        </div>
        <!-- end of carousel -->
</section>
    <!-- end of section -->

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

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