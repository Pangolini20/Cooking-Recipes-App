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
    <title>Support</title>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    $(function () {
        $('#header').load('header.php')
    })
</script>
<link rel="stylesheet" type="text/css" href="user_css/view_ticket.css">
</head>
<body>
<div id="header"></div>
<div id="page_cnt">
<button id="back" onclick="window.location.href='support.php'">Back</button>
<br>
<?php
	$id=$_REQUEST['id'];

	$querry="select * from tickets where id = '$id'";
	$result = mysqli_query($con,$querry);

	if($result)
	{
		$row=mysqli_fetch_array($result);
		?>
		<h1><?php echo $row['ticket_title']?></h1>
		<label >Subject: <?php echo $row['subject'];?></label>
		<br>
		<p ><?php echo $row['content']?></p>
		<label id="written">Written by <?php echo $row['username'];  ?></label>
		<br>

		<?php
			if(empty($row['replied_by']))
			{
				echo "An admin will reply soon";
			}
			else
			{
		?>
			<p><?php echo $row['reply']?></p>
			<label id="written">Written by <?php echo $row['replied_by'];  ?></label>
		<?php
			}
		?>
		<?php
	}
?>
</div>
</body>
</html>