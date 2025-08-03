<?php
$server="77.37.35.70";
$user="u936326194_v2v";
$password="V2v@2024$";
$db="u936326194_v2v";
$conn = mysqli_connect($server, $user, $password,$db);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>