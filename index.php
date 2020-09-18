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
            <!-- start of building 1 data -->
            <div class="single-hero-item set-bg" data-setbg="img/CSBQueens.jpg">
                <div class="container">
                    <div class="hero-text"> 
                        <h4>
                            <?php 
                            $buildingId = 1; //need to find out how to increment per carousel slide
                            $building = "SELECT DISTINCT buildingName FROM FMBuildings WHERE BuildingID = '$buildingId'";
                            $nameResult = $conn->query($building);
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
                                    <!-- <button type="submitDataB1" class="primary-btn" name="postB">Show Data</button> -->
                                    <button type="submitDataB1" name="postB">Show Data</button>
                                </div>
                            </div>                     
                        </form>
                            
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                </div>
                                     <!-- table of footfall -->
                                     <table class="table table-hover table-dark">
                                    <thead>
                                        <tr >
                                        <th width="40%">Room</th>
                                        <th width="20%">Concurrent Footfall</th>
                                        <th width="40%">Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- gets progress from DB table, then displays -->
                                        <?php
                                        if(isset($_POST['postB'])){
                                            //if no date is given, display todays date values as result
                                            if(empty($_POST['date'])){
                                                //add variables for all posted data
                                                $room =$conn->real_escape_string($_POST['RoomBuilding1']);
                                                //default date to current if not specified
                                                $currentdate = date("Y-m-d");
                                                //already have building ID

                                                //automatically getting roomID based on selection made, could auto do building but number must be auto gen from moment new carousel created
                                                $roomID = "SELECT DISTINCT roomID FROM `FMRooms` WHERE roomName = '$room'" ;
                                                $roomIdResult = $conn->query($roomID);
                                                if(!$roomIdResult){
                                                    echo $conn->error;
                                                } 
                                                else {
                                                        while($row2=$roomIdResult->fetch_assoc()){
                                                        
                                                            //var names = row of data with explicit dB row name used
                                                            $currentroomId =$row2['roomID']; 
                                                        }
                                                    }
                                                //db entry
                                                $selectToday = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$currentdate 00:00:00' AND '$currentdate 23:59:59' ORDER BY `Time` DESC LIMIT 2";
                                                //db query
                                                $todayResult = $conn->query($selectToday);
                                                if(!$todayResult){
                                                    echo $conn->error;
                                                } else {
                                                //must be name of result to check dB data on top, fetchs data
                                                    while($row5=$todayResult->fetch_assoc()){
                                                        
                                                        //var names = row of data with explicit dB row name used
                                                        $currentF =$row5['CurrentFootfall']; 
                                                        $Times =$row5['Time'];   
                                                        // change room ID to name  !  
                                                    //now echo to display vars with fetched data from dB
                                                    echo "
                                                    
                                                    <tr>
                                                    <td>$room</td>
                                                    <td>$currentF</td>
                                                    <td>$Times</td>
                                                    </tr>";
                                                    }
                                                }
                                            }
                                            // if all room posted, if date posted, then pressing show data displays the following
                                            //add variables for all posted data
                                            //added for security against SQL injections
                                            $room =$conn->real_escape_string($_POST['RoomBuilding1']);
                                            $dateOriginal =$conn->real_escape_string($_POST['date']);
                                            $replaceddate = str_replace("/", "-", $dateOriginal);
                                            $newDate = date("Y-m-d", strtotime($replaceddate));

                                            //automatically getting roomID based on selection made, could auto do building but number must be auto gen from moment new carousel created
                                            $roomID = "SELECT DISTINCT roomID FROM `FMRooms` WHERE roomName = '$room'" ;
                                            $roomIdResult = $conn->query($roomID);
                                            if(!$roomIdResult){
                                                echo $conn->error;
                                             } 
                                             else {
                                                    while($row4=$roomIdResult->fetch_assoc()){
                                                    
                                                        //var names = row of data with explicit dB row name used
                                                        $currentroomId =$row4['roomID']; 
                                                    }
                                                }
                                            //db entry
                                            $selectDate = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$newDate 00:00:00' AND '$newDate 23:59:59' ORDER BY `Time` DESC LIMIT 2";
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
                                                <td>$room</td>
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
                        <div class="row">
                            <div class="col-lg-5"> 
                                <!-- form used to trigger post when button pressed -->
                                <form action="index.php" method='POST' enctype="multipart/form-data">
                                    <!-- <button type="button" class="primary-btn" name="download">Download Logging</button> -->
                                    <!-- <button class="primary-btn" name="download">Download Logging</button> -->
                                    <button type="submitDownload" class="primary-btn" name="download">Download Logging</button>
                                </form>
                            </div>
                            <!-- create space -->
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-5">
                                <!-- link to node.js live monitoring and explain -->
                                <a href="https://queens-footfall-monitor.herokuapp.com/" class="primary-btn">live Data Viewer</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end of building 1 data  -->
            <!-- start of building 2 data -->
            <div class="single-hero-item set-bg" data-setbg="img/SU.png">
                <div class="container">
                    <div class="hero-text"> 
                        <h4>
                            <?php 
                            $buildingId = 2; //need to find out how to increment per carousel slide
                            $building = "SELECT DISTINCT buildingName FROM FMBuildings WHERE BuildingID = '$buildingId'";
                            $nameResult = $conn->query($building);
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
                                    <select name="RoomBuilding">

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
                                    <!-- <button type="submitDataB" class="primary-btn" name="postB">Show Data</button> -->
                                    <!--named the same as first building, posts data for both at the same time when one button clicked  -->
                                    <button type="submitDataB" name="postB">Show Data</button>
                                </div>
                            </div>                     
                        </form>
                            
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                </div>
                                     <!-- table of footfall -->
                                     <table class="table table-hover table-dark">
                                    <thead>
                                        <tr >
                                        <th width="40%">Room</th>
                                        <th width="20%">Concurrent Footfall</th>
                                        <th width="40%">Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- gets progress from DB table, then displays -->
                                        <?php
                                        if(isset($_POST['postB'])){
                                            //if no date is given, display todays date values as result
                                            if(empty($_POST['date'])){
                                                //add variables for all posted data
                                                $room =$conn->real_escape_string($_POST['RoomBuilding']);
                                                //default date to current if not specified
                                                $currentdate = date("Y-m-d");
                                                //already have building ID

                                                //automatically getting roomID based on selection made, could auto do building but number must be auto gen from moment new carousel created
                                                $roomID = "SELECT DISTINCT roomID FROM `FMRooms` WHERE roomName = '$room'" ;
                                                $roomIdResult = $conn->query($roomID);
                                                if(!$roomIdResult){
                                                    echo $conn->error;
                                                } 
                                                else {
                                                        while($row2=$roomIdResult->fetch_assoc()){
                                                        
                                                            //var names = row of data with explicit dB row name used
                                                            $currentroomId =$row2['roomID']; 
                                                        }
                                                    }
                                                //db entry
                                                $selectToday = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$currentdate 00:00:00' AND '$currentdate 23:59:59' ORDER BY `Time` DESC LIMIT 2";
                                                //db query
                                                $todayResult = $conn->query($selectToday);
                                                if(!$todayResult){
                                                    echo $conn->error;
                                                } else {
                                                //must be name of result to check dB data on top, fetchs data
                                                    while($row5=$todayResult->fetch_assoc()){
                                                        
                                                        //var names = row of data with explicit dB row name used
                                                        $currentF =$row5['CurrentFootfall']; 
                                                        $Times =$row5['Time'];   
                                                        // change room ID to name  !  
                                                    //now echo to display vars with fetched data from dB
                                                    echo "
                                                    
                                                    <tr>
                                                    <td>$room</td>
                                                    <td>$currentF</td>
                                                    <td>$Times</td>
                                                    </tr>";
                                                    }
                                                }
                                            }
                                            //add variables for all posted data
                                            //added for security against SQL injections
                                            $room =$conn->real_escape_string($_POST['RoomBuilding']);
                                            $dateOriginal =$conn->real_escape_string($_POST['date']);
                                            $replaceddate = str_replace("/", "-", $dateOriginal);
                                            $newDate = date("Y-m-d", strtotime($replaceddate));

                                            //automatically getting roomID based on selection made, could auto do building but number must be auto gen from moment new carousel created
                                            $roomID = "SELECT DISTINCT roomID FROM `FMRooms` WHERE roomName = '$room'" ;
                                            $roomIdResult = $conn->query($roomID);
                                            if(!$roomIdResult){
                                                echo $conn->error;
                                             } 
                                             else {
                                                    while($row4=$roomIdResult->fetch_assoc()){
                                                    
                                                        //var names = row of data with explicit dB row name used
                                                        $currentroomId =$row4['roomID']; 
                                                    }
                                                }
                                            //db entry
                                            $selectDate = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$newDate 00:00:00' AND '$newDate 23:59:59' ORDER BY `Time` DESC LIMIT 3";
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
                                                <td>$room</td>
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
                        <div class="row">
                            <div class="col-lg-5"> 
                                <button type="submitDataB" class="primary-btn" name="downloadB2">Download Logging</button>
                            </div>
                            <!-- create space -->
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-5">
                                <!-- link to node.js live monitoring and explain -->
                                <a href="https://queens-footfall-monitor.herokuapp.com/" class="primary-btn">live Data Viewer</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end of logging data 2 -->
            <!-- start of building 3 data -->
            <div class="single-hero-item set-bg" data-setbg="#">
                            <div class="container">
                                <div class="hero-text"> 
                                    <h4>
                                        <?php 
                                        // $buildingId = 2; //need to find out how to increment per carousel slide
                                        // $building = "SELECT DISTINCT buildingName FROM FMBuildings WHERE BuildingID = '$buildingId'";
                                        // $nameResult = $conn->query($building);
                                        // if(!$nameResult){
                                        // echo $conn->error;
                                        // } else {
                                        //     while ($row = $nameResult->fetch_assoc()){
                                        //         //finds row from table
                                        //         $name = $row['buildingName'];
                                        //         echo "$name";
                                        //         }
                                        // }
                                        ?>
                                    </h4>
                                    <h1>Room Selection</h1>
                                    <form action="index.php" method='POST' enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <select name="RoomBuilding">

                                                <?php
                                                // $roomlist = "SELECT roomName FROM FMRooms WHERE buildingName = '$name'";
                                                // $roomResult = $conn->query($roomlist);
                                                // if(!$roomResult){
                                                // echo $conn->error;
                                                // }
                                                
                                                // while ($row = $roomResult->fetch_assoc()){
                                                // //finds row from table
                                                // $rooms = $row['roomName'];
                                                // echo "<option value='$rooms'>$rooms</option>";
                                                // }
                                                ?>

                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                
                                                <input type="date" title="start date" name="date">
                                            </div>
                                            <div class="col-lg-4">
                                                <!-- if this is named same as other two, will post data for this building too when one button is posted/clicked -->
                                                <button type="submitDataB" class="primary-btn" name="postB3">Show Data</button>
                                            </div>
                                        </div>                     
                                    </form>
                                        
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="section-title">
                                            </div>
                                                <!-- table of footfall -->
                                                <table class="table table-hover table-dark">
                                                <thead>
                                                    <tr >
                                                    <th width="40%">Room</th>
                                                    <th width="20%">Concurrent Footfall</th>
                                                    <th width="40%">Timestamp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- gets progress from DB table, then displays -->
                                                    <?php
                                                    // if(isset($_POST['postB'])){
                                                    // //if no date is given, display todays date values as result
                                                    // if(empty($_POST['date'])){
                                                    //     //add variables for all posted data
                                                    //     $room =$conn->real_escape_string($_POST['RoomBuilding']);
                                                    //     //default date to current if not specified
                                                    //     $currentdate = date("Y-m-d");
                                                    //     //already have building ID

                                                    //     //automatically getting roomID based on selection made, could auto do building but number must be auto gen from moment new carousel created
                                                    //     $roomID = "SELECT DISTINCT roomID FROM `FMRooms` WHERE roomName = '$room'" ;
                                                    //     $roomIdResult = $conn->query($roomID);
                                                    //     if(!$roomIdResult){
                                                    //         echo $conn->error;
                                                    //     } 
                                                    //     else {
                                                    //             while($row2=$roomIdResult->fetch_assoc()){
                                                                
                                                    //                 //var names = row of data with explicit dB row name used
                                                    //                 $currentroomId =$row2['roomID']; 
                                                    //             }
                                                    //         }
                                                    //     //db entry
                                                    //     $selectToday = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$currentdate 00:00:00' AND '$currentdate 23:59:59' ORDER BY `Time` DESC LIMIT 3";
                                                    //     //db query
                                                    //     $todayResult = $conn->query($selectToday);
                                                    //     if(!$todayResult){
                                                    //         echo $conn->error;
                                                    //     } else {
                                                    //     //must be name of result to check dB data on top, fetchs data
                                                    //         while($row5=$todayResult->fetch_assoc()){
                                                                
                                                    //             //var names = row of data with explicit dB row name used
                                                    //             $currentF =$row5['CurrentFootfall']; 
                                                    //             $Times =$row5['Time'];   
                                                    //             // change room ID to name  !  
                                                    //         //now echo to display vars with fetched data from dB
                                                    //         echo "
                                                            
                                                    //         <tr>
                                                    //         <td>$room</td>
                                                    //         <td>$currentF</td>
                                                    //         <td>$Times</td>
                                                    //         </tr>";
                                                    //         }
                                                    //     }
                                                    // }
                                                    //     //add variables for all posted data
                                                    //     //added for security against SQL injections
                                                    //     $room =$conn->real_escape_string($_POST['RoomBuilding']);
                                                    //     $dateOriginal =$conn->real_escape_string($_POST['date']);
                                                    //     $replaceddate = str_replace("/", "-", $dateOriginal);
                                                    //     $newDate = date("Y-m-d", strtotime($replaceddate));

                                                    //     //automatically getting roomID based on selection made, could auto do building but number must be auto gen from moment new carousel created
                                                    //     $roomID = "SELECT DISTINCT roomID FROM `FMRooms` WHERE roomName = '$room'" ;
                                                    //     $roomIdResult = $conn->query($roomID);
                                                    //     if(!$roomIdResult){
                                                    //         echo $conn->error;
                                                    //      } 
                                                    //      else {
                                                    //             while($row4=$roomIdResult->fetch_assoc()){
                                                                
                                                    //                 //var names = row of data with explicit dB row name used
                                                    //                 $currentroomId =$row4['roomID']; 
                                                    //             }
                                                    //         }
                                                    //     //db entry
                                                    //     $selectDate = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$newDate 00:00:00' AND '$newDate 23:59:59' ORDER BY `Time` DESC LIMIT 3";
                                                    //     //db query
                                                    //     $dateResult = $conn->query($selectDate);
                                                    //     if(!$dateResult){
                                                    //         echo $conn->error;
                                                    //     } else {
                                                    //     //must be name of result to check dB data on top, fetchs data
                                                    //         while($row2=$dateResult->fetch_assoc()){
                                                                
                                                    //             //var names = row of data with explicit dB row name used
                                                    //             $currentF =$row2['CurrentFootfall']; 
                                                    //             $Times =$row2['Time'];       
                                                    //         //now echo to display vars with fetched data from dB
                                                    //         echo "
                                                            
                                                    //         <tr>
                                                    //         <td>$room</td>
                                                    //         <td>$currentF</td>
                                                    //         <td>$Times</td>
                                                    //         </tr>";
                                                    //         }
                                                    //     }
                                                    // }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5"> 
                                            <!-- <a href="" class="primary-btn" name ="download">Download Logging</a> -->
                                            <button type="submitDataB" class="primary-btn" name="downloadB3">Download Logging</button>

                                        </div>
                                        <!-- create space -->
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-5">
                                            <!-- link to node.js live monitoring and explain -->
                                            <a href="https://queens-footfall-monitor.herokuapp.com/" class="primary-btn">live Data Viewer</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of logging data 3 -->
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
    <footer class="footer-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="map-location">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2312.11136348084!2d-5.936243348119055!3d54.58441178885766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x486108ea57227da7%3A0x3cecfa2a15d642e1!2sQueen&#39;s%20University%20Belfast!5e0!3m2!1sen!2suk!4v1600390527886!5m2!1sen!2suk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
                <!-- <div class="col-lg-6">
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
                </div> -->
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

<?php
//allowing users to download logging data https://www.youtube.com/watch?v=Xp0pZ6OmJv0
 if(isset($_POST['download'])){
    // // $selectDownload = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$newDate 00:00:00' AND '$newDate 23:59:59' ORDER BY `Time` DESC";
    // // $selectDownload = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' ORDER BY `Time` DESC"; this is specifc download, trying generic all first
    // $selectDownload = "SELECT * FROM FMusers ORDER BY `Time` DESC";
    // $downloadResult = $conn->query($selectDownload);
    // if(!$downloadResult){
    // echo $conn->error;
    // }
    // if($downloadResult->num_rows > 0){
    //     $delimiter = ",";
    //     $filename = "footfallData_" . date('Y-m-d') . ".csv";

    //     //file pointer
    //     $file = fopen('php://memory', 'w');

    //     //set headers for columns
    //     $fields = array('FootfallID','RoomID','BuildingID','CurrentFootfall','Time');
    //     fputcsv($file, $fields, $delimiter);

    //     //output rows of data, format as csv and write to file pointer
    //     while($row = $query->fetch_assoc()){
    //        // $status = ($row['status'] =='1')?'Active':'Inactive'; //ternary operatore to set dv bool value as string value active if 1 is true or inactive if false/0 
    //        $lineData = array($row['FootfallID'], $row['RoomID'], $row['BuildingID'], $row['CurrentFootfall'], $row['Time'],);
    //        fputcsv($file, $lineData, $delimiter);
    //     }
    //     //move back to beginning of file
    //     fseek($file, 0);

    //     //set headers to download file rather than display
    //     header('Content-Type: text/csv');
    //     header('Content-Disposition: attachment; filename="' . $filename . '";');

    //     //output all remaining data on a file pointer
    //     fpassthru($file);
    // }
    // exit;
        echo "posted";
 }

?>
    <!-- Js Plugins -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script> -->
    <script src="/js/main.js"></script>


    
</body>

</html>