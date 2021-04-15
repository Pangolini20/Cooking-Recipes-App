<?php
$host="localhost";
$dbUsername= "root";
$dbPassword= "";
$dbname="accounts";

$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

if (mysqli_connect_error()) {
die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());}

$email=$_POST['email'];
$content=$_POST['content'];
$subject=$_POST['subject'];

if(empty($email) || empty($content) || empty($subject))
{	
	header("Location: /support.html");
}

$INSERT = "INSERT INTO tickets (subject,content,email) values ('$subject','$content','$email')";

if ($conn->query($INSERT) === TRUE) 
  header("Location: /index.html"); else {
  echo "Error: " . $INSERT . "<br>" . $conn->error;
}
	


mysqli_close($conn);

?>