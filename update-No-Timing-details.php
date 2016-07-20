<?php
session_start();

include "DB_Details.php";
require("class.phpmailer.php");

if(isset($_SESSION['email'])) {








// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$email=$_SESSION['email'];

$sql2 = "DELETE FROM update_restaurant_timing  WHERE merchant_email='$email'";
$conn->query($sql2);



$sql = "INSERT INTO update_restaurant_timing(merchant_email,open_time,close_time,holiday,date,served)
VALUES ('$email','24x7','24x7','24x7',CURRENT_TIMESTAMP,'N')";






if ($conn->query($sql) === TRUE) {

echo"success";
    
} else {
 
       echo"fail";
}

$conn->close();

  
}else{
 
         echo"notlogged";
}
?> 

