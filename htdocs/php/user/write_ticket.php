<!DOCTYPE html>
<html >
<head>
    <title>Support</title>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    $(function () {
        $('#header').load('header.php')
    })
</script>
<link rel="stylesheet" type="text/css" href="user_css/write_ticket.css">
</head>
<body>
<div id="header"></div>
<div id="content">
	
	<form id="formular" action="" method="POST">
		<button type="button" id="cancel" onclick="window.location.href='support.php'">Back</button>
		<h1>How can we help you?</h1>
		<input id="title" type="text" name="title" placeholder="Title">
		<br>
		<select name="subject">
			<option value="none">Select subject</option>
			<option value="bug">Report a bug</option>
			<option value="question">I have a Question</option>
			<option value="other">Other</option>
		</select>
		<br>
		<textarea id="txtbox" rows="10" cols="50" style="resize: none " placeholder="Please describe what happened..." name="content" maxlength="500"></textarea>
		<br>
		<input id="button" type="submit" name="button"></input>
	</form>
</div>
<form>
</form>
</body>

<?php
	if(isset($_POST['button']))
	{
		$title=$_POST['title'];
		$content=$_POST['content'];
		$subject=$_POST['subject'];

		if($subject=="none" || empty($content) || empty($title))
			echo "Please complete all fields";
		else
			include 'subticket.php';

	}
?>

</html>