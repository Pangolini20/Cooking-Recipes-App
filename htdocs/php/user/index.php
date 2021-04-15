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
session_start();
$id=$_SESSION['id'];
$search="select * from account_credentials where id='$id'";

$result=mysqli_query($con,$search);

if($result)
{	$row=mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>
		$(function () {
		$('#header').load('/php/user/header.php')

		})
	</script>
	<link rel="stylesheet" type="text/css" href="../../css/admin_user_edit.css">
</head>
<body>
	<div id="header"></div>	
	<div id="content">
		<h1>Account settings</h1>
		<form method="post">
			<input id="textbox" type="text" name="username" placeholder="new username" value=<?php echo $row['username'];?>><br>
			<input id="textbox" type="email" name="email" placeholder="new email" value=<?php echo $row['email'];?>> <br>
			<input id="textbox" type="password" placeholder="current password" name="password"><br>
			<input id="buton" type="submit" name="submit_button">
		</form>
<?php

function create_user_update_querry($table_name,$new_user,$actual_user){

	return "update " . $table_name . ' set ' . "username='$new_user' where username='$actual_user'";
}
?>

<?php
	 if(isset($_POST['submit_button']))
	 {
	 	if(empty($_POST['email']) || empty($_POST['username']))
	 		echo "username and email can't be empty";
	 	else
	 	if(empty($_POST['password']))
	 	{
	 		echo "Password needed to change username or email";
	 	}
	 	else{
	 		if($_POST['password'] == $row['password'])
	 		{	
	 			
	 			$new_mail=$_POST['email'];
	 			$new_user=$_POST['username'];
	 			$actual_user=$_SESSION['username'];

		 		if($new_mail != $row['email'])
		 		{
		 			$check="select * from account_credentials where email='$new_mail'";
		 			$r=mysqli_query($con,$check);
		 			$x=mysqli_num_rows($r);
		 			if($x>0)
		 			{
			 			echo "Error email already exists";
			 		}
			 		else
			 		{
			 			$query_mail="update account_credentials set email='$new_mail' where id='$id'";
			 			
			 			$r=mysqli_query($con,$query_mail);
			 			if(empty($r))
			 				{echo "Error couldnt change email";}
			 			

			 		}
			 	}

		 		/*-----------------------------------------*/

		 		if($new_user != $actual_user)
		 		{
		 			$check="select * from account_credentials where username='$new_user'";
		 			$r=mysqli_query($con,$check);
		 			$x=mysqli_num_rows($r);
		 			if($x !=0)
		 			{
			 			echo $x . "Error username already exists" . $new_user;
			 		}
			 		else
			 		{	
			 			
			 			$query=create_user_update_querry("account_credentials",$new_user,$actual_user);
			 			$r=mysqli_query($con,$query);

			 			$r=$query=create_user_update_querry("tickets",$new_user,$actual_user);
			 			mysqli_query($con,$query);

			 			$query=create_user_update_querry("recipes",$new_user,$actual_user);
			 			$r=mysqli_query($con,$query);

			 			$query="update tickets set replied_by='$new_user' where replied_by='$actual_user'";
			 			$r=mysqli_query($con,$query);

			 			$_SESSION['username']=$new_user;

						header('Location: index.php');	 			
			 		}
		 		}
		 		else
		 			header('Location: index.php');



	 		}	
	 		else
	 		{
	 			echo "Incorrect password";
	 		}
	 	}
	 }
?>

		<h2>Change password </h2>
		<form method="post">
			<input id="textbox" type="password" name="current_pass" placeholder="current password"><br>
			<input id="textbox" type="password" name="new_pass" placeholder="new password"><br>
			<input id="textbox" type="password" name="re_pass" placeholder="retype new password"><br>
			<input id="buton" type="submit" name="submit_pass">
		</form>

<?php
	if(isset($_POST['submit_pass']))
	{
		if($_POST['current_pass'] == $row['password'])
		{
			if (empty($_POST['new_pass']) || empty($_POST['re_pass']) || 
				$_POST['re_pass'] !=$_POST['new_pass']	) 
			{
				echo "Passwords do not match";
			}
			else
			{

				$new=$_POST['new_pass'];

				$sql="update account_credentials set password='$new' where id='$id'";
				$result=mysqli_query($con,$sql);
				if($result)
					echo "Password changed succesfully";
				else
					echo "Error couldn't change Password";
			}
		}
		else
		{
			echo "Incorrect password";
		}
			
		
	} 
		
		
?>
	</div>
</body>
</html>

