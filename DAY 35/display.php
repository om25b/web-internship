<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "v2v";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, name, phone, address, course FROM registration";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . 
             " - Phone: " . $row["phone"] . 
             " - Address: " . $row["address"] . 
             " - Course: " . $row["course"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
