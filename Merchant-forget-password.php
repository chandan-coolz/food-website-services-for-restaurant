
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


$sql = "SELECT merchant_name,merchant_password FROM merchant_table where merchant_email='$email'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
 
$password="";
$name="";
  while($row = $result->fetch_assoc()  )   
     {
       $password=$row["merchant_password"];     
       $name=$row["merchant_name"];
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
$mail->Subject = "Password for your account in website4fooddelivery.in";
$mail->Body= "Hi ".$name.", \n\n\n You requested for password. Your login details are  \n\n email:".$email."\n password:".$password."\n\n\n website4fooddelivery.in team" ;


$mail->AddAddress($email);

$mail->Send();



        
      echo "A password has been sent to your respective email address.If you not found in your inbox, then check your span folder ";
                   
} else {
    echo "Email id does not exist";
    
     }
$conn->close();








// Output "no suggestion" if no hint was found or output correct values

?> 
