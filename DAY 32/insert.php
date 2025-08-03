<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "v2v";
$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}

$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$license = $_GET['license'];
$specialization = $_GET['specialization'];
$experience = $_GET['experience'];
$office_address = $_GET['office_address'];

$sql = "INSERT INTO lawyers (name, email, phone, license, specialization, experience, office_address)
VALUES ('$name', '$email', '$phone', '$license', '$specialization', '$experience', '$office_address')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
