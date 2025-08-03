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
$sql = "INSERT INTO Registration (name, address, phone, email, gender, course) 
            VALUES ('$name', '$add', '$phone', '$email', '$gender', '$course')";
if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>

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





















<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "v2v";
$conn = mysqli_connect($server, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $add = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    // Validate that all fields are filled
    if (empty($name) || empty($phone) || empty($email) || empty($add) || empty($gender) || empty($course)) {
        die("Error: All fields are required.");
    }

    // Single INSERT statement using form data
    $sql = "INSERT INTO Registration (name, address, phone, email, gender, course) 
            VALUES ('$name', '$add', '$phone', '$email', '$gender', '$course')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error: Form not submitted.";
}

mysqli_close($conn);
?>