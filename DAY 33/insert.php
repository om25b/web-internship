<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "v2v";

$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_GET['name'];
$address = $_GET['address'];
$phone = $_GET['phone'];

$sql = "INSERT INTO employee1 (name, address, phone)
        VALUES ('$name', '$address', '$phone')";

if (mysqli_query($conn, $sql)) {
    echo "Employee added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
