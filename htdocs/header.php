<?php
	include 'languages/config.php';
	
?>


<html>
<link>
<title>Home</title>
<link rel="stylesheet" href="\css\main.css">
</head>
<body>
<div class="header">
	
		
	<div id="language">
   		<a href="index.php?lang=en">EN</a> |
		<a href="index.php?lang=ro">RO</a></div>
   	<ul class="menu">
   		
        <a href="index.php"><?php echo $lang['home'] ?></a>
        <a href="recipes.php"><?php echo $lang['recipe'] ?></a>
        <a href="about.html"><?php echo $lang['about'] ?></a>
        <a href="login.php" id="change"><?php echo $lang['sign-in'] ?></a>
   	</ul>
</div>
</body>
</html>