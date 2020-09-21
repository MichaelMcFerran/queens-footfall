<!DOCTYPE html>
<html>
<!-- insert all preloaded PHP scripts here to autoload all data before rendering page contents, manipulated page content scritps go on bottom -->
<?php
//start a session to pass variables onto other pages when needed
session_start();

// finds logged data entry that can populate table on down the page
include('conn.php'); //changed to /
$dBLogConnect = "SELECT * FROM FMusers ORDER BY `Time` DESC
LIMIT 20"; //added limit for media device viewing
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
    <div id="preloader">
        <div class="loader"></div>
    </div>



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

                                            //creates a session based on public user, no login needed, and passing variables from pressing show data then the view trends button
                                            $_SESSION['public'] = "publicuser"; //used to confirm that show data pressed before view trends
                                            $_SESSION['room'] = $room;
                                            $_SESSION['building'] = $name;
                                            $_SESSION['date'] = $newDate;

                                            //now to get full db entry to find average footfall per hour between 9 -5 
                                            $avg9am= "SELECT AVG(CurrentFootfall) 'Average Footfall' FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$newDate 08:00:00' AND '$newDate 09:00:00' ORDER BY `Time`";
                                            $avg9Result = $conn->query($avg9am);
                                            if(!$avg9Result){
                                                echo $conn->error;
                                             } 
                                             else {
                                                while($row2=$avg9Result->fetch_assoc()){
                                                    // get result array
                                                    $avg9 =$row['Average Footfall']; 
                                                    if(is_null($avg9)){
                                                        $_SESSION['avg9am'] = '1'; //if avg value is null/ no entry during this hour, pass session value as 1
                                                    } else {
                                                        $_SESSION['avg9am'] = $avg9;
                                                    }
                                                }
                                            }
                                        } 
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"> 
                                <!-- form used to trigger post when button pressed -->
                                <form action="index.php" method='POST' enctype="multipart/form-data">
                                    <!-- <button type="submitDownload" class="primary-btn" name="download">Download Logging</button> -->
                                    <a href="loggingDownload.php" class="primary-btn">Download Logging</a>
                                </form>
                            </div>
                            <!-- button to view peaks based on shown data -->
                            <div class="col-lg-4">
                                <a href="/peaktimes.php" class="primary-btn">View trends</a>
                            </div>
                            <div class="col-lg-4">
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
                            <div class="col-lg-4"> 
                                <!-- form used to trigger post when button pressed -->
                                <form action="index.php" method='POST' enctype="multipart/form-data">
                                <!-- button is named same as other buildings, so same downlaod php script carried out at bottom -->
                                    <!-- <button type="submitDownload" class="primary-btn" name="download">Download Logging</button> -->
                                    <a href="loggingDownload.php" class="primary-btn">Download Logging</a>
                                </form>
                            </div>
                            <!-- button to view peaks based on shown data -->
                            <div class="col-lg-4">
                                <a href="/peaktimes.php" class="primary-btn">View trends</a>
                            </div>
                            <div class="col-lg-4">
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
                                        <div class="col-lg-4"> 
                                            <!-- form used to trigger post when button pressed -->
                                            <form action="index.php" method='POST' enctype="multipart/form-data">
                                            <!-- button is named same as other buildings, so same downlaod php script carried out at bottom -->
                                                <!-- <button type="submitDownload" class="primary-btn" name="download">Download Logging</button> -->
                                                <a href="loggingDownload.php" class="primary-btn">Download Logging</a>
                                            </form>
                                        </div>
                                        <!-- button to view peaks based on shown data -->
                                        <div class="col-lg-4">
                                            <a href="/peaktimes.php" class="primary-btn">View trends</a>
                                        </div>
                                        <div class="col-lg-4">
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






<!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="map-location">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2312.11136348084!2d-5.936243348119055!3d54.58441178885766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x486108ea57227da7%3A0x3cecfa2a15d642e1!2sQueen&#39;s%20University%20Belfast!5e0!3m2!1sen!2suk!4v1600390527886!5m2!1sen!2suk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
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
            <!-- create space and centre table -->
            <div class="col-lg-4">
            </div>
        <div>
</div>
    </footer>
<!-- Footer Section End -->


    <!-- Js Plugins -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>


    
</body>

</html>