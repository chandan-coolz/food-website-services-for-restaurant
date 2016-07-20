<?php
session_start();

header('Content-Type: text/plain; charset=utf-8');
include "DB_Details.php";

if(isset($_SESSION['email'])) {

$_SESSION['firstVisit']=true;


try {
$target_dir = "website uploads/";
$target_file = $target_dir . basename($_FILES['upfile']['name']); 
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.Max file size limit is 1MB');
        default:
            throw new RuntimeException('Unknown errors.Please check your internet connectivity');
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 10000000) {
        throw new RuntimeException('Exceeded filesize limit.Max file size limit is 1MB');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upfile']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException("Invalid image file format.Please upload valid 'jpg','jpeg', 'png', 'gif' image file ");
    }

//check the dimenson of the image

$image_info = getimagesize($_FILES["upfile"]["tmp_name"]);
$image_width = $image_info[0];
$image_height = $image_info[1];

if($image_width< 690 && $image_height < 455)
{
  throw new RuntimeException("Image dimension error.Width must be greater than 690px and height must be greater than 455px");
}


    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['upfile']['tmp_name'],
        $target_file
        )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

  //  echo 'File is uploaded successfully.';



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$email=$_SESSION['email'];

$sql2 = "DELETE FROM website_upload_table  WHERE merchant_email='$email'";
$conn->query($sql2);



$sql = "INSERT INTO website_upload_table(merchant_email,src,date)
VALUES ('$email','$target_file',CURRENT_TIMESTAMP)";


if ($conn->query($sql) === TRUE) {
echo $target_file;

}

else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}















} catch (RuntimeException $e) {

    echo $e->getMessage();

}//catch
}else{
      echo"notlogged";
}

?>
