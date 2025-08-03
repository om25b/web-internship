<?php
$conn = mysqli_connect("localhost", "root", "", "v2v");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_GET['name'];
$duration = $_GET['duration'];
$fees = $_GET['fees'];

$sql = "INSERT INTO courses (name, duration, fees)
        VALUES ('$name', '$duration', '$fees')";

if (mysqli_query($conn, $sql)) {
    echo "Course added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
