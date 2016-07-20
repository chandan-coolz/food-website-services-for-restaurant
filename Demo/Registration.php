<?php
session_start();


include "DB_Details.php";
require("class.phpmailer.php");
$mail = new PHPMailer();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$company=$_POST['company'];
$flat=$_POST['flat'];
$locality=$_POST['locality'];
$mobile=$_POST['mobile'];
$postalcode=$_POST['postalcode'];

$amount=$_POST['amount'];
$order_items=$_POST['order_items'];


if(!$postalcode==NULL)

{
$sql = "INSERT INTO customer_data(name,email,password,mobile,company,flat,locality,postal_code)
VALUES ('$name','$email','$password','$mobile','$company','$flat','$locality',$postalcode)";

}

else
{

$sql = "INSERT INTO customer_data(name,email,password,mobile,company,flat,locality,postal_code)
VALUES ('$name','$email','$password','$mobile','$company','$flat','$locality',NULL)";

}






if ($conn->query($sql) === TRUE) {



  $mail->SMTPAuth = true;         
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;    

         // enable SMTP authentication
$mail->Username = "admin@website4fooddelivery.in";
$mail->Password = "Cool@admin54";   


$mail->From = "admin@website4fooddelivery.in";
$mail->FromName = "website4fooddelivery.in Food Service Demo";
$mail->Subject = "Demo page Login details of website4fooddelivery.in";
$mail->Body= "Hi ".$name.", \n\n\n\n Thankyou for Registering with yourwebsite.com .\n Your account created successfully \n\n email:".$email."\n password:".$password."\n\n You can now login using your creditionial and complete your futher steps.\nThis is  a demo of email sent to customer, if your customer signup to your website\n\n website4fooddelivery.in team" ;


$mail->AddAddress($email);

$mail->Send();





} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header ("Location:error.html");
}

//for order table
$sql2="INSERT INTO order_details (email,order_items,amount,date,status,remark) VALUES ('$email', '$order_items',$amount, CURRENT_TIMESTAMP,'N',NULL)";


if ($conn->query($sql2) === TRUE) {

$_SESSION["email"]=$email;
  
header ("Location:success.html");
die();

} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  header ("Location:error.html");
}














$conn->close();
?> 

