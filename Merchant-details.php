<?php
session_start();


include "DB_Details.php";



$email=$_SESSION['email'];
//$email="array54@gmail.com";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$data = array();

$sql = "SELECT m.merchant_name,m.merchant_email,m.restaurant_name,m.website_status,d.domain_name,d.domain_status from merchant_table m inner join domain_table d on m.merchant_email=d.merchant_email where m.merchant_email='$email'";





$result = $conn->query($sql);

if($result->num_rows>0){


    while($row = $result->fetch_assoc()){
                                           
                                          $data[] = $row['merchant_name'];					
                                          $data[] = $row['merchant_email'];
                                          $data[] = $row['restaurant_name'];					
                                          $data[] = $row['website_status'];
                                          $data[] = $row['domain_name'];
                                          $data[] = $row['domain_status'];					
                                          
                                          }




                        } //if

 else                   {
                         
                        }  //else           





echo json_encode($data);

$conn->close();
?> 

