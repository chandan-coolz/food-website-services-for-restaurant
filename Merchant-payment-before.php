<?php
session_start();
require("class.phpmailer.php");

include "DB_Details.php";




$email=$_SESSION['email'];


$mail = new PHPMailer();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


 $sql = "DELETE FROM payment_table  WHERE merchant_email='$email'";
 $conn->query($sql);
 $sql1 = "INSERT INTO payment_table(merchant_email,transaction_id,amount,payment_initiation_date,payment_complete_date,status) VALUES ('$email',NULL,2000,CURRENT_TIMESTAMP,'0000-00-00 00:00:00','N')";
 $conn->query($sql1);  
      
// send email to admin that payment is initiated by user

  $mail->SMTPAuth = true;         
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;    

         // enable SMTP authentication
$mail->Username = "admin@website4fooddelivery.in";
$mail->Password = "Cool@admin54";   


$mail->From = "admin@website4fooddelivery.in";
$mail->FromName = "website4fooddelivery.in";
$mail->Subject = "payment initiated by ".$email;
$mail->Body= "Hi Cool, \n\n\n\n The customer with email ".$email." has initiated the payment process.\n\n\n website4fooddelivery.in team" ;


$mail->AddAddress("chandankumarsingh789@gmail.com");

$mail->Send();










                                    
 $conn->close();


?> 

