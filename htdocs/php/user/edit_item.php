<?php
	$host = "localhost"; /* Host name */
	$user = "root"; /* User */
	$password = ""; /* Password */
	$dbname = "accounts"; /* Database name */

	$con = mysqli_connect($host, $user, $password,$dbname);
	// Check connection
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());}

	$id=$_REQUEST['id'];
	$sql="select * from recipes where id=$id";

	$result = mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Edit Recipe</title>
		<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script>
			$(function () {
			$('#header').load('/php/user/header.php')

			})
		</script>
     <link rel="stylesheet" href="user_css/recipe_form.css">
     <script>
    function leave_confirmation()
    {
      if (confirm("Are you sure you want to cancel?"))
        window.location.href="myitems.php";
    }

</script>

	</head>

<body>
<div id="header"></div>
<div id="formular">
  <button id="cancel" onclick="leave_confirmation()">Cancel</button> 
  <form action="" method="POST" enctype="multipart/form-data">
      <h1>Edit recipe</h1>
      <input id="title" type="text" name="title" placeholder="Title" value="<?php echo $row['title']?>">
      <br>
      <label>Main ingredient</label> 
      <select name="ingredient">
        <option value="none">Chose an ingredient</option>
        <?php 
          $value_querry="select * from ingredients order by ingredient_name";
          $result = mysqli_query($con,$value_querry);
          
          while($ingred_value_array=mysqli_fetch_array($result))
          {
        ?>
        <option value=<?php echo $ingred_value_array['value']; ?> 

         <?php if($row['ingredient'] == $ingred_value_array['value']) 
          { echo ' selected="selected"'; } ?>
        > 

        <?php echo $ingred_value_array['ingredient_name']; ?> 
        </option>

      
        <?php  
          }
        ?>
      </select>

      <br>
      <label>Meal type</label>
      <select name="meal">
        <option value="none">Chose a meal type</option>
        <option value="breakfast" <?php if($row['meal'] == 'breakfast') { echo ' selected="selected"'; } ?>>Breakfast</option>
        <option value="lunch" <?php if($row['meal'] == 'lunch') { echo ' selected="selected"'; } ?>>Lunch</option>
        <option value="dinner" <?php if($row['meal'] == 'dinner') { echo ' selected="selected"'; } ?>>Dinner</option>
      </select>
      <br>
      
      <label>Description</label>
      <br>
      <textarea rows=100 cols="50" name="description"><?php echo $row['description']; ?></textarea>
      <br>

      <input type="file" name="file" id="file" />
      <br>
      <span id="uploaded_image"></span><br>
      <input id="button" type="submit" name="button">

      <?php
if(isset($_POST['button']))
{
  $id=$_REQUEST['id'];
  $title=$_REQUEST['title'];
  $ingredient=$_REQUEST['ingredient'];
  $meal=$_REQUEST['meal'];
  $description=$_REQUEST['description'];

  $update = "update recipes set title='$title',ingredient='$ingredient',
    meal='$meal',description='$description' where id='$id'";
  
  

  if(!empty(($_FILES['file']['tmp_name'])))
  { 
    $target_dir = "recipecode/upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("jpg","jpeg","png","gif");
    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
      $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

      $update_img="update recipes set picture='".$image."' where id='$id'" ;

      mysqli_query($con, $update_img) or die(mysqli_error());

    }

  mysqli_query($con, $update) or die(mysqli_error());
  header('Refresh:0');
  echo "Record Updated Successfully. </br></br> ";
 


}

?>
      
    </form>
</div>
</body>
</html>



<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description');
</script>

<script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
     $('#uploaded_image').html(data);
    }
   });
  }
 });
});
</script>