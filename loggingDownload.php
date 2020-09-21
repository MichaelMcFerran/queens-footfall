<?php
//db config/connection
include('conn.php');
    //sql for getting data from db
    $selectDownload = "SELECT * FROM FMusers ORDER BY `Time` DESC";
    $downloadResult = $conn->query($selectDownload);
    if(!$downloadResult){
    echo $conn->error;
    }
    //download only if sql query returns data results
    if($downloadResult->num_rows > 0){
        $delimiter = ","; //used to separate each string of data
        $filename = "footfallData_" . date('Y-m-d') . ".csv"; //name each download according to todays date and put in a .csv file

        //file pointer
        $file = fopen('php://memory', 'w');

        //set headers for columns in new data file
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
  
 //}

?>