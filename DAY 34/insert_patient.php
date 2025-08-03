<?php
$conn = mysqli_connect("localhost", "root", "", "v2v");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_GET['name'];
$age = $_GET['age'];
$gender = $_GET['gender'];
$phone = $_GET['phone'];
$symptoms = $_GET['symptoms'];

$sql = "INSERT INTO patients (name, age, gender, phone, symptoms)
        VALUES ('$name', '$age', '$gender', '$phone', '$symptoms')";

if (mysqli_query($conn, $sql)) {
    echo "Patient record added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
