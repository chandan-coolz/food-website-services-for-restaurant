<?php
session_start();

include "DB_Details.php";

if(isset($_SESSION['email'])) {

$_SESSION['firstVisit']=true;



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$email=$_SESSION['email'];

$sql2 = "DELETE FROM website_logo_table  WHERE merchant_email='$email'";
$conn->query($sql2);



$sql = "INSERT INTO website_logo_table(merchant_email,src,date)
VALUES ('$email','Website4fooddelivery logo',CURRENT_TIMESTAMP)";


if ($conn->query($sql) === TRUE) {

header ("Location:website-menu-upload.html");
die();

}

else {
    
   header ("Location:error.html");
}





}else{
      header ("Location:Merchant-login.html");
die();
}

?>
