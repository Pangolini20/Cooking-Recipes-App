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
<link rel="stylesheet" type="text/css" href="../user/user_css/view_ticket.css">
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
			session_start();
			if(empty($row['replied_by']) && $_SESSION['status']=="User")
			{
				echo "An admin will reply soon";
			}
			elseif (empty($row['replied_by']) && $_SESSION['status']=="Admin") {
		?>
			<form method="post">
				<textarea placeholder="Write your reply..." type="text" name="reply_text"></textarea>
				<button style="margin-left: 682px;" id="back" name="reply" type="submit">Reply & Close</button>
			</form>
				<?php
				if(isset($_POST['reply']))
				{	
					if(empty($_POST['reply_text']))
						echo "The reply must be written!";
					else
					{
						$username=$_SESSION['username'];
						$reply=$_POST['reply_text'];
						$querry= "update tickets set reply='$reply', replied_by='$username',ticket_status='closed' where id='$id'";

						mysqli_query($con,$querry);
						header("Location: support.php");
					}
				}
				?>
		<?php
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
