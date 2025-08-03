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
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $aadhar_no = !empty($_POST['aadhar_no']) ? mysqli_real_escape_string($conn, $_POST['aadhar_no']) : null;

    // Validate aadhar_no for duplicates if provided
    if ($aadhar_no) {
        $aadhar_check = mysqli_query($conn, "SELECT aadhar_no FROM client WHERE aadhar_no = '$aadhar_no'");
        if (mysqli_num_rows($aadhar_check) > 0) {
            $message = "Error: Aadhar number '$aadhar_no' already exists.";
        } else {
            $sql = "INSERT INTO client (name, email, phone, address, aadhar_no) 
                    VALUES ('$name', '$email', '$phone', '$address', " . ($aadhar_no ? "'$aadhar_no'" : 'NULL') . ")";
            if (mysqli_query($conn, $sql)) {
                $message = "Client registered successfully!";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    } else {
        $sql = "INSERT INTO client (name, email, phone, address, aadhar_no) 
                VALUES ('$name', '$email', '$phone', '$address', NULL)";
        if (mysqli_query($conn, $sql)) {
            $message = "Client registered successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registration - Law Firm Management</title>
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
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
    <script>
        function validateAadhar() {
            const aadharInput = document.getElementById('aadhar_no');
            const aadharError = document.getElementById('aadhar_error');
            const aadharValue = aadharInput.value.trim();

            if (aadharValue && !/^\d{12}$/.test(aadharValue)) {
                aadharError.textContent = 'Aadhar number must be 12 digits.';
                aadharInput.setCustomValidity('Invalid Aadhar number');
            } else {
                aadharError.textContent = '';
                aadharInput.setCustomValidity('');
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Client Registration</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST" onsubmit="validateAadhar()">
            <div class="form-group">
                <label for="client_name">Name</label>
                <input type="text" id="client_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="client_email">Email</label>
                <input type="email" id="client_email" name="email">
            </div>
            <div class="form-group">
                <label for="client_phone">Phone</label>
                <input type="text" id="client_phone" name="phone">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address"></textarea>
            </div>
            <div class="form-group">
                <label for="aadhar_no">Aadhar Number (Optional)</label>
                <input type="text" id="aadhar_no" name="aadhar_no" oninput="validateAadhar()">
                <div id="aadhar_error" class="error"></div>
            </div>
            <button type="submit">Register Client</button>
        </form>
    </div>
</body>
</html>