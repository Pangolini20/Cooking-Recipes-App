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

$sql= "update account_credentials set status='Admin' where username='$username'";

$result = mysqli_query($con,$sql) or die ( mysqli_error());
header("Location:index.php");
?>