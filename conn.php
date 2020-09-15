<!-- doesnt work -->
<!-- Below File is crucial for connecting each PHP script to DB, and is reusable each time -->
<?php
        $host = "eu-cdbr-west-03.cleardb.net";
        $user = "b357da7f3209b9";
        $pw = "f1318198";
        $db = "heroku_58f73cf4b46766d";
 
        $conn = new mysqli($host, $user, $pw, $db);
 
        if($conn->connect_error) {
          echo $conn->connect_error;
        } else {
          echo "connected";
        }
?>