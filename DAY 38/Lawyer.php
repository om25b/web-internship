<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "law_firm";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $experience_years = isset($_POST['experience_years']) ? (int)$_POST['experience_years'] : null;

    $sql = "INSERT INTO lawyer (name, email, phone, specialization, experience_years) 
            VALUES ('$name', '$email', '$phone', '$specialization', " . ($experience_years !== null ? $experience_years : 'NULL') . ")";

    if (mysqli_query($conn, $sql)) {
        $message = "Lawyer registered successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Registration - Law Firm Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: #fff;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #4b6cb7;
            box-shadow: 0 0 5px rgba(75, 108, 183, 0.5);
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: linear-gradient(135deg, #182848, #4b6cb7);
        }
        .message {
            text-align: center;
            margin-top: 15px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Lawyer Registration</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="lawyer_name">Name</label>
                <input type="text" id="lawyer_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="lawyer_email">Email</label>
                <input type="email" id="lawyer_email" name="email">
            </div>
            <div class="form-group">
                <label for="lawyer_phone">Phone</label>
                <input type="text" id="lawyer_phone" name="phone">
            </div>
            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" id="specialization" name="specialization">
            </div>
            <div class="form-group">
                <label for="experience_years">Experience (Years)</label>
                <input type="number" id="experience_years" name="experience_years">
            </div>
            <button type="submit">Register Lawyer</button>
        </form>
    </div>
</body>
</html>