<?php
$host="localhost";
$dbUsername= "root";
$dbPassword= "";
$dbname="accounts";

$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

session_start();

$user=$_SESSION['username'];
$content=$_POST['content'];
$subject=$_POST['subject'];
$title=$_POST['title'];

if (mysqli_connect_error()) {
die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());}

$INSERT = "INSERT INTO tickets (subject,content,username,ticket_title) values ('$subject','$content','$user','$title')";

if ($conn->query($INSERT) == TRUE) 
  header("Location: /php/user/support.php"); else {
  echo "Error: " . $INSERT . "<br>" . $conn->error;
}
	


mysqli_close($conn);

?>