<?php
session_start();
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="3RIGYwpO";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);

            
?>	


 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Food Ordering</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <script src="JavaScript/jquery.js"> </script>
  <script src=" bootstrap/js/bootstrap.min.js"></script>


</head>
<body>

<div class="container-fluid">
  <div class="row">
       <div class="col-md-12 col-xs-12 col-sm-12 col-lg=12">
        
           <nav class="navbar navbar-inverse navbar-fixed-top">
  
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                  </button>
               <a class="navbar-brand" href="#"><span class="bg-primary" style="font-weight:bold">Website4FoodDelivery.in</span></a>               
               
               </div>
              <div class="collapse navbar-collapse" id="myNavbar" >
               <div class="nav pull-right">
                  <ul class="nav navbar-nav">
                   	

                     <li class="active"><a  style="font-weight:bold"> Payment Status</a></li>

                  </ul>
                </div>
              </div>
             </div>
            </nav>
      
       </div><!col end here>

  </div><!row for logo end here>

<div class="row">
      <div class="col-md-2 col-lg=2 hidden-xs hidden-sm">

      </div>
<!********************************************************sinup form start******************************************************************>
<div class="col-md-8 col-xs-12 col-sm-12 col-lg=8" style="margin-top:70px">
 <h1 class="text-info" style="margin-left:50px">PAYMENT STATUS</h1>
<br><br> 
 
<?php

if ($hash != $posted_hash) {
	       echo "<p  style='font-size:20px;color:red;margin-left:50px'>Invalid Transaction. Please try again</p>";
               echo "<br/><br/>";
               echo"<p style='font-size:20px;margin-left:50px'><a href='Merchant-Payment-confirmation.php'> CLICK HERE TO TRY AGAIN</a></p>";
		   }
else {

//to update tablle and send mail to admin
include "DB_Details.php";
require("class.phpmailer.php");


$mail = new PHPMailer();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$email=$_SESSION['email'];



$sql= "UPDATE payment_table SET payment_complete_date=CURRENT_TIMESTAMP, status='Y', transaction_id='$txnid'  WHERE merchant_email='$email'";



if ($conn->query($sql) === TRUE) {


  $mail->SMTPAuth = true;         
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;    

         // enable SMTP authentication
$mail->Username = "forkec@gmail.com";
$mail->Password = "cool95208595";   


$mail->From = "forkec@gmail.com";
$mail->FromName = "website4fooddelivery.com";
$mail->Subject = "payment of ".$email;
$mail->Body= "Hi Cool, \n\n\n\n The customer with email ".$email." and Transaction id ".$txnid." has successfully paid.\n\n\n website4fooddelivery.com team" ;


$mail->AddAddress("chandankumarsingh789@gmail.com");

$mail->Send();


//echo"success";


    
} else {
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

session_destroy();

$conn->close();


          echo "<p class='text-success' style='font-size:20px;margin-left:50px'><i class='glyphicon glyphicon-ok-sign'></i>Thankyou, we successfully received the payment made by you.</p>"; 
                     echo "<p class='text-success' style='font-size:20px;margin-left:50px'>Your order status is ". $status .".</p>";
          echo "<p class='text-success' style='font-size:20px;margin-left:50px'>Your Transaction ID for this transaction is ".$txnid.".</p>";
          echo "<p class='text-success' style='font-size:20px;margin-left:50px'>We have received a payment of Rs " . $amount . ". You will get  email notification once your wesite is ready.</p>";

echo"<br/><br/>";
echo"<p style='font-size:20px;margin-left:50px'><a href='Merchant-login.html'> CLICK HERE TO LOGIN</a></p>";

 } // end of main else         
?>

</div>
<!********************************************************sinup form End******************************************************************>
       <div class="col-md-2 col-lg=2 hidden-xs hidden-sm">

      </div>

</div><!end of row for form>





</div><!fluid content end here>

</body>
</html>
