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
	<title>My recipes</title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script>
		$(function () {
		$('#header').load('/php/user/header.php')

		})
	</script>
	<link rel="stylesheet" type="text/css" href="user_css/table.css">
	<link rel="stylesheet" type="text/css" href="user_css/content_display_pages.css">
	
</head>
<body>
	<div id="header"></div>
	<div id="background">
	<div id="content_table">
		<button onclick="window.location.href='display_recipe.php'">All recipes</button>
		<button onclick="window.location.href='recipes_form.php'">Create recipe</button>
		<form method="post">
		<input type="text" name="search" placeholder="Search..."> 
		<input type="submit" name="submit_title">
		</form>
		<form method="post">
			<select name="ingredient">
        <option value="none">Search by ingredient</option>
        <?php  
        	$query="select * from ingredients order by ingredient_name";
        	$result = mysqli_query($con,$query);
        	if($result)
        	{
        		while($row=mysqli_fetch_array($result))
        		{
        ?>
        		<option value=<?php echo $row['value']; ?> ><?php echo $row['ingredient_name']; ?></option>
        <?php
        		}
        	}

        ?>
       
     	</select>
			<input type="submit" name="submit_ingredient">
		</form>
		<form method="post">
			<select name="meal">
	        <option value="none">Search by meal type</option>
	        <option value="breakfast">Breakfast</option>
	        <option value="lunch">Lunch</option>
	        <option value="dinner">Dinner</option>
	      </select>
			<input type="submit" name="submit_meal">
		</form>
		<table class="content">
			<thead>
			<tr>
				<th></th>
				<th>Title</th>
				<th>Meal type</th>
				<th>Main Ingredient</th>
				<th>Posted by</th>
				<th colspan="3">Actions</th>
			</tr>
			</thead>
			<tbody>
				<?php
					
					session_start();
					$myuser=$_SESSION['username'];

					$sql = "select * from recipes where username='$myuser'";

					if(isset($_POST['submit_title']))
					{	
					$search=$_POST['search'];
					$sql = "select * from recipes where title like '%$search%' and  username='$myuser'";
					}

					if(isset($_POST['submit_ingredient']))
					{	
					$search=$_POST['ingredient'];
					$sql = "select * from recipes where ingredient='$search' and  username='$myuser'";
					}

					if(isset($_POST['submit_meal']))
					{	
						$search=$_POST['meal'];
						$sql = "select * from recipes where meal='$search' and  username='$myuser'";
					}

					$result = mysqli_query($con,$sql);
					
					while($row = mysqli_fetch_array($result))
					{	
						$x=$row['picture'];
						
						?> 

						<tr>
							<td> <img width=100 height=100 src=<?php echo $x ?> > </td>
							<td><?php echo $row['title']; ?></td>		
							<td><?php echo $row['meal'];?></td>		
							<td><?php echo $row['ingredient']; ?></td>		
							<td><?php echo $row['username']; ?></td>							
							<td><a href=<?php echo "view_item.php?id=" . $row['id']; ?> </a>View<br> 
							<a href=<?php echo "edit_item.php?id=" . $row['id']; ?> </a>Edit <br>
							<a href=<?php echo "delete_item.php?id=".$row['id'];?> </a> Delete </td>			
						</tr>

						<?php 		

						

							
					} 
	 
				?>
			</tbody>
			
		</table>

	</div>
	</div>




</body>

</html>