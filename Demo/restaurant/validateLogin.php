
<?php


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



$sql = "SELECT * FROM admin where email='$email' and password='$password'";







$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
 
  
      echo "success";




    }//while
} //if

else {
    echo "Invalid username and password combination";
    
     }
$conn->close();








// Output "no suggestion" if no hint was found or output correct values

?> 
