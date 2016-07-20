<?php
session_start();

include "DB_Details.php";



$email=$_SESSION['email'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$name=$_POST['name'];
$password=$_POST['password'];
$company=$_POST['company'];
$flat=$_POST['flat'];
$locality=$_POST['locality'];
$mobile=$_POST['mobile'];
$postalcode=$_POST['postalcode'];

if(!$postalcode==NULL)
{
$sql= "UPDATE customer_data SET name='$name', password='$password', mobile='$mobile', company='$company', flat='$flat', locality='$locality', postal_code=$postalcode WHERE email='$email'";

}

else
{

$sql= "UPDATE customer_data SET name='$name',password='$password',mobile='$mobile', company='$company', flat='$flat', locality='$locality', postal_code=NULL WHERE email='$email'";
}



															


if($conn->query($sql) === TRUE) {
   
          header ("Location:afterLogin.html");
die();
 }

else {

      header ("Location:afterLogin.html");
      die();

 }

$conn->close();

?>
  








 

