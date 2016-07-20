
<?php


include "DB_Details.php";
require("class.phpmailer.php");
$mail = new PHPMailer();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// get the q parameter from URL
$emailGet=$_REQUEST["email"];


$email=stripslashes($emailGet);


$sql = "SELECT name,password FROM customer_data where email='$email'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
 
$password="";
$name="";
  while($row = $result->fetch_assoc()  )   
     {
       $password=$row["password"];     
       $name=$row["name"];
     }
       


  $mail->SMTPAuth = true;         
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;    

         // enable SMTP authentication
$mail->Username = "admin@website4fooddelivery.in";
$mail->Password = "Cool@admin54";   


$mail->From = "admin@website4fooddelivery.in";
$mail->FromName = "website4fooddelivery.in Food Service Demo";
$mail->Subject = "Password for your account in 'website4fooddelivery.in' Demo page";
$mail->Body= "Hi ".$name.", \n\n\n You requested for password. Your login details are  \n\n email:".$email."\n password:".$password."\n
This is  a demo of email sent to customer, if your customer forget the password of your website.\n\n website4fooddelivery.in team" ;


$mail->AddAddress($email);

$mail->Send();



        
      echo "yes";
                   
} else {
    echo "no";
    
     }
$conn->close();








// Output "no suggestion" if no hint was found or output correct values

?> 
