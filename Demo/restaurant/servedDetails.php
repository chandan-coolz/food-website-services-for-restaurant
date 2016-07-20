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



$data = array();

$sql1 = "select o.order_id,o.order_items,o.amount,o.date,c.name,c.mobile,c.company,c.flat,c.locality,c.postal_code from customer_data c inner join order_details o on o.email=c.email where o.status='Y' ORDER BY o.date DESC;";





$result = $conn->query($sql1);

if($result->num_rows>0){


    while($row = $result->fetch_assoc()){
                                           
                                          $data[] = $row['order_id'];					
                                          $data[] = $row['order_items'];
                                          $data[] = $row['amount'];					
                                          $data[] = $row['date'];
                                          $data[] = $row['name'];
                                          $data[] = $row['mobile'];			
                                          $data[] = "company: ".$row['company'].", flat: ".$row['flat'].", locality: ".$row['locality'].", postal code :".$row['postal_code'];
                                        
        
                                         }




                        } //if

 else                   {
                         
                        }  //else           





echo json_encode($data);

$conn->close();
?> 

