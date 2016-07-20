<?php
session_start();


include "DB_Details.php";


if(isset($_SESSION['email'])) {

$email=$_SESSION['email'];


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$data = array();

$sql = "SELECT merchant_name,merchant_email,merchant_mobile from merchant_table where merchant_email='$email'";





$result = $conn->query($sql);

if($result->num_rows>0){


    while($row = $result->fetch_assoc()){

                                          $data[] = $row['merchant_name'];					
                                          $data[] = $row['merchant_email'];
                                          $data[] = $row['merchant_mobile'];					

                                          }




                        } //if

 else                   {
                         
                        }  //else           





echo json_encode($data);

$conn->close();

}else{
      echo"notlogged";
}
?> 

