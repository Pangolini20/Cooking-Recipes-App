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
		$('#header').load('/php/admin/header.php')

		})
	</script>
	<link rel="stylesheet" type="text/css" href="../user/user_css/table.css">
	<link rel="stylesheet" type="text/css" href="../user/user_css/support.css">
</head>
<body>

<div id="header"></div>
<div id="background">
<div id="content_table">
<h1>Support -closed tickets</h1>
<button onclick="window.location.href='support.php'">View pending tickets</button>
<form method="post">
	<input type="text" name="usersearch" placeholder="Search user..."> 
	<input type="submit" name="search_user">
</form>
<br>
<table class="content">
	<thead>
		<th>User</th>
		<th>Title</th>
		<th>Subject</th>	
		<th>Actions</th>
	</thead>
	<tbody>
<?php  
	
	$sql="";
	if(isset($_POST['search_user']) && !(empty($_POST['usersearch'])))
	{
		$username=$_POST['usersearch'];
		$sql = "select * from tickets where ticket_status='closed' and username='$username' order by id DESC";}
	else
		$sql = "select * from tickets where ticket_status='closed' order by id DESC";

	$result = mysqli_query($con,$sql);

	if ($result)
	{
		while ($row=mysqli_fetch_array($result)) 
		{
			
?>
		<tr>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['ticket_title']; ?></td>
			<td><?php echo $row['subject']; ?></td>
			
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