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

$id=$_REQUEST['id'];
$query = "DELETE FROM recipes WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());

if($_SERVER['HTTP_REFERER'] == "http://localhost/php/admin/admin_recipe/myitems.php")
	header("Location: myitems.php "); 
else
	header("Location: display_recipe.php ");
?>