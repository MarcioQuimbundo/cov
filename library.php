<?php
function item_check($item_name)
{
$con=connection();	
$query="SELECT * FROM items WHERE Name='$item_name'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result))
return true;
else 
return false;
}
function drug_check($item_name)
{
$con=connection();	
$query="SELECT * FROM drugs WHERE Name='$item_name'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result))
return true;
else 
return false;
}
function connection()
{
$server='localhost';
$user='root';
$password='ANGO_covdb157016';
$db_name='cov';	
$con = mysqli_connect($server, $user, $password, $db_name);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to Database: " . mysqli_connect_error();
  }
  return $con;
}
function upload()
{
if(array_key_exists('thefile', $_FILES)) {
// Validate the uploaded file
if($_FILES['thefile']['size'] === 0 
|| empty($_FILES['thefile']['tmp_name'])) {
    echo("<p>No file was selected.</p>\r\n");
} else if($_FILES['thefile']['size'] > 1000000000) {
    echo("<p>The file was too large.</p>\r\n");
} else if($_FILES['thefile']['error'] !== UPLOAD_ERR_OK) {
    // There was a PHP error
    echo("<p>There was an error uploading.</p>\r\n");
} else {

// Create uploads directory if necessary
if(!file_exists('uploads')) mkdir('uploads');

// Move the file
if(move_uploaded_file($_FILES['thefile']['tmp_name'], 
'uploads/'. $_FILES['thefile']['name'])) {
    echo("<p>File uploaded successfully!</p>\r\n");
	return $_FILES['thefile']['name'];
} else {
    echo("<p>There was an error moving the file.</p>\r\n");
}

}

}
}
?>