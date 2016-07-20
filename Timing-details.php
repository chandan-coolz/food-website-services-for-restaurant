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
$openTimeH=$_POST['openTimeH'];
$openTimeM=$_POST['openTimeM'];
$openTimeS=$_POST['openTimeS'];

$closeTimeH=$_POST['closeTimeH'];
$closeTimeM=$_POST['closeTimeM'];
$closeTimeS=$_POST['closeTimeS'];

$holiday=$_POST['weekHoliday'];

$openTime=$openTimeH."-".$openTimeM."-".$openTimeS;
$closeTime=$closeTimeH."-".$closeTimeM."-".$closeTimeS;







$sql2 = "DELETE FROM restaurat_timing  WHERE merchant_email='$email'";
$conn->query($sql2);



$sql = "INSERT INTO restaurat_timing(merchant_email,open_time,close_time,holiday)
VALUES ('$email','$openTime','$closeTime','$holiday')";






if ($conn->query($sql) === TRUE) {

header ("Location:website-picture-upload.html");
die();
    
} else {
 
       header ("Location:error.html");
       die();  
}

$conn->close();

  
}else{
            header ("Location:Merchant-login.html");
            die();
}
?> 

