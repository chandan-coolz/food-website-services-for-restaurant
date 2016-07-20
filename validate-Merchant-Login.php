
<?php
session_start();

include "DB_Details.php";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// get the q parameter from URL
$emailGet=$_REQUEST["email"];
$passwordGet=$_REQUEST["password"];

$email=stripslashes($emailGet);
$password=stripslashes($passwordGet);


$sql2 ="select * from payment_table p inner join domain_table d on p.merchant_email=d.merchant_email where p.status='Y' and d.domain_status='NR'"; 
$result2 = $conn->query($sql2);

$sql1 = "SELECT * FROM payment_table where merchant_email='$email' and status='Y'";
$result1 = $conn->query($sql1);


$sql = "SELECT * FROM merchant_table where merchant_email='$email' and merchant_password='$password'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
      if ($result1->num_rows > 0) {
      
      $_SESSION["email"]=$email;
      $_SESSION['firstVisit']=true;
              if($result2->num_rows> 0 ){
                      echo "notregister";
                  }else{    
                         echo "paid";
                   }
         }else{
   
      $_SESSION["email"]=$email;
      
      echo "unpaid";
               }



    
} else {
    echo "Invalid username and password combination";
    
     }
$conn->close();








// Output "no suggestion" if no hint was found or output correct values

?> 
