<?php
session_start();

include "DB_Details.php";
require("class.phpmailer.php");
$mail = new PHPMailer();

$email=$_SESSION['email'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$data = array();

$sql1 = "select name,order_id,order_items from customer_data c,order_details o where c.email=o.email 
and o.date=(select max(od.date) from order_details od where od.email='$email')";





$result = $conn->query($sql1);

if($result->num_rows>0){


    while($row = $result->fetch_assoc()){
                                           
                                          $data[] = $row['name'];					
                                          $data[] = $row['order_id'];
                                          $data[] = $row['order_items'];


        
                                         } //while
                           


  $mail->SMTPAuth = true;         
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;    

         // enable SMTP authentication
$mail->Username = "admin@website4fooddelivery.in";
$mail->Password = "Cool@admin54";   


$mail->From = "admin@website4fooddelivery.in";
$mail->FromName = "website4fooddelivery.in Food Service Demo";
$mail->Subject = "Your order no. ".$data[1]." from 'Your Resturant Name' ";
$mail->Body= "Hi ".$data[0].", \n\n\n Thankyou for ordering with 'Your resturant name'. \n We have received your order.\n\n Order No.".$data[1]. "\n Order Items :".$data[2]."\n\nPlease allow us a few minutes to serve your order. \n\n\n Thanks, \n 'Your resturant name' \n\nThis is  a demo of email sent to customer, if your customer makes order  from your website\n\n website4fooddelivery.in team" ;";


$mail->AddAddress($email);

$mail->Send();

                        } //if

 else                   {

                        }  //else           





echo json_encode($data);
session_destroy();
$conn->close();
?> 

