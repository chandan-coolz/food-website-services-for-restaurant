<?php
session_start();

include "DB_Details.php";
require("class.phpmailer.php");

if(isset($_SESSION['email'])) {






$mail = new PHPMailer();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$email=$_SESSION['email'];

$domain_name=$_REQUEST["domain"];

$sql2 = "DELETE FROM domain_table  WHERE merchant_email='$email'";
$conn->query($sql2);



$sql = "INSERT INTO domain_table(merchant_email,domain_name,date,domain_status)
VALUES ('$email','$domain_name',CURRENT_TIMESTAMP,'W')";






if ($conn->query($sql) === TRUE) {

  $mail->SMTPAuth = true;         
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;    

         // enable SMTP authentication
$mail->Username = "admin@website4fooddelivery.in";
$mail->Password = "Cool@admin54";   


$mail->From = "admin@website4fooddelivery.in";
$mail->FromName = "website4fooddelivery.in";
$mail->Subject = "Domain information of ".$email;
$mail->Body= "Hi Cool, \n\n\n\n The customer with email ".$email." has register for ".$domain_name." \n\n\n website4fooddelivery.in team" ;


$mail->AddAddress("chandankumarsingh789@gmail.com");

$mail->Send();


echo"success";


    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

  
}else{
      echo"notlogged";
}
?> 

