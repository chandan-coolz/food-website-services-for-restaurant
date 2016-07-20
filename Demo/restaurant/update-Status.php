<?php
session_start();
include "DB_Details.php";
$email=$_SESSION['email'];
//$email="a@gmail.com";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$orderId=$_REQUEST["orderId"];


$sql= "UPDATE order_details SET status='Y' WHERE order_id=$orderId";





if($conn->query($sql) === TRUE) {
   
 


 }

else {

  
 }


														

$conn->close();

?>
  








 

