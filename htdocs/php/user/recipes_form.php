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
  <title>Create Recipe</title>
  <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    $(function () {
    $('#header').load('/php/user/header.php')

    })
  </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

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
    <h1>Create recipe</h1>
    <form action="" method="POST" enctype="multipart/form-data">
      
      <input id="title" type="text" name="title" placeholder="Title">
      <br>
      <label>Main ingredient</label> 
      <select name="ingredient">
        <option value="none">Chose an ingredient</option>
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

      <br>
      <label>Meal type</label>
      <select name="meal">
        <option value="none">Chose a meal type</option>
        <option value="breakfast">Breakfast</option>
        <option value="lunch">Lunch</option>
        <option value="dinner">Dinner</option>
      </select>
      <br>
      
      <label>Description</label>
      <br>
      <textarea rows="100" cols="50" name="description" ></textarea>
      <br>
      <label>Select Image</label>
      <input type="file" name="file" id="file" />
      <br>
      <span id="uploaded_image"></span><br>
      <input id="button" type="submit" name="button">
    </form>
      <?php
        if(isset($_POST['button']))
        {
          if((empty($_POST['title'])) || (empty($_POST['description'])) || ($_POST['ingredient']=="none")
              ||  ($_POST['meal'] == "none") || (empty($_FILES['file']['name'])) )
                echo '<br>' .'<span style="color:red;">' . "All fields are mandatory " . '</span>';
          else
           include 'submit_recipe.php';
        }
      ?>

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