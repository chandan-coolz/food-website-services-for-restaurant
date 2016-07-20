
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
$oldpasswordGet=$_REQUEST["oldpassword"];
$newpasswordGet=$_REQUEST["newpassword"];

$oldpassword=stripslashes($oldpasswordGet);
$newpassword=stripslashes($newpasswordGet);
$email=$_SESSION['email'];


$sql = "SELECT * FROM merchant_table where merchant_email='$email' and merchant_password='$oldpassword'";
$result = $conn->query($sql);

$sql2 = "UPDATE merchant_table SET merchant_password='$newpassword' where merchant_email='$email' ";




if ($result->num_rows > 0) {
    
       if ($conn->query($sql2) === TRUE) {
          echo "success";
        }else {
    echo "Error updating record: " . $conn->error;
        }

        
 
    
} else {
    echo "Old password is incorrect";
    
     }
$conn->close();








// Output "no suggestion" if no hint was found or output correct values

?> 
