<?php
	
	
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "accounts"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

 $target_dir = "recipecode/upload/";
 $target_file = $target_dir . basename($_FILES["file"]["name"]);

 // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 	session_start();
	$username=$_SESSION['username'];
	$title=$_POST['title'];
	$ingredient=$_POST['ingredient'];
	$meal=$_POST['meal'];
	$description=$_POST['description'];

    // Convert to base64 
    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    // Insert record
    $query = "INSERT into recipes (username,picture,ingredient,meal,description,title) 
	values('$username','".$image."','$ingredient','$meal','$description','$title')";
  

    mysqli_query($con,$query);
  
    // Upload file
    header('Location: myitems.php');
  }
 

	
?>