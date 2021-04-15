<?php
	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>
		$(function () {
		$('#header').load('/php/admin/admin_recipe/header.php')

		})
	</script>

	<link rel="stylesheet" type="text/css" href="../../user/user_css/recipe_page.css">
</head>
<body>
<div id="header"></div>
<div id="recipecontent">

	<?php
		$host = "localhost"; /* Host name */
		$user = "root"; /* User */
		$password = ""; /* Password */
		$dbname = "accounts"; /* Database name */

		$con = mysqli_connect($host, $user, $password,$dbname);
		// Check connection
		if (!$con) {
		  die("Connection failed: " . mysqli_connect_error());}

		$id=$_REQUEST['id'];
		$sql="select * from recipes where id=$id";

		$result = mysqli_query($con,$sql);

		$row=mysqli_fetch_array($result);
		$x=$row['picture'];
	?>	
		
		<img id="imag" src=<?php echo $x ?>>
		<center><h1><?php echo $row['title'] ?></h1></center>
		<label>Main ingredient:<?php echo $row['ingredient'] ?></label>
		<br>
		<label>Meal type:<?php echo $row['meal'] ?></label>
		<br>
		<b>Description</b>
		<div style="margin-left: 20px;"><?php echo $row['description'];?></div>
	
	
</div>
</body>


</html>