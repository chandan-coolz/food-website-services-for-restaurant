<?php

include "DB_Details.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// get the q parameter from URL
$email=$_REQUEST["email"];


$sql = "SELECT * FROM merchant_table where merchant_email='$email'";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo "unsuccess";
    }
} else {
    echo "success";
}


$conn->close();








// Output "no suggestion" if no hint was found or output correct values

?> 
