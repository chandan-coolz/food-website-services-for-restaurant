<?php
session_start();

include "DB_Details.php";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// get the q parameter from URL
$email=$_SESSION['email'];
$amount=$_POST["amount"];
$order_items=$_POST["order_items"];

$sql="INSERT INTO order_details (email,order_items,amount,date,status,remark) VALUES ('$email', '$order_items',$amount, CURRENT_TIMESTAMP,'N',NULL)";



   if ($conn->query($sql) === TRUE) {
 
                                                   header ("Location:success.html");
                                                                die();


                                             } 
                                        else {
                                                        header ("Location:afterLogin.html");
                                                                  die();  
                                             }



$conn->close();

?>




