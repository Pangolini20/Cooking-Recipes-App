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

	$username=$_REQUEST['username'];

	$sql = "delete from account_credentials where username='$username' ";
	$result = mysqli_query($con,$sql) or die ( mysqli_error());

	$sql = "delete from tickets where username='$username' ";
	$result = mysqli_query($con,$sql) or die ( mysqli_error());

	$sql = "delete from recipes where username='$username' ";
	$result = mysqli_query($con,$sql) or die ( mysqli_error());



	header("Location:index.php");
	
	exit();

?>