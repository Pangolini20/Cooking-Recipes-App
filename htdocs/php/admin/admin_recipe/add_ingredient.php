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
		<link rel="stylesheet" type="text/css" href="../../user/user_css/content_display_pages.css">
</head>
<body>
<div id="header"></div>
<div id="content_table">
	<h1 style="margin-left: 11px;">Add main ingredient</h1>
	<button style="margin-top: 5px" onclick="window.location.href='display_recipe.php'">Back</button>
	<form method="post" style="margin-top:10px;">
		<input id="txtbox" type="text" name="name"  placeholder="Ingredient name..."><br>
		
		<input id="send" type="submit" name="buton"><br>
	<?php  
		if(isset($_POST['buton']))
		{
			if(empty($_POST['name']) )
				echo "Please complete all fields";
			
			$name=$_POST['name'];
			$value=strtolower($name);

			$sql="select * from ingredients where ingredient_name='$name' or value='$value'";
			$result=mysqli_query($con,$sql);
			if(mysqli_num_rows($result) > 0)
				echo "Name already existing in database";
			else{
			$query="insert into ingredients (ingredient_name,value) values ('$name','$value')";

			if(mysqli_query($con,$query))
				echo "New ingredient inserted succesfully";}
		}
	?>
	</form>
</div>
</body>
</html>
<style type="text/css">
#txtbox{
    border: 1px solid black;
    background: white;
    font-size: 20;
    width: 20%;
    padding: 10px;
    margin-bottom: 16px;
    border-radius: 5px;
}

#send{
	width: 16%;
    background: #1C6EA4;
    border: 1px solid black;
    padding: 10px;
    font-size: 15px;
    color: white;
    border-radius: 4px;
    
}

}</style>