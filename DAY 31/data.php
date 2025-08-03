<?php
$server="localhost";
$user="root";
$password="";
$db="v2v";
$conn = mysqli_connect($server, $user, $password,$db);
if (!$conn) {
die("Connection failed:".mysqli_connect_error());
}
$uname=$_GET['uname'];
$password=$_GET['pass'];
$sql = "INSERT INTO login (username, password)
VALUES ('$uname', '$password')";
if (mysqli_query($conn, $sql)) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>". mysqli_error($conn);
}
mysqli_close($conn);
?>