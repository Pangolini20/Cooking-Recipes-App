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

<html>
<head>
	<title></title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>
		$(function () {
		$('#header').load('/php/user/header.php')

		})
	</script>
	<link rel="stylesheet" type="text/css" href="user_css/table.css">
	<link rel="stylesheet" type="text/css" href="user_css/support.css">
</head>
<body>

<div id="header"></div>
<div id="background">
<div id="content_table">
<h1>Support</h1>
<button onclick="window.location.href='write_ticket.php'">Write Ticket</button>
<br>
<table class="content">
	<thead>
		<th>Title</th>
		<th>Subject</th>
		<th>Status</th>
		<th>Actions</th>
	</thead>
	<tbody>
<?php  
	session_start();
	$username=$_SESSION['username'];

	$sql = "select * from tickets where username='$username' order by ticket_status , id DESC";

	$result = mysqli_query($con,$sql);

	if ($result)
	{
		while ($row=mysqli_fetch_array($result)) 
		{
			
?>
		<tr>
			<td><?php echo $row['ticket_title']; ?></td>
			<td><?php echo $row['subject']; ?></td>
			<td><?php echo $row['ticket_status']; ?></td>
			<td><a href=<?php echo "ticket_read.php?id=" . $row['ID']; ?> </a> View </td>	
		</tr>

	
	</tbody>
<?php
		}
	}
?>
</div>
</div>
</table>

</body>
</html>