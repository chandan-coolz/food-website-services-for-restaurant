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

 $acceptablePasswordChars ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $randomPassword = "";

    for($i = 0; $i < 8; $i++)
    {
        $randomPassword .= substr($acceptablePasswordChars, rand(0, strlen($acceptablePasswordChars) - 1), 1);  
    }
     




$name=$_POST['name'];
$email=$_POST['email'];
$password=$randomPassword;
$mobile=$_POST['mobile'];
$restaurant=$_POST['restaurant'];
$restaurantAddress=$_POST['restaurantAddress'];


$sql = "INSERT INTO merchant_table(merchant_name,merchant_email,merchant_password,merchant_mobile,restaurant_name,restaurant_address,website_status)
VALUES ('$name','$email','$password','$mobile','$restaurant','$restaurantAddress','N')";




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
$mail->Subject = "Login details of website4fooddelivery";
$mail->Body= "Hi ".$name.", \n\n\n\n Thankyou for Registering with website4fooddelivery.in .\n Your account created successfully \n\n email:".$email."\n password:".$password."\n\n You can now login using your creditionial and complete your futher steps.\n\n\n website4fooddelivery.in team" ;


$mail->AddAddress($email);

$mail->Send();





    header ("Location:Merchant-sinup-success.html");
die();

    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}








$conn->close();
?> 

