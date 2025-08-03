<?php
$server="localhost";
$user="root";
$password="";
$db="v2v";
$conn = mysqli_connect($server, $user, $password, $db);
if (!$conn) {
die("Connection failed: mysqli_connect_error());
}
$name = $_GET['fname'];
$phone=$_GET['phone'];
$email=$_GET['email'];
$add=$_GET['address'];
$gender=$_GET['gender'];
$course=$_GET['course'];
$sql = "INSERT INTO Registration(name,address,phone,email,course)
VALUES ('Om Bait', 'Worli', '9920138526','ombait01@gmail.com','WEB')";
$sql = "INSERT INTO Registration(name,address,phone,email,course)
VALUES ('Prabhu', 'Worli', '9920138526','prabhu@gmail.com','WEB')";
$sql = "INSERT INTO Registration(name,address,phone,email,course)
VALUES ('Pawar', 'Worli', '9920138526','pawar@gmail.com','WEB')";
if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>




