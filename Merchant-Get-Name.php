<?php
session_start();


include "DB_Details.php";


if(isset($_SESSION['email'])) {



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$email=$_SESSION['email'];



$sql= "SELECT merchant_name FROM merchant_table WHERE merchant_email='$email'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo $row["merchant_name"];
    }
} else {
    echo "Guest";
}




$conn->close();
}else{
      echo"notlogged";
}

?> 

