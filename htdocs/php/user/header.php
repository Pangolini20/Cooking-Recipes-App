<?php include '../../languages/config.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="\css\main.css">
	
	<title></title>
</head>
<body>
	<div class="header">
    <div id="language">
    <a href="display_recipe.php?lang=en">EN</a> |
    <a href="display_recipe.php?lang=ro">RO</a>
  </div>
    <label id="welcome"
    ><?php 
        
        echo $lang['welcome'] ." ".$_SESSION['username']; ?></label> 
   	<ul class="menu">		
        <a href="./index.php"><?php echo $lang['home'] ?></a>
        <a href="./display_recipe.php"><?php echo $lang['recipe'] ?></a>
        <a href="./support.php">Support</a>
        <a href="./logout.php" ><?php echo $lang['log-out'] ?></a>
    </ul>
</div>


<style>
#welcome{

  padding: 0 10px;
  line-height: 100px;
  color:black;
}

  </style>
</body>
</html>

