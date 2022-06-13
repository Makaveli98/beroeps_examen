<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'mysql');
define('DB_NAME', 'beroepsexamen');
 
//  Verbinding naar MySQL DB
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Connectie vaststellen 
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>