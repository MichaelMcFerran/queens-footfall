<?php
//db config/connection
include('conn.php');
 if(isset($_POST['download'])){
    // $selectDownload = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' AND `Time` BETWEEN '$newDate 00:00:00' AND '$newDate 23:59:59' ORDER BY `Time` DESC";
    // $selectDownload = "SELECT * FROM FMusers WHERE RoomID = '$currentroomId' AND BuildingID = '$buildingId' ORDER BY `Time` DESC"; this is specifc download, trying generic all first
    $selectDownload = "SELECT * FROM FMusers ORDER BY `Time` DESC";
    $downloadResult = $conn->query($selectDownload);
    if(!$downloadResult){
    echo $conn->error;
    }
    if($downloadResult->num_rows > 0){
        $delimiter = ",";
        $filename = "footfallData_" . date('Y-m-d') . ".csv";

        //file pointer
        $file = fopen('php://memory', 'w');

        //set headers for columns
        $fields = array('FootfallID','RoomID','BuildingID','CurrentFootfall','Time');
        fputcsv($file, $fields, $delimiter);

        //output rows of data, format as csv and write to file pointer
        while($row = $downloadResult->fetch_assoc()){
           // $status = ($row['status'] =='1')?'Active':'Inactive'; //ternary operatore to set dv bool value as string value active if 1 is true or inactive if false/0 
           $lineData = array($row['FootfallID'], $row['RoomID'], $row['BuildingID'], $row['CurrentFootfall'], $row['Time'],);
           fputcsv($file, $lineData, $delimiter);
        }
        //move back to beginning of file
        fseek($file, 0);

        //set headers to download file rather than display, needs to be on it's own page to change header info!
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer
        fpassthru($file);
    }
    
    exit;
  
 }

?>