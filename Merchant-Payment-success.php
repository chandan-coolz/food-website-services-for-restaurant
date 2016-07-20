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



$sql= "UPDATE payment_table SET payment_complete_date=CURRENT_TIMESTAMP, status='Y'  WHERE merchant_email='$email'";



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
$mail->Subject = "payment success of ".$email;
$mail->Body= "Hi Cool, \n\n\n\n The customer with email ".$email." has successfully paid.\n\n\n website4fooddelivery.in team" ;


$mail->AddAddress("chandankumarsingh789@gmail.com");

$mail->Send();


echo"success";


    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

session_destroy();

$conn->close();
}else{
      echo"notlogged";
}

?> 

