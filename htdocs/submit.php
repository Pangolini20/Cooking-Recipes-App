<?php

$username = $_POST['username'];
$password = $_POST['password'];
$re_password = $_POST['re_password'];
$email = $_POST['email'];

if(empty($username) || empty($password) || empty($re_password) || empty($email))
{
	echo "<script>alert('All fields are required');document.location.href='../register.html'</script>/n";
	die();
}

if($password != $re_password)
{
	echo "<script>alert('Passwords do not match');document.location.href='../register.html'</script>/n";
	die();
}

$host="localhost";
$dbUsername= "root";
$dbPassword= "";
$dbname="accounts";

$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

if (mysqli_connect_error()) {
die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());}

$INSERT = "INSERT Into account_credentials (username, password,email) values('$username', '$password', '$email')";

if(mysqli_query($conn,$INSERT))
	header('Location: login.php');
else
	echo "<script>alert('Email or username already used');document.location.href='../register.html'</script>/n";

mysqli_close($conn);

?>