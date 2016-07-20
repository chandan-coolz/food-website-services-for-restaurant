<?php
include 'DB_Details.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$userName=$_POST["userName"];
$confirmFLG=$_POST["confirmFLG"];
$networkName=$_POST["networkName"];


	//first pick newtwork id
	$sql = "select network_id from network_details where network_name='$networkName'";
	$result= $conn->query($sql);
	
	$sql2 = "select user_id from login_details where user_name='$userName'";
    $result2=$conn->query($sql2);
	if ($result->num_rows > 0 && $result2->num_rows > 0 ){
	
	while($row = $result->fetch_assoc()) {
        $networkID=$row["network_id"];
		
    }//while
		while($row2 = $result2->fetch_assoc()) {
        $userID=$row2["user_id"];
		
    }//while
	
	
	if($confirmFLG=="Y"){
		//update the record
	   $sql3="UPDATE user_network_detail SET join_flag='Y' WHERE network_id='$networkID' and user_id='$userID'";
	
	                                          if ($conn->query($sql3) === TRUE) {
                                                 echo "success";
                                               } else {
                                                 echo "fail" . $conn->error;
                                               }

	}else {
		
		//delete the record
		       $sql4 = "DELETE FROM user_network_detail WHERE network_id='$networkID' and user_id='$userID'";

               if ($conn->query($sql4) === TRUE) {
                   echo "success";
                } else {
                  echo "fail" . $conn->error;
                } 
		
	}//confirm flag else
	
	
	
    }else{
		
		  echo "fail" . $conn->error;
		
	}	//first query else
	

	
	
	








$conn->close();

?>

