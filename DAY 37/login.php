<?php
include("connect.php");
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($conn, $_POST['username']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = '$myusername' AND passcode = '$mypassword'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login Form</h2>
    <form method="post" action="">
        <label>Username :</label>
        <input type="text" name="username" required><br><br>
        <label>Password :</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login"><br>
        <p style="color:red;"><?php echo $error; ?></p>
    </form>
</body>
</html>
