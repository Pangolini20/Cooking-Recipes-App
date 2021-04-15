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
$search="select * from account_credentials where id='$id'";

$result=mysqli_query($con,$search);

if($result)
{	$row=mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>
		$(function () {
		$('#header').load('/php/admin/header.php')

		})
	</script>
	<link rel="stylesheet" type="text/css" href="../../css/admin_user_edit.css">
</head>
<body>

<div id="header"></div>
<div id="background">
<div id="content">
<button id="buton" onclick="window.location.href='index.php'">Back</button>
<h1>Edit user</h1>
<form method="post">
	<input id="textbox" type="text" name="username" placeholder="new username" value=<?php echo $row['username'];?>><br>
	<input id="textbox" type="email" name="email" placeholder="new email" value=<?php echo $row['email'];?>> <br>
	<input id="textbox" type="password" placeholder="new password" name="new_password"><br>
	<input id="buton" type="submit" name="submit_button" value="Edit">
</form>
<?php
	}
	else 
		echo "Error";

	if(isset($_POST['submit_button']))
	{
		$newuser=$_POST['username'];
		$new_password=$_POST['new_password'];
		$email=$_POST['email'];
		
		if(empty($email) || empty($newuser))
		{	echo "username or email cannot be empty";
			die();}

		if($email != $row['email'])
		{
			$query="select * from account_credentials where email='$email'";
			$r=mysqli_query($con,$query);
			$x=mysqli_num_rows($r);
			if($x > 0){
				echo "Email already exists in the database";
				die();
			}
			else
			{
				$q="update account_credentials set email='$email' where id=$id";
				mysqli_query($con,$q);
			}

		}

		if($newuser != $row['username'])
		{
			$query="select * from account_credentials where username='$newuser'";
			$r=mysqli_query($con,$query);
			$x=mysqli_num_rows($r);
			if($x > 0){
				echo "Username already exists in the database";
				die();
			}

			$q="update account_credentials set username='$newuser' where id=$id";
			mysqli_query($con,$q);

			$old_user=$row['username'];

			$q="update recipes set username='$newuser' where username='$old_user'";
			mysqli_query($con,$q);

			$q="update tickets set username='$newuser' where username='$old_user'";
			mysqli_query($con,$q);

			$q="update tickets set replied_by='$newuser' where replied_by='$old_user'";
			mysqli_query($con,$q);


		}

		$string = 'Location: ' . 'edit_user.php?id=' . $row['id'];

		if(!empty($new_password))
		{
			$q="update account_credentials set password='$new_password' where id='$id'";
			mysqli_query($con,$q);
			header($string);
			
		}

		header($string);





		
	}

?>
</div>
</div>
</body>
</html>
