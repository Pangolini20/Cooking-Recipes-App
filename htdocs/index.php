<?php
error_reporting(0);

include 'languages/config.php';

if($_SESSION['status']=="Admin") {
    header("Location: /php/admin/index.php");
}

elseif ($_SESSION['status']=="User") {
    header("Location: /php/user/index.php");
}
?>

<html>

<title>Home</title>
<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
	$(function () {
		$('#header').load('header.php')
    })
</script>
	<link rel="stylesheet" href="/css/slides.css"></link>
	<link rel="stylesheet" type="text/css" href="/css/homepage.css">
</head>
<body>
<div id="header"></div>
<div id="parent_div">
	<div id="left_panel">
	<center>
		<p>Want to learn step by step how to cook such delicious dishes?</p>
		<button onclick="window.location.href='register.html'">Register</button>
	</center>
	</div>	
	<div style="width:400px; height: 600px; float: left;"></div>
	<div class="slide">
	</div>
</div>



</body>



</html>