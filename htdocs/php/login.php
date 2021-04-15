<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password))
{
	echo "<script>alert('Wrong username or password');document.location.href='../login.php'</script>/n";
	die();
}

$host="localhost";
$dbUsername= "root";
$dbPassword= "";
$dbname="accounts";

$conect =mysqli_connect($host,$dbUsername,$dbPassword,$dbname);

if (mysqli_connect_error()) {
die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());}

if(!$conect)
{
	echo "Can't connect to the database";
	die();
}

$sql= "SELECT * from account_credentials WHERE username='$username' and password='$password'";
$result=mysqli_query($conect,$sql);

$count = mysqli_num_rows($result);
if($count==1)
{
	$row=mysqli_fetch_assoc($result);
	$_SESSION['username'] = $row['username'];
	$_SESSION['status'] =$row['status'];


	if ($row['status'] == "Admin") {
		$_SESSION['username']=$username;
		$_SESSION['id'] =$row['id'];
		header('Location: /php/admin/admin_recipe/display_recipe.php');
	}
	else if ($row['status'] == "User") {
		$_SESSION['id'] =$row['id'];
		$_SESSION['username']=$username;
		header('Location: /php/user/display_recipe.php');
	}
	else
	echo "<script>alert('Wrong username or password');document.location.href='../login.php'</script>/n";
}
else
	echo "<script>alert('Wrong username or password');document.location.href='../login.php'</script>/n";

?>