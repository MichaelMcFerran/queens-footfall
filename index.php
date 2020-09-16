<!DOCTYPE html>
<html>
<!-- insert all preloaded PHP scripts here to autoload all data before rendering page contents, manipulated page content scritps go on bottom -->
<?php
// finds logged data entry that can populate table on down the page
include('conn.php'); //changed to /
$dBLogConnect = "SELECT * FROM FMusers ORDER BY `Time` DESC
LIMIT 10"; //added limit for media device viewing
$resultLog = $conn->query($dBLogConnect);

if(!$resultLog){
  echo $conn->error;
}
?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Footfall Queens</title>
    <!-- Css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
   
    <!-- custom styles -->
    <!-- <link rel="stylesheet" href="../css/style.css" type="text/css"> -->
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
    <!-- Preloading screen -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->

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

<!-- Hero/carousel Section Begin -->
    <!-- modular as can add sections for each required building -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-item set-bg" data-setbg="img/CSBQueens.jpeg">
                <div class="container">
                    <div class="hero-text">
                        <h4>
                            <?php 
                            $building1 = "SELECT DISTINCT buildingName FROM FMBuildings WHERE BuildingID = 1";
                            $nameResult = $conn->query($building1);
                            if(!$nameResult){
                            echo $conn->error;
                            } else {
                                while ($row = $nameResult->fetch_assoc()){
                                    //finds row from table
                                    $name = $row['buildingName'];
                                    echo "$name";
                                    }
                            }
                            ?>
                        </h4>
                        <h1>Room Selection</h1>
                        <form action="index.php" method='POST' enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <select name="RoomBuilding1">

                                    <?php
                                    $roomlist = "SELECT roomName FROM FMRooms WHERE buildingName = '$name'";
                                    $roomResult = $conn->query($roomlist);
                                    if(!$roomResult){
                                    echo $conn->error;
                                    }
                                    
                                    while ($row = $roomResult->fetch_assoc()){
                                    //finds row from table
                                    $rooms = $row['roomName'];
                                    echo "<option value='$rooms'>$rooms</option>";
                                    }
                                    ?>

                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    
                                    <input type="date" title="start date" name="date">
                                </div>
                                <div class="col-lg-4">
                                    <button type="submitDataB1" id="submitB1Btn" name="postB1">Show Data</button>
                                </div>
                        </form>
                            </div>
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                </div>
                                     <!-- table of footfall -->
                                     <table class="table table-hover table-dark">
                                    <thead>
                                        <tr >
                                        <th width="50%">Concurrent Footfall</th>
                                        <th width="50%">Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- gets progress from DB table, then displays -->
                                        <?php
                                        if(isset($_POST['postB1'])){
                                            //add variables for all posted data
                                            //added for security against SQL injections
                                            $room =$conn->real_escape_string($_POST['RoomBuilding1']);
                                            $dateOriginal =$conn->real_escape_string($_POST['date']);
                                            $newDate = date("Y-m-d", strtotime($dateOriginal));
                                            //db entry
                                            $selectDate = "SELECT * FROM FMusers WHERE RoomID = 1 
                                            AND BuildingID = 1 AND `Time` BETWEEN '$newDate 00:00:00' AND '$newdate 23:59:59' ORDER BY `Time` DESC
                                            LIMIT 2";
                                            //db query
                                            $dateResult = $conn->query($selectDate);
                                            if(!$dateResult){
                                                echo $conn->error;
                                            } else {
                                            //must be name of result to check dB data on top, fetchs data
                                                while($row2=$dateResult->fetch_assoc()){
                                                    
                                                    //var names = row of data with explicit dB row name used
                                                    $currentF =$row2['CurrentFootfall']; 
                                                    $Times =$row2['Time'];       
                                                //now echo to display vars with fetched data from dB
                                                echo "
                                                
                                                <tr>
                                                <td>$currentF</td>
                                                <td>$Times</td>
                                                </tr>";
                                                }
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <!-- link to node.js live monitoring and explain -->
                        <a href="" class="primary-btn">Download Logging</a>
                    </div>
                </div>
            </div>
            <!-- start of building 2 data -->
            <div class="single-hero-item set-bg" data-setbg="#">
                <div class="container">
                    <div class="hero-text">
                    <h4>Building 2
                            <?php 
                            // $building2 = "SELECT DISTINCT buildingName FROM `FMBuildings` WHERE BuildingID =2";

                            // $nameResult2 = $conn->query($building2);
                            // if(!$nameResult2){
                            // echo $conn->error;
                            // } else {
                            //     echo "$nameResult2";
                            // }
                            ?>
                        </h4>
                        <h1>Room selection</h1>
                        <a href="" class="primary-btn">Download logging</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->


<div class="container-fluid">
        <div class="row">
        <!-- create space and centre table -->
        <div class="col-lg-4">
        </div>
                 <!-- Table of logging info start-->
                 <div class="col-lg-4">
                    <div class="footer-form set-bg" data-setbg="">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="section-title">
                                    <h2>Recent Footfall</h2>

                                </div>
                                     <!-- table of footfall -->
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
                                           //must be name of result to check dB data on top, fetchs data
                                            while($row=$resultLog->fetch_assoc()){
                                                
                                                //var names = row of data with explicit dB row name used
                                                $build =$row['BuildingID'];
                                                $room =$row['RoomID']; 
                                                $currentF =$row['CurrentFootfall']; 
                                                $Times =$row['Time'];       
                                            //now echo to display vars with fetched data from dB
                                              echo "
                                              
                                              <tr>
                                              <td>$build</td> 
                                              <td>$room</td> 
                                              <td>$currentF</td>
                                              <td>$Times</td>
                                              </tr>";
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of logging info -->
        <div class="col-lg-4">
        </div>
            <!--start-->
            <!-- <div class="col-lg-6">
                    <div class="footer-form set-bg">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="section-title">
                                    <h2>Sensor Connect Test</h2>
                                    <div class="alert alert-success" role="alert">
                                        Current People : <p id ="myCount"> </p>
                                    </div> -->
                                    <!-- <h1 class="cover-heading">PI Button state</h1>
                                        <div class="onoffswitch" style="margin:0px auto;">
                                            <div class="switch demo3">
                                            <input type="checkbox" id="mybuttonGPIO">
                                            <label><i></i></label>
                                            </div>
                                        </div> -->
                                <!-- </div>
                            </div>
                        </div>
                    </div>

            </div> -->
            <!-- end -->
        <div>
    </div>



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
//}

?>
    <!-- Js Plugins -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script> -->
    <script src="/js/main.js"></script>

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