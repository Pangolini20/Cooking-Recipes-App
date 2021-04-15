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
	<title>Admin</title>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>
		$(function () {
		$('#header').load('/php/admin/header.php')

		})
	</script>
	<link rel="stylesheet" type="text/css" href="/css/user_table.css">
	<link rel="stylesheet" type="text/css" href="/php/user/user_css/table.css">
</head>
<body>
	<div id="header"></div>
	<div id="content">
		<?php
		session_start();
		$admin=$_SESSION['id'];
		?>
		<button id="buton" onclick="window.location.href='edit_own_user.php'">My account</button>
		<h1>User list</h1>
		<table class="content">
		<thead>
			<tr>
				<th>Username</th>
				<th>Email   </th>
				<th>Status  </th>
				<th>Actions </th>
			</tr>
		</thead>
		<?php  
			$query="select * from account_credentials order by status ";

			$result=mysqli_query($con,$query);

			if($result)
			{
				while($row=mysqli_fetch_array($result))
				{ 
		?>
			<tr>
				<td><?php echo $row['username'] ?></td>
				<td><?php echo $row['email']    ?></td>
				<td><?php echo $row['status'];  ?></td>
		<?php
			if($row['status']=="User")
			{
		?>
				<td>
					<a href=<?php echo "edit_user.php?id=" . $row['id'] ?>>Edit</a>
					<a href=<?php echo "promote_user.php?username=" . $row['username'] ?>>Promote</a>
					<a href=<?php echo "delete_user.php?username=" . $row['username'] ?> >Delete</a>
				</td>
		<?php
			}
		?>

			</tr>		

		<?php 
				}
			}

		?>	
		</table>
	</div>
	
</body>
</html>
