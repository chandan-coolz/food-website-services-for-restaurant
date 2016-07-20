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

$sql1 = "select  * from customer_data where email='$email'";





$result = $conn->query($sql1);

if($result->num_rows>0){


    while($row = $result->fetch_assoc()){
                                           
                                          $data[] = $row['name'];					
                                          $data[] = $row['password'];
                                          $data[] = $row['mobile'];					
                                          $data[] = $row['company'];
                                          $data[] = $row['flat'];
                                          $data[] = $row['locality'];					
                                          $data[] = $row['postal_code'];
                                        
        
                                         }




                        } //if

 else                   {
                         
                        }  //else           





echo json_encode($data);

$conn->close();
?> 

